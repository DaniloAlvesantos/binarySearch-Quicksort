<?php

namespace App\Utils;

class BinarySearch
{
    public static function byString(array $arr, string $target)
    {
        $left = 0;
        $right = count($arr) - 1;

        while ($left <= $right) {
            $mid = intval(floor(($left + $right) / 2));
            $midValue = $arr[$mid];
            $cmp = strcmp($midValue, $target);

            if ($cmp == 0) {
                return $mid;
            } else if ($cmp < 0) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }

        return -1;
    }

    public static function byNumber(array $arr, int $target) {
        $left = 0;
        $right = count($arr) - 1;

        while($left <= $right) {
            $mid = intval(floor(($left+$right) / 2));

            if($mid === $target) {
                return $mid;
            } else if($mid < $target) {
                $left = $mid + 1;
            } else {
                $left = $mid - 1;
            }
        }

        return -1;
    }
}