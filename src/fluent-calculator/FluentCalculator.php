<?php

require __DIR__ .  '/../../vendor/autoload.php';

class FluentCalculator
{
  protected $a = '0';
  protected $b = '0';
  protected $r = '';

  protected $isA = true;
  protected $isDirty = true;
  protected $called = false;

  protected $operation;

  protected $digits = [
    'zero' => 0, 'one' => 1, 'two'   => 2, 'three' => 3, 'four' => 4,
    'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9
  ];

  public static function init()
  {
    return new self;
	}

  public function __get($param)
  {
    // echo $this->a . ' ' . $this->operation . ' ' . $this->b . PHP_EOL;
    // echo $param . PHP_EOL;
    
    if (in_array($param, array_keys($this->digits))) {
      $this->isDirty = true;
      $this->isA ? $this->a .= $this->digits[$param] : $this->b .= $this->digits[$param];
    } else {
      if (!$this->isDirty) $this->operation = $param;
      if (!in_array($param, ['minus', 'plus', 'times', 'dividedBy'])) {
        throw new InvalidInputException();
      }
    }

    if ($this->operation === 'minus') {
      $this->r = (string) ((int) $this->a - (int) $this->b);
    } elseif ($this->operation === 'plus') {
      $this->r = (string) ((int) $this->a + (int) $this->b);
    } elseif ($this->operation === 'times') {
      $this->r = (string) ((int) $this->a * (int) $this->b);
    } elseif ($this->operation === 'dividedBy') {
      if ($this->isDirty && !in_array($param, array_keys($this->digits)) && (int) $this->b === 0) {
        throw new DivisionByZeroException();
      }
      if ((int) $this->b !== 0) {
        $f = (int) $this->a / (int) $this->b;
        if ($f >= 0) {
          $this->r = (string) ((int) floor($f));
        } else {
          $this->r = (string) ((int) ceil($f));
        }
      }
    } else {
      $this->r = (string) $this->a;
    }

    if (abs((int) $this->a) > 999999999 or abs((int) $this->b) > 999999999 or abs((int) $this->r) > 999999999) {
      throw new DigitCountOverflowException();
    }

    if (!in_array($param, array_keys($this->digits))) {
      $this->operation = $param;

      if ($this->isDirty) {
        $this->a = $this->r;

        $this->b = '';
        $this->isDirty = false;
        $this->isA = false;  
      }
    }

    return $this;
  }

  public function __call($method, $args)
  {
    $this->called = true;

    $this->{$method};

    echo '-----------' . PHP_EOL;

    return (int) $this->r;
  }
}

class InvalidInputException extends Exception {}
class DigitCountOverflowException extends Exception {}
class DivisionByZeroException extends Exception {}
