<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Database\QueryBuilder;
use PDO;
use PDOStatement;

class QueryBuilderSecurityTest extends TestCase
{
    private QueryBuilder $queryBuilder;
    private PDO $mockPdo;
    private PDOStatement $mockStatement;

    protected function setUp(): void
    {
        $this->mockPdo = $this->createMock(PDO::class);
        $this->mockStatement = $this->createMock(PDOStatement::class);
        $this->queryBuilder = new QueryBuilder($this->mockPdo);
    }

    public function testFindOneUsesPreparedStatements(): void
    {
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM `users` WHERE id = :id LIMIT 1')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('bindParam')
            ->with(':id', 1, PDO::PARAM_INT);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->with(PDO::FETCH_OBJ)
            ->willReturn(false);

        $result = $this->queryBuilder->findOne(1, 'users');
        
        $this->assertNull($result);
    }

    public function testFindOnePreventsSqlInjection(): void
    {
        $maliciousId = "1; DROP TABLE users; --";
        
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM `users` WHERE id = :id LIMIT 1')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('bindParam')
            ->with(':id', $maliciousId, PDO::PARAM_INT);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        // This should be safe because we use prepared statements
        $result = $this->queryBuilder->findOne($maliciousId, 'users');
        
        $this->assertNull($result);
    }

    public function testSelectAllUsesTableNameEscaping(): void
    {
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM `users`')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_OBJ)
            ->willReturn([]);

        $result = $this->queryBuilder->selectAll('users');
        
        $this->assertIsArray($result);
    }

    public function testInsertUsesPreparedStatements(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];

        $expectedSql = "INSERT INTO users (name,email) VALUES(:name, :email)";

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with($expectedSql)
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->with($data)
            ->willReturn(true);

        $result = $this->queryBuilder->insert('users', $data);
        
        $this->assertTrue($result);
    }

    public function testInsertPreventsSqlInjectionInData(): void
    {
        $maliciousData = [
            'name' => "'; DROP TABLE users; --",
            'email' => 'test@example.com'
        ];

        $expectedSql = "INSERT INTO users (name,email) VALUES(:name, :email)";

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with($expectedSql)
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->with($maliciousData)
            ->willReturn(true);

        // This should be safe because we use prepared statements
        $result = $this->queryBuilder->insert('users', $maliciousData);
        
        $this->assertTrue($result);
    }

    public function testInsertHandlesPdoExceptions(): void
    {
        $data = ['name' => 'John Doe'];

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->will($this->throwException(new \PDOException('Database error')));

        $result = $this->queryBuilder->insert('users', $data);
        
        $this->assertFalse($result);
    }

    public function testFindOneReturnsNullForNoResults(): void
    {
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $result = $this->queryBuilder->findOne(999, 'users');
        
        $this->assertNull($result);
    }

    public function testFindOneReturnsObjectForValidResult(): void
    {
        $expectedResult = (object) ['id' => 1, 'name' => 'John Doe'];

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->willReturn($expectedResult);

        $result = $this->queryBuilder->findOne(1, 'users');
        
        $this->assertEquals($expectedResult, $result);
    }

    public function testParameterBindingUsesCorrectTypes(): void
    {
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('bindParam')
            ->with(':id', 1, PDO::PARAM_INT);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $this->queryBuilder->findOne(1, 'users');
    }

    public function testTableNameEscapingInSelectAll(): void
    {
        $tableName = 'users';
        
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with("SELECT * FROM `{$tableName}`")
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetchAll')
            ->willReturn([]);

        $this->queryBuilder->selectAll($tableName);
    }

    public function testInsertReturnsCorrectBooleanValues(): void
    {
        $data = ['name' => 'Test'];

        // Test success case
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $result = $this->queryBuilder->insert('users', $data);
        $this->assertTrue($result);
    }

    public function testSelectAllReturnsArrayOfObjects(): void
    {
        $expectedData = [
            (object) ['id' => 1, 'name' => 'John'],
            (object) ['id' => 2, 'name' => 'Jane']
        ];

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_OBJ)
            ->willReturn($expectedData);

        $result = $this->queryBuilder->selectAll('users');
        
        $this->assertEquals($expectedData, $result);
    }
}