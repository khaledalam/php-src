--TEST--
Fail-fast operator: Chaining behavior
--FILE--
<?php

function getData($id) {
    if ($id === 1) return ["name" => "Test"];
    return null;
}

$data = getData(2) =>! throw new Exception("No data found");
$name = $data["name"] =>! throw new Exception("Missing name");

echo "Name: $name\n";
?>
--EXPECTF--
Fatal error: Uncaught Exception: No data found in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
