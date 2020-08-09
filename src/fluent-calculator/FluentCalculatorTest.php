<?php

require __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class FluentCalculatorTest extends TestCase
{
    // public function testBasicValueTests() {
	// 	$this->assertSame(0, FluentCalculator::init()->zero(), 'Zero');
	// 	$this->assertSame(1, FluentCalculator::init()->one(), 'One');
	// 	$this->assertSame(2, FluentCalculator::init()->two());
	// 	$this->assertSame(3, FluentCalculator::init()->three());
	// 	$this->assertSame(4, FluentCalculator::init()->four());
	// 	$this->assertSame(5, FluentCalculator::init()->five());
	// 	$this->assertSame(6, FluentCalculator::init()->six());
	// 	$this->assertSame(7, FluentCalculator::init()->seven());
	// 	$this->assertSame(8, FluentCalculator::init()->eight());
	// 	$this->assertSame(9, FluentCalculator::init()->nine());
	// 	$this->assertSame(10, FluentCalculator::init()->one->zero());
	// 	$this->assertSame(-30, FluentCalculator::init()->minus->three->zero());
    //     $this->assertSame(999999999, FluentCalculator::init()->nine->nine->nine->nine->nine->nine->nine->nine->nine());
    // }
    // public function testBasicOperationTests() {
	// 	$this->assertSame(FluentCalculator::init()->two->one->plus->three(), 24);
	// 	$this->assertSame(FluentCalculator::init()->one->minus->three(), -2);
	// 	$this->assertSame(FluentCalculator::init()->two->times->four->five(), 90);
	// 	$this->assertSame(5, FluentCalculator::init()->three->three->dividedBy->six());
	// 	$this->assertSame(24, FluentCalculator::init()->two->one->plus->three->times());
	// 	$this->assertSame(FluentCalculator::init()->one->minus->three->times(), -2);
	// 	$this->assertSame(FluentCalculator::init()->two->times->four->five->minus(), 90);
	// 	$this->assertSame(FluentCalculator::init()->three->three->dividedBy->six->dividedBy(), 5);
	// 	$this->assertSame(7, FluentCalculator::init()->two->one->plus->dividedBy->three());
	// 	$this->assertSame(-23, FluentCalculator::init()->one->zero->times->minus->three->three());
	// 	$this->assertSame(FluentCalculator::init()->two->times->minus->four->five->seven(), -455);
    // }
    // public function testMoreThanOneOperations() {
	// 	$this->assertSame(55, FluentCalculator::init()->one->zero->plus->seven->plus->four->plus->one->plus->zero->plus->two->plus->nine->plus->five->plus->eight->plus->six->plus->three());
	// 	$this->assertSame(-35, FluentCalculator::init()->five->minus->one->minus->nine->minus->two->minus->eight->minus->seven->minus->three->minus->one->zero->minus->zero());
	// 	$this->assertSame(362880, FluentCalculator::init()->seven->times->three->times->two->times->nine->times->one->times->eight->times->four->times->six->times->five());
	// 	$this->assertSame(0, FluentCalculator::init()->one->zero->dividedBy->one->dividedBy->two->dividedBy->five->dividedBy->six->dividedBy->seven->dividedBy->four());
	// 	$this->assertSame(4, FluentCalculator::init()->zero->plus->three->plus->one());
	// 	$this->assertSame(14, FluentCalculator::init()->one->minus->one->zero->dividedBy->nine->plus->three->times->seven());
	// 	$this->assertSame(15, FluentCalculator::init()->one->plus->two->dividedBy->three->times->one->zero->minus->three->plus->eight());
	// 	$this->assertSame(-4, FluentCalculator::init()->three->dividedBy->six->times->one->zero->plus->three->minus->seven());
    // }
	// public function testShouldThrowInvalidInputException1() {
	// 	$this->expectException(InvalidInputException::class);
	// 	FluentCalculator::init()->limit();
	// }
	// public function testShouldThrowInvalidInputException2() {
	// 	$this->expectException(InvalidInputException::class);
	// 	FluentCalculator::init()->power();
	// }
	// public function testShouldThrowInvalidInputException3() {
	// 	$this->expectException(InvalidInputException::class);
	// 	FluentCalculator::init()->sin();
	// }
	// public function testShouldThrowInvalidInputException4() {
	// 	$this->expectException(InvalidInputException::class);
	// 	FluentCalculator::init()->cos();
	// }
	// public function testShouldThrowDigitCountOverflowException1() {
	// 	$this->expectException(DigitCountOverflowException::class);
	// 	FluentCalculator::init()->one->two->three->four->five->six->seven->eight->nine->zero();
	// }
	// public function testShouldThrowDigitCountOverflowException2() {
	// 	$this->expectException(DigitCountOverflowException::class);
	// 	FluentCalculator::init()->one->two->three->four->five->six->seven->eight->nine->times->one->two();
	// }
	// public function testShouldThrowDigitCountOverflowException3() {
	// 	$this->expectException(DigitCountOverflowException::class);
	// 	FluentCalculator::init()->nine->nine->nine->nine->nine->nine->nine->nine->nine->plus->one();
	// }
	// public function testShouldThrowDigitCountOverflowException4() {
	// 	$this->expectException(DigitCountOverflowException::class);
	// 	FluentCalculator::init()->one->zero->zero->zero->zero->zero->times->one->zero->zero->zero->zero->zero();
	// }
	// public function testCornerCaseCheck() {
	// 	$this->assertSame(1, FluentCalculator::init()->zero->zero->zero->zero->zero->zero->zero->zero->zero->zero->one());

	// 	$this->expectException(DigitCountOverflowException::class);
	// 	FluentCalculator::init()->four->six->nine->six->zero->minus->dividedBy->nine->dividedBy->five->five->nine->one->three->four->eight->nine->eight->five->six->times->four->times->seven->three->one->six->seven->five->plus->one->five->dividedBy->two->three->four->four();
	// }
	public function testRandomCheck() {
		// $this->assertSame(0, FluentCalculator::init()->times->one->four->two->two->minus->three->minus->dividedBy->three->eight->plus->six->dividedBy->times->five->zero->dividedBy->seven->four->two->dividedBy->two->five->times->three->seven->four->one->three->times->six->eight->five->five->six->two->zero->three());
		// $this->assertSame(0, FluentCalculator::init()->seven->six->dividedBy->two->minus->times->minus->dividedBy->nine->seven->eight->seven->eight->three->seven->minus->zero->nine->times->times->plus->seven->zero->one->dividedBy->minus->five->six->seven->times->one->dividedBy->zero->two->nine->three->minus());
		// $this->assertSame(0, FluentCalculator::init()->nine->dividedBy->zero->two->eight->three->four->plus->plus->times->minus->dividedBy->seven->eight->zero->times->one->seven());
		// $this->assertSame(68822, FluentCalculator::init()->minus->seven->dividedBy->minus->minus->dividedBy->nine->dividedBy->two->times->four->dividedBy->seven->zero->times->six->nine->two->three->one->minus->five->zero->seven->times->five->nine->plus->times->minus->three->two->minus->plus->nine->seven->nine->seven->one->minus->plus->seven->nine->six->plus());
		// $this->assertSame(9, FluentCalculator::init()->nine->times->plus());
		// $this->assertSame(36, FluentCalculator::init()->five->times->minus->three->plus->one->minus->two->times->zero->minus->one->plus->five->times->nine->plus->times());

		// $this->expectException(DivisionByZeroException::class);
		// $this->assertSame(0, FluentCalculator::init()->one->plus->two->minus->times->zero->times->dividedBy->zero->plus->four());

		$this->expectException(DivisionByZeroException::class);
		FluentCalculator::init()->dividedBy->dividedBy->dividedBy->plus->zero->four->four->six->dividedBy->two->plus->three->zero->times->eight->nine->nine->five->five->dividedBy->zero();

		// $this->expectException(DigitCountOverflowException::class);
		// FluentCalculator::init()->three->plus->dividedBy->times->zero->zero->three->six->five->one->nine->five->five->two->two->three->six->plus->seven->six->three->five->one->eight->two->dividedBy->dividedBy->zero->seven();
	}
}
