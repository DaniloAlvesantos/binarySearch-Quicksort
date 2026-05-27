<?php

namespace Tests\Repositories;

use App\Models\User;
use App\Repositories\UserRepositoy;
use PHPUnit\Framework\TestCase;

class UserTestRepository extends TestCase
{
    protected UserRepositoy $repository;

    public function testGetAllUsers()
    {
        $users = $this->repository->getAllUsers();

        $this->assertIsArray($users);
        $this->assertContainsOnlyInstancesOf(User::class, $users);
        $this->assertNotEmpty($users);
    }

    public function testCreateUser()
    {
        $user = new User(
            'John Doe',
            'johndoe@gmail.com',
            '123456'
        );

        $result = $this->repository->createUser(
            $user
        );

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testLogin()
    {
        $user = $this->repository->login(
            'johndoe@gmail.com',
            '123456'
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertNotNull($user);
        $this->assertEquals('John Doe', $user->getName());
        $this->assertEquals('johndoe@gmail.com', $user->getEmail());
        $this->assertEquals('123456', $user->getPassword());
    }
}
