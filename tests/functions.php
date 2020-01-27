<?php

require '../functions.php';

use PHPUnit\Framework\TestCase;

class FunctionTests extends TestCase
{
    public function testSuccessScoreCalc()
    {
        $expected = 17;
        $input = [['Value' => 5, 'Suit' => 'Hearts', 'Name' => 5],['Value' => 7, 'Suit' => 'Clubs', 'Name' => 7],['Value' => 5, 'Suit' => 'Spades', 'Name' => 5]];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testSuccessScoreCalc2()
    {
        $expected = 11;
        $input = [['Value' => 1, 'Suit' => 'Hearts', 'Name' => 'Ace']];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testSuccessScoreCalc3()
    {
        $expected = 14;
        $input = [['Value' => 1, 'Suit' => 'Hearts', 'Name' => 'Ace'],['Value' => 1, 'Suit' => 'Spades', 'Name' => 'Ace'],['Value' => 1, 'Suit' => 'Clubs', 'Name' => 'Ace'],['Value' => 1, 'Suit' => 'Diamonds', 'Name' => 'Ace']];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testSuccessScoreCalc4()
    {
        $expected = 21;
        $input = [['Value' => 1, 'Suit' => 'Spades', 'Name' => 'Ace'],['Value' => 10, 'Suit' => 'Clubs', 'Name' => 10],['Value' => 10, 'Suit' => 'Diamonds', 'Name' => 10]];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureScoreCalc()
    {
        $expected = 0;
        $input = [];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureScoreCalc2()
    {
        $expected = 0;
        $input = [['Suit' => 'Hearts', 'Name' => 5],['Suit' => 'Clubs', 'Name' => 7],['Suit' => 'Spades', 'Name' => 5]];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureScoreCalc3()
    {
        $expected = 0;
        $input = [1, 2, 3];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureScoreCalc4()
    {
        $expected = 0;
        $input = [['Value' => 'Hearts'],['Value' => 'Clubs'],['Value' => 'Spades']];
        $case = scoreCalc($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedScoreCalc()
    {
        $this->expectException(TypeError::class);
        $input = 'Value 5';
        $case = scoreCalc($input);
    }

    public function testMalformedScoreCalc2()
    {
        $this->expectException(TypeError::class);
        $input = [['Value' => 'Hearts'],['Value' => 'Clubs'],['Value' => 'Spades']];
        $case = scoreCalc($input);
    }

}