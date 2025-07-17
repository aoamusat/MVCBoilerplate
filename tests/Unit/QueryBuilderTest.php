<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Database\QueryBuilder;
use PDO;
use PDOStatement;
use PDOException;

class QueryBuilderTest extends TestCase
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

    public function testConstructorSetsPdoInstance(): void
    {
        $reflection = new \ReflectionClass($this->queryBuilder);
        $pdoProperty = $reflection->getProperty('pdo');
        $pdoProperty->setAccessible(true);
        
        $this->assertSame($this->mockPdo, $pdoProperty->getValue($this->queryBuilder));
    }

    public function testSelectAllReturnsArrayOfObjects(): void
    {
        $expectedData = [
            (object) ['id' => 1, 'name' => 'John'],
            (object) ['id' => 2, 'name' => 'Jane']
        ];

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM `users`')
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

    public function testSelectAllWithEmptyTable(): void
    {
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM `empty_table`')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_OBJ)
            ->willReturn([]);

        $result = $this->queryBuilder->selectAll('empty_table');

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testFindOneReturnsObject(): void
    {
        $expectedData = (object) ['id' => 1, 'name' => 'John Doe'];

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
            ->willReturn($expectedData);

        $result = $this->queryBuilder->findOne(1, 'users');

        $this->assertEquals($expectedData, $result);
    }

    public function testFindOneReturnsNullWhenNoResult(): void
    {
        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM `users` WHERE id = :id LIMIT 1')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('bindParam')
            ->with(':id', 999, PDO::PARAM_INT);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->with(PDO::FETCH_OBJ)
            ->willReturn(false);

        $result = $this->queryBuilder->findOne(999, 'users');

        $this->assertNull($result);
    }

    public function testInsertReturnsTrueOnSuccess(): void
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

    public function testInsertReturnsFalseOnFailure(): void
    {
        $data = ['name' => 'John Doe'];

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->willReturn(false);

        $result = $this->queryBuilder->insert('users', $data);

        $this->assertFalse($result);
    }

    public function testInsertHandlesPdoExceptionAndReturnsFalse(): void
    {
        $data = ['name' => 'John Doe'];

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->will($this->throwException(new PDOException('Database error')));

        $result = $this->queryBuilder->insert('users', $data);

        $this->assertFalse($result);
    }

    public function testInsertGeneratesCorrectSqlWithMultipleFields(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'age' => 30,
            'active' => true
        ];

        $expectedSql = "INSERT INTO users (name,email,age,active) VALUES(:name, :email, :age, :active)";

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

    public function testInsertWithEmptyDataArray(): void
    {
        $data = [];

        $expectedSql = "INSERT INTO users () VALUES()";

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

    public function testSelectAllUsesCorrectTableNameEscaping(): void
    {
        $tableName = 'user_profiles';

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

    public function testFindOneUsesCorrectTableNameEscaping(): void
    {
        $tableName = 'user_profiles';

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with("SELECT * FROM `{$tableName}` WHERE id = :id LIMIT 1")
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('bindParam');

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $this->queryBuilder->findOne(1, $tableName);
    }

    public function testInsertUsesCorrectTableName(): void
    {
        $tableName = 'user_profiles';
        $data = ['name' => 'John'];

        $expectedSql = "INSERT INTO {$tableName} (name) VALUES(:name)";

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->with($expectedSql)
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $result = $this->queryBuilder->insert($tableName, $data);

        $this->assertTrue($result);
    }

    public function testFindOneBindsParameterWithCorrectType(): void
    {
        $id = 123;

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('bindParam')
            ->with(':id', $id, PDO::PARAM_INT);

        $this->mockStatement->expects($this->once())
            ->method('execute');

        $this->mockStatement->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $this->queryBuilder->findOne($id, 'users');
    }

    public function testInsertHandlesSpecialCharactersInData(): void
    {
        $data = [
            'name' => "John's Data",
            'description' => 'Contains "quotes" and special chars'
        ];

        $this->mockPdo->expects($this->once())
            ->method('prepare')
            ->willReturn($this->mockStatement);

        $this->mockStatement->expects($this->once())
            ->method('execute')
            ->with($data)
            ->willReturn(true);

        $result = $this->queryBuilder->insert('users', $data);

        $this->assertTrue($result);
    }

    public function testMethodsReturnCorrectTypes(): void
    {
        // Test selectAll return type
        $this->mockPdo->method('prepare')->willReturn($this->mockStatement);
        $this->mockStatement->method('fetchAll')->willReturn([]);
        $this->mockStatement->method('fetch')->willReturn(false);
        $this->mockStatement->method('execute')->willReturn(true);

        $selectAllResult = $this->queryBuilder->selectAll('users');
        $this->assertIsArray($selectAllResult);

        $findOneResult = $this->queryBuilder->findOne(1, 'users');
        $this->assertNull($findOneResult);

        $insertResult = $this->queryBuilder->insert('users', ['name' => 'John']);
        $this->assertIsBool($insertResult);
    }
}