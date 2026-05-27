<?php

namespace Tests\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        $user = new User('John Doe', 'johndoe@gmail.com', 'john123');

        $this->user = $user;
        $this->user->setId(1);
    }

    public function testInstanceUser()
    {
        $this->setUp();

        $this->assertNotNull($this->user->getId());
        $this->assertIsInt($this->user->getId());
        $this->assertIsString($this->user->getName());
        $this->assertIsString($this->user->getEmail());
        $this->assertIsString($this->user->getPassword());
    }

    public function testSetEmptyValues()
    {   
        $this->setUp();

        $this->user->setEmail('');
        $this->user->setPassword('');
        $this->user->setName('');

        $this->assertNotEquals('', $this->user->getEmail());
        $this->assertNotEquals('', $this->user->getPassword());
        $this->assertNotEquals('', $this->user->getName());
    }
}
