<?php

class FluentCalculator
{
  use StacksDigits;

  protected $a;
  
  protected $b;

  protected $digits = ['zero' => 0, 'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9];

	public static function init() {
    return new self;
	}

	public function append($digit) {
    $this->a .= $digit;
  }

  public function __get($param)
  {
    $this->append($this->digits[$param]);

    return $this;
  }

  public function __call($method, $args) {
    if (in_array($method, $this->digits)) $this->append($this->digits[$method]);

    return (int) $this->a;
  }
}

trait StacksDigits
{
  
}
