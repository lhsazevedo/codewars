<?php

class FluentCalculator
{
  use StacksDigits;

  protected $a;
  
  protected $b;

	public static function init() {
    return new self;
	}

	// you can define 2 (two) more methods

}

trait StacksDigits
{
  public function append($digit) {
    $this->a .= $digit;
  }

  public function __call($method, $args) {
    $digits = ['zero' => 0, 'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9];
    if (in_array($method, $digits)) $this->append($digits[$method]);
  }
}

var_dump(FluentCalculator::init()->one() === 1);