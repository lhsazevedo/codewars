<?php

require __DIR__ .  '/../../vendor/autoload.php';

class FluentCalculator
{
  protected $a = '';
  protected $b = '';

  protected $isA = true;

  protected $operation;

  protected $digits = ['zero' => 0, 'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9];

	public static function init() {
    return new self;
	}

	public function append($digit) {
    $this->isA ? $this->a .= $digit : $this->b .= $digit;
  }

  public function __get($param)
  {
    if (in_array($param, array_keys($this->digits))) {
      $this->append($this->digits[$param]);
    } else {
      $this->operation = $param;
      $this->isA = !$this->isA;
    }

    return $this;
  }

  public function __call($method, $args) {
    if (in_array($method, $this->digits)) {
      $this->append($this->digits[$method]);
    } elseif ($method === 'minus') {
      $this->operation = 'minus';
      $this->isA = !$this->isA;
    } elseif ($method === 'plus') {
      $this->operation = 'plus';
      $this->isA = !$this->isA;
    } elseif ($method === 'times') {
      $this->operation = 'times';
      $this->isA = !$this->isA;
    } elseif ($method === 'dividedBy') {
      $this->operation = 'dividedBy';
      $this->isA = !$this->isA;
    }

    if ($this->operation == 'minus') {
      return (int) $this->a - (int) $this->b;
    } elseif($this->operation == 'plus') {
      return (int) $this->a + (int) $this->b;
    } elseif($this->operation == 'times') {
      return (int) $this->a * (int) $this->b;
    }  elseif($this->operation == 'dividedBy') {
      return (int) floor((int) $this->a / (int) $this->b);
    } else {
      return $this->isA ? (int) $this->a : (int) $this->b;
    }
  }
}
