<?php

class Quicksort
{
    public static function intSort(array &$arr, int $left, int $right)
    {
        if ($left < $right) {

            $pivot = self::intPartition($arr, $left, $right);

            self::intSort($arr, $left, $pivot - 1);
            self::intSort($arr, $pivot + 1, $right);
        }
    }

    private static function intPartition(array &$arr, int $left, int $right)
    {
        $pivot = $arr[$right];
        $i = $left - 1;

        for ($j = $left; $j < $right; $j++) {

            if ($arr[$j] <= $pivot) {

                $i++;

                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }

        $temp = $arr[$i + 1];
        $arr[$i + 1] = $arr[$right];
        $arr[$right] = $temp;

        return $i + 1;
    }

    public static function stringSort(array &$arr, int $left, int $right)
    {
        if ($left < $right) {

            $pivot = self::stringPartition($arr, $left, $right);

            self::stringSort($arr, $left, $pivot - 1);
            self::stringSort($arr, $pivot + 1, $right);
        }
    }

    private static function stringPartition(array &$arr, int $left, int $right)
    {
        $pivot = $arr[$right];
        $i = $left - 1;

        for ($j = $left; $j < $right; $j++) {

            if (strcmp($arr[$j], $pivot) <= 0) {

                $i++;

                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }

        $temp = $arr[$i + 1];
        $arr[$i + 1] = $arr[$right];
        $arr[$right] = $temp;

        return $i + 1;
    }
}