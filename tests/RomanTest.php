<?php

use PHPUnit\Framework\TestCase;

/**
 * @covers Roman
 */
final class RomanTest extends TestCase
{
    public function testForNotFieldsNotSet()
    {
    	$_POST = [];
    	$roman = new Roman();
    	$expected = ['message' => 'Please enter all the required fields.'];

        $this->assertSame($expected, $roman->calculate());
    }

    public function testForEmptyFields()
    {
    	$_POST = ['first' => '', 'second' => '', 'operator' => ''];
    	$roman = new Roman();
    	$expected = ['message' => 'Please enter all the required fields.'];

        $this->assertSame($expected, $roman->calculate());
    }

    public function testForInvalidOperator()
    {
    	$_POST = ['first' => 'x', 'second' => 'c', 'operator' => 'a'];
    	$roman = new Roman();
    	$expected = ['message' => 'Please enter valid operator.'];

        $this->assertSame($expected, $roman->calculate());
    }

    public function testForValidUpperCaseInputs()
    {
    	$_POST = ['first' => 'X', 'second' => 'C', 'operator' => '+'];
    	$roman = new Roman();
    	$expected = ['result' => 'CX'];

        $this->assertSame($expected, $roman->calculate());
    }

    public function testForValidLowerCaseInputs()
    {
    	$_POST = ['first' => 'c', 'second' => 'c', 'operator' => '*'];
    	$roman = new Roman();
    	$expected = ['result' => 'MMMMMMMMMM'];

        $this->assertSame($expected, $roman->calculate());
    }
}