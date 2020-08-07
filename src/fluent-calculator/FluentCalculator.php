<?php

require __DIR__ .  '/../../vendor/autoload.php';

class FluentCalculator
{
  protected $a = '';
  protected $b = '';

  protected $isA = true;
  protected $isDirty = true;

  protected $operation;

  protected $digits = ['zero' => 0, 'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9];

	public static function init() {
    return new self;
	}

	public function append($digit) {
    $this->isDirty = true;
    $this->isA ? $this->a .= $digit : $this->b .= $digit;
  }

  public function __get($param)
  {
    if (in_array($param, array_keys($this->digits))) {
      $this->append($this->digits[$param]);
    } else {
      if ($this->operation && $this->isDirty) {
        $this->a = (string) $this->{$param}();
        $this->b = '';
        $this->isDirty = false;
        $this->isA = false;
      }

      $this->operation = $param;
      // if ($this->a && $this->b) {
      //   $this->a = (string) $this->{$param}();
      //   $this->b = '';
      // }
      if ($this->isDirty) $this->isA = !$this->isA;
      $this->isDirty = false;
    }

    return $this;
  }

  public function __call($method, $args) {
    if (in_array($method, array_keys($this->digits))) {
      $this->append($this->digits[$method]);
    } elseif (!$this->operation) {
      if ($method === 'minus') {
        $this->operation = 'minus';
      } elseif ($method === 'plus') {
        $this->operation = 'plus';
      } elseif ($method === 'times') {
        $this->operation = 'times';
      } elseif ($method === 'dividedBy') {
        $this->operation = 'dividedBy';
      } else {
        throw new InvalidInputException();
      }
    }

    if ($this->operation == 'minus') {
      $r = (int) $this->a - (int) $this->b;
    } elseif($this->operation == 'plus') {
      $r = (int) $this->a + (int) $this->b;
    } elseif($this->operation == 'times') {
      $r = (int) $this->a * (int) $this->b;
    }  elseif($this->operation == 'dividedBy') {
      $r = (int) floor((int) $this->a / (int) $this->b);
    } else {
      $r = $this->isA ? (int) $this->a : (int) $this->b;
    }

    if ($r > 999999999) {
      throw new DigitCountOverflowException();
    }

    return $r;
  }
}

class InvalidInputException extends Exception {}
class DigitCountOverflowException extends Exception {}
