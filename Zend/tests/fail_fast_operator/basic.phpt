--TEST--
Fail-fast operator: Basic usage
--FILE--
<?php

false =>! throw new Exception("fail");
echo "This won't print\n";

?>
--EXPECTF--
Fatal error: Uncaught Exception: fail in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
