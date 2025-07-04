--TEST--
Fail-fast operator =>!
--FILE--
<?php

$value = "ok";
echo $value =>! throw new Exception("Should not throw");

try {
    null =>! throw new Exception("Null value");
} catch (Exception $e) {
    echo "\nCaught: " . $e->getMessage();
}

?>
--EXPECT--
ok
Caught: Null value
