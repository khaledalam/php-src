--TEST--
FAIL_FAST operator (=>!) test suite
--FILE--
<?php

echo "Basic null checks:\n";
try {
    $name = null;
    $name =>! throw new Exception("Missing name");
    echo "Should not reach here\n";
} catch (Exception $e) {
    echo "Caught: ", $e->getMessage(), "\n";
}

$age = 0;
try {
    $age =>! throw new Exception("Missing age");
    echo "OK: age\n";
} catch (Exception $e) {
    echo "Unexpected failure: ", $e->getMessage(), "\n";
}

$email = "me@example.com";
try {
    $email =>! throw new Exception("Missing email");
    echo "OK: email\n";
} catch (Exception $e) {
    echo "Unexpected failure: ", $e->getMessage(), "\n";
}


echo "\nFunction usage:\n";
function register($email, $password) {
    $email =>! throw new Exception("Missing email");
    $password =>! throw new Exception("Missing password");
    echo "Registered: $email\n";
}

try {
    register("user@test.com", "secret");
} catch (Exception $e) {
    echo "Unexpected failure: ", $e->getMessage(), "\n";
}

try {
    register("user@test.com", "");
} catch (Exception $e) {
    echo "Caught: ", $e->getMessage(), "\n";
}

try {
    register(null, "secret");
} catch (Exception $e) {
    echo "Caught: ", $e->getMessage(), "\n";
}


echo "\nFail-fast in expressions:\n";
function getUserData($data) {
    return ($data["id"] =>! throw new Exception("Missing ID")) * 10;
}

try {
    echo getUserData(["id" => 7]) . "\n";
} catch (Exception $e) {
    echo "Unexpected failure: ", $e->getMessage(), "\n";
}

try {
    echo getUserData([]) . "\n";
} catch (Exception $e) {
    echo "Caught: ", $e->getMessage(), "\n";
}


echo "\nChained expressions:\n";
function compute($a, $b) {
    return ($a =>! throw new Exception("A is missing")) + ($b =>! throw new Exception("B is missing"));
}

try {
    echo compute(5, 3) . "\n";
} catch (Exception $e) {
    echo "Unexpected failure: ", $e->getMessage(), "\n";
}

try {
    echo compute(null, 3) . "\n";
} catch (Exception $e) {
    echo "Caught: ", $e->getMessage(), "\n";
}

try {
    echo compute(1, null) . "\n";
} catch (Exception $e) {
    echo "Caught: ", $e->getMessage(), "\n";
}


echo "\nTruthy/Falsy behavior:\n";
$truthy = [true, 1, "hello", [1], 0.1];
$falsy = [false, 0, "", [], null];

foreach ($truthy as $val) {
    try {
        $val =>! throw new Exception("Should not fail");
        echo "Pass\n";
    } catch (Exception $e) {
        echo "Unexpected: ", $e->getMessage(), "\n";
    }
}

foreach ($falsy as $val) {
    try {
        $val =>! throw new Exception("Should fail");
    } catch (Exception $e) {
        echo "Caught: ", $e->getMessage(), "\n";
    }
}

?>
--EXPECTF--
Basic null checks:
Caught: Missing name
OK: age
OK: email

Function usage:
Registered: user@test.com
Caught: Missing password
Caught: Missing email

Fail-fast in expressions:
70
Caught: Missing ID

Chained expressions:
8
Caught: A is missing
Caught: B is missing

Truthy/Falsy behavior:
Pass
Pass
Pass
Pass
Pass
Caught: Should fail
Caught: Should fail
Caught: Should fail
Caught: Should fail
Caught: Should fail
