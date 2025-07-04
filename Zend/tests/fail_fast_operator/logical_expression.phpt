--TEST--
Fail-fast operator: Inside logical expressions
--FILE--
<?php

$foo = true;
$bar = null;

try {
    ($foo && $bar) =>! throw new Exception("Falsy logic");
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

?>
--EXPECT--
Falsy logic
