<?php

/**
* Roman
*/
class Roman
{
	public $romans;

	public function __construct()
	{
		$this->romans = [
				    'M' => 1000,
				    'CM' => 900,
				    'D' => 500,
				    'CD' => 400,
				    'C' => 100,
				    'XC' => 90,
				    'L' => 50,
				    'XL' => 40,
				    'X' => 10,
				    'IX' => 9,
				    'V' => 5,
				    'IV' => 4,
				    'I' => 1,
				];
	}

	private function intToRoman($intNumber) {
		$intNumber = intval($intNumber);
		$result = '';

		foreach ($this->romans as $roman => $number) {
		    $matches = intval($intNumber / $number);
		    $result .= str_repeat($roman, $matches);
		    $intNumber = $intNumber % $number;
		}

		return $result;
	}

	private function romanToInt($romanNumber) {
		$result = 0;

		foreach ($this->romans as $key => $value) {
		    while (strpos($romanNumber, $key) === 0) {
		        $result += $value;
		        $romanNumber = substr($romanNumber, strlen($key));
		    }
		}

		return $result;
	}

	public function calculate() {
		$message = '';

		if (!isset($_POST['first']) || empty($_POST['first']) || !isset($_POST['second']) || empty($_POST['second']) || !isset($_POST['operator']) || empty($_POST['operator'])) {
			$message = 'Please enter all the required fields.';
			return ['message' => $message];
		}

		$firstNumber  = strtoupper($_POST['first']);
		$secondNumber = strtoupper($_POST['second']);
		$operator     = $_POST['operator'];
		$operators 	  = ['+', '-', '*', '/'];
		if (!in_array($operator, $operators)) {
			$message = 'Please enter valid operator.';
			return ['message' => $message];
		}


		$calculatedValue = $this->intToRoman(eval('return '.$this->romanToInt($firstNumber).$operator.$this->romanToInt($secondNumber).';'));

		return ['result' => $calculatedValue];
	}

	public function ajaxCall()
	{
		return json_encode($this->calculate());
	}
}

if (isset($_POST['js-submit'])) {
	$roman = new Roman();
	echo $roman->ajaxCall();
}
