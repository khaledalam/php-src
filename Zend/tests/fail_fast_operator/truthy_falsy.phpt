--TEST--
Fail-fast operator: Truthy and falsy values
--FILE--
<?php

function test($label, $value) {
    echo "$label: ";
    try {
        $value =>! throw new Exception("FAIL");
        echo "PASS\n";
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }
}

test("non-empty string", "hello");
test("empty string", "");
test("1", 1);
test("0", 0);
test("null", null);
test("empty array", []);
test("non-empty array", [1]);
?>
--EXPECT--
non-empty string: PASS
empty string: FAIL
1: PASS
0: FAIL
null: FAIL
empty array: FAIL
non-empty array: PASS
