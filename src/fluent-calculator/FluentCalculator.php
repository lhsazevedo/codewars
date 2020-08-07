<?php

require __DIR__ .  '/../../vendor/autoload.php';

class FluentCalculator
{
  protected $a = '';
  protected $b = '';
  protected $r = '';

  protected $isA = true;
  protected $isDirty = true;

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
    if (in_array($param, array_keys($this->digits))) {
      $this->isDirty = true;
      $this->isA ? $this->a .= $this->digits[$param] : $this->b .= $this->digits[$param];
    } else {
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
      $this->r = (string) ((int) floor((int) $this->a / (int) $this->b));
    } else {
      $this->r = (string) $this->a;
    }

    if (strlen($this->r) > 9) {
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
    $this->{$method};

    return (int) $this->r;
  }
}

class InvalidInputException extends Exception {}
class DigitCountOverflowException extends Exception {}
