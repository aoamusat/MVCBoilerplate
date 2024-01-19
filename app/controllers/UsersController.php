<?php

namespace App\Controller;

use App\Core\App;
use App\Core\Helper;

/**
 * Class UsersController
 *
 * Controller for handling user-related actions.
 */
class UsersController
{
    /**
     * Display a listing of users.
     *
     * @return mixed The result of rendering the 'users' view with user data.
     */
    public function index()
    {
        $users = App::get('database')->selectAll("users");
        return Helper::view(
            'users', [
            'users' => $users,
            ]
        );
    }

    /**
     * Store a newly created user in the database.
     *
     * @return null Redirects to the 'users' page after storing the user.
     */
    public function store()
    {
        App::get(
            'database'
        )->insert(
            'users', [
            'name' => $_POST['name'],
            ]
        );

        Helper::redirect('users');
    }
}