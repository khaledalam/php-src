--TEST--
Testing register_shutdown_function() with timeout. (Bug: #21513)
--SKIPIF--
<?php
if (PHP_OS_FAMILY === 'Windows' && version_compare(PHP_VERSION, '8.4', '<')) {
    die("xfail fails on Windows Server 2022 and newer.");
}
if (getenv("SKIP_SLOW_TESTS")) die("skip slow test");
?>
--FILE--
<?php

echo "Start\n";

function boo()
{
    echo "Shutdown\n";
}

register_shutdown_function("boo");

set_time_limit(1);

/* infinite loop to simulate long processing */
for (;;) {}

echo "End\n";

?>
--EXPECTF--
Start

Fatal error: Maximum execution time of 1 second exceeded in %s on line %d
Shutdown
