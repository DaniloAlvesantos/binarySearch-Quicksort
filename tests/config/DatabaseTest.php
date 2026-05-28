<?php

namespace Tests\Config;

use Config\Database;
use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{    
    public function testGetInstance()
    {
        $conn = Database::getInstance();

        $this->assertInstanceOf(Database::class, $conn);
        $this->assertNotNull($conn);
    }

    public function testGetConnection()
    {
        $conn = Database::getInstance()->getConnection();

        $this->assertNotNull($conn);
        $this->assertInstanceOf(PDO::class, $conn);
    }
}