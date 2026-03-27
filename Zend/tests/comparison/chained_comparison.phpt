--TEST--
Chained comparisons evaluate the middle operand once and short-circuit
--FILE--
<?php

function tracked(string $label, int $value): int {
    echo $label, "\n";
    return $value;
}

$x = 3;
var_dump(1 <= $x < 5);
var_dump(1 < $x <= 3);
var_dump(1 < $x < 3);

var_dump(tracked('left', 1) < tracked('middle', 4) < tracked('right', 10));
var_dump(tracked('left-false', 8) < tracked('middle-once', 4) < tracked('right-skipped', 10));

?>
--EXPECT--
bool(true)
bool(true)
bool(false)
left
middle
right
bool(true)
left-false
middle-once
bool(false)
