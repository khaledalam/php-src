--TEST--
Fail-fast operator: Return value forwarding
--FILE--
<?php

function validate($val) {
    return $val =>! throw new Exception("fail: $val");
}

try {
    $result = validate("ok");
    echo "Validated: $result\n";
    validate("");
} catch (Throwable $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
Validated: ok
fail: 
