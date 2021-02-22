<?php

declare(strict_types=1);

namespace App\Services;

class MatrixService
{
    /**
     * Placeholder used if the product result cannot be converted to a string.
     *
     * @var string
     */
    protected $placeholder = '-';

    /**
     * Multiply two matrices and return product.
     * 
     * @param array   $matrix1
     * @param array   $matrix2
     * 
     * @return array
     */
    public function multiply(array $matrix1, array $matrix2): array
    {
        $result = [];
        $max = count($matrix2[0]); // amount of columns in matrix 2

        foreach ($matrix1 as $key => $row) {
            for ($i = 0; $i < $max; $i++) {
                $column = $this->getColumn($matrix2, $i);
                $sum = $this->sumProduct($row, $column);

                $result[$key][] = $this->toString($sum);
            }
        }

        return $result;
    }

    /**
     * Return an array with all values of a given column 
     * in a multi-dimensional array.
     * 
     * @param array $array  The multi-dimensional array.
     * @param int   $index  The column index to retrieve.
     * 
     * @return array
     */
    protected function getColumn(array $array, int $index): array
    {
        $column = [];
        foreach ($array as $col) {
            $column[] = $col[$index];
        }

        return $column;
    }

    /**
     * Sum up the product of two arrays.
     * 
     * @param  array $first
     * @param  array $second
     * 
     * @return int
     */
    protected function sumProduct(array $first, array $second): int
    {
        $total = 0;
        for ($i = 0; $i < count($first); $i++) {
            $total += $first[$i] * $second[$i];
        }

        return $total;
    }

    /**
     * Convert number to string representation,
     * e.g. 1 > A, 26 > Z, 27 > AA etc.
     * 
     * @param int $num
     * 
     * @return string
     */
    public function toString(int $num): string
    {
        if ($num === 0) return $this->placeholder;

        --$num;
        for ($str = ''; $num >= 0; $num = intval($num / 26) - 1) {
            $str = chr($num % 26 + 65) . $str;
        }

        return $str;
    }
}