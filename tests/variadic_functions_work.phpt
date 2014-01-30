--TEST--
Test ensures that functions with variadic arguments work.
--INI--
augmented_types.enforce_by_default = 1
--FILE--
<?php

/**
* @param float start
* @param *float multipliers
* @return float[] the total
*/
function multiply_all($start)
{
	$multipliers = func_get_args();
	$ret = [];
	for ($i = 1; $i < count($multipliers); $i++) {
		$ret[] = $multipliers[$i] * $start;
	}
	return $ret;
}

echo implode(multiply_all(2.0, 1.1, 2.2, 3.3), " ") . "\n";
echo implode(multiply_all(1.0)) . "\n";

echo multiply_all(2.0, 5);
?>
--EXPECTREGEX--
2.2 4.4 6.6


Fatal error: Wrong type encountered for argument 2 of function multiply_all, was expecting a \*\(float\) but got a \(int\) 5
.*
