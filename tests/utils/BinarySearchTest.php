<?php

namespace Tests\Utils;

use PHPUnit\Framework\TestCase;
use App\Utils\BinarySearch;

class BinarySearchTest extends TestCase
{
    public function testBinarySearchByNumber()
    {
        $arr = [1,2,3,4,5,6,6,7,8,9,9,10,11,12,13,13];

        $result = BinarySearch::byNumber($arr, 10);

        $this->assertIsInt($result);
        $this->assertEquals(11, $result);
    }

    public function testBinarySearchByString()
    {
        $arr = ['Ana', 'Bruno', 'David', 'Leandro'];

        $result = BinarySearch::byString($arr, 'David');

        $this->assertIsInt($result);
        $this->assertEquals(2, $result);
    }

    public function testShouldNotFound()
    {
        $arr = [1,2,3,4,5,6,6,7,8,9,9,10,11,12,13,13];
        
        $result = BinarySearch::byNumber($arr, 14);
        $this->assertEquals(-1, $result);
    }
}