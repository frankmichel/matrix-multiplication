<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\MatrixService;

class ExampleTest extends TestCase
{
    /**
     * Test for multiply() method of MatrixService.
     */
    public function testMultiply()
    {
        $service = new MatrixService;

        $matrix1 = [[0,0],[0,0]];
        $matrix2 = [[0,0],[0,0]];
        $expecting = [['-','-'],['-','-']];

        $this->assertEquals($expecting, $service->multiply($matrix1, $matrix2));

        $matrix1 = [[1,2],[3,4]];
        $matrix2 = [[4,3],[2,1]];
        $expecting = [['H','E'],['T','M']];

        $this->assertEquals($expecting, $service->multiply($matrix1, $matrix2));

        $matrix1 = [[3,5],[4,6]];
        $matrix2 = [[9,8],[7,6]];
        $expecting = [
            [$service->toString(62), $service->toString(54)],
            [$service->toString(78), $service->toString(68)],
        ];

        $this->assertEquals($expecting, $service->multiply($matrix1, $matrix2));
    }

    /**
     * Test for toString() method of MatrixService.
     */
    public function testToString()
    {
        $service = new MatrixService;

        $this->assertEquals('-', $service->toString(0));
        $this->assertEquals('A', $service->toString(1));
        $this->assertEquals('B', $service->toString(2));
        $this->assertEquals('Z', $service->toString(26));
        $this->assertEquals('AA', $service->toString(27));
        $this->assertEquals('AB', $service->toString(28));
    }
}
