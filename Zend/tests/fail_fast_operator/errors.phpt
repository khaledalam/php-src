--TEST--
Fail-fast operator: Syntax errors and disallowed usage
--FILE--
<?php

try {
    eval('true =>! ;');
} catch (Throwable $e) {
    echo "Caught: " . get_class($e) . "\n";
}
?>
--EXPECTF--
Caught: %sError
