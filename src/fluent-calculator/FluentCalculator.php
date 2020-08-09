<?php

require __DIR__ .  '/../../vendor/autoload.php';

class FluentCalculator
{
  protected $a = '0';
  protected $b = '';
  protected $r = '';

  protected $isA = true;
  protected $isDirty = true;
  protected $called = false;
  protected $dividedByZero = false;

  protected $op;

  protected $digits = [
    'zero' => 0, 'one' => 1, 'two'   => 2, 'three' => 3, 'four' => 4,
    'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9
  ];

  protected $methods = [
    'plus', 'minus', 'times', 'dividedBy'
  ];

  public static function init()
  {
    return new self;
  }
  
  public function __call($method, $args)
  {
    $this->{$method};

    if ($this->dividedByZero) {
      throw new DivisionByZeroException();
    }

    return (int) $this->r;
  }

  public function __get($param)
  {
    if (in_array($param, array_keys($this->digits))) {
      $this->isA
        ? $this->a .= $this->digits[$param]
        : $this->b .= $this->digits[$param];
      $this->isDirty = true;
    } elseif (in_array($param, $this->methods)) {
      if ($this->isDirty && $this->op) {
        if ($this->dividedByZero) {
          throw new DivisionByZeroException();
        }
        $this->dividedByZero = false;
        $this->a = $this->r;
        $this->b = '';
        $this->isDirty = false;
      }
      $this->op = $param;
      $this->isA = false;
    } else {
      throw new InvalidInputException();
    }

    $a = (int) $this->a;
    $b = (int) $this->b;

    if ($this->b !== '') {
      switch ($this->op) {
        case 'plus':
          $this->r = (string) ($a + $b);
          break;
        case 'minus':
          $this->r = (string) ($a - $b);
          break;
        case 'times':
          $this->r = (string) ($a * $b);
          break;
        case 'dividedBy':
          if ($b !== 0) {
            $this->dividedByZero = false;
            $r = $a / $b;
            if ($r >= 0) {
              $r = floor($r);
            } else {
              $r = ceil($r);
            }
            $this->r = (string) ((int) $r);
          } else {
            $this->dividedByZero = true;
          }
          break;
      }
    } else {
      $this->r = $this->a;
    }

    foreach ([$this->a, $this->b, $this->r] as $v) {
      if (abs((int) $v) > 10**9-1) {
        throw new DigitCountOverflowException();
      }
    }

    return $this;
  }
}

class InvalidInputException extends Exception {}
class DigitCountOverflowException extends Exception {}
class DivisionByZeroException extends Exception {}
