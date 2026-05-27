<?php

namespace Tests\Utils;

use App\Utils\Quicksort;
use PHPUnit\Framework\TestCase;

class QuicksortTest extends TestCase
{
    public function testIntSort()
    {
        $arr = [10, 0, 9, 1, 8, 2, 7, 3, 4, 6, 5];

        Quicksort::intSort($arr, 0, count($arr) - 1);

        $this->assertEquals(10, $arr[count($arr) - 1]);
        $this->assertEquals(0, $arr[0]);
    }

    public function testStrigSort()
    {
        $arr = ['David', 'Ana', 'Wlademir', 'John'];

        Quicksort::stringSort($arr, 0, count($arr) - 1);

        $this->assertEquals('Ana', $arr[0]);
        $this->assertEquals('Wlademir', $arr[count($arr) - 1]);
    }
}
