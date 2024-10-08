--TEST--
mysqli_stmt_free_result()
--EXTENSIONS--
mysqli
--SKIPIF--
<?php
require_once 'skipifconnectfailure.inc';
?>
--FILE--
<?php
    /*
    NOTE: no datatype tests here! This is done by
    mysqli_stmt_bind_result.phpt already. Restrict
    this test case to the basics.
    */
    require 'table.inc';

    if (!$stmt = mysqli_stmt_init($link))
        printf("[003] [%d] %s\n", mysqli_errno($link), mysqli_error($link));

    // stmt object status test
    try {
        mysqli_stmt_free_result($stmt);
    } catch (Error $exception) {
        echo $exception->getMessage() . "\n";
    }

    if (!mysqli_stmt_prepare($stmt, "SELECT id, label FROM test ORDER BY id"))
        printf("[005] [%d] %s\n", mysqli_stmt_errno($stmt), mysqli_stmt_error($stmt));

    mysqli_stmt_free_result($stmt);

    if (!mysqli_stmt_execute($stmt))
        printf("[007] [%d] %s\n", mysqli_stmt_errno($stmt), mysqli_stmt_error($stmt));

    mysqli_stmt_free_result($stmt);

    if (false !== ($tmp = mysqli_stmt_store_result($stmt)))
        printf("[009] Expecting boolean/false, got %s/%s\n", gettype($tmp), $tmp);

    mysqli_stmt_close($stmt);

    if (!$stmt = mysqli_stmt_init($link))
        printf("[010] [%d] %s\n", mysqli_errno($link), mysqli_error($link));

    if (!mysqli_stmt_prepare($stmt, "SELECT id, label FROM test ORDER BY id"))
        printf("[011] [%d] %s\n", mysqli_stmt_errno($stmt), mysqli_stmt_error($stmt));

    if (!mysqli_stmt_execute($stmt))
        printf("[012] [%d] %s\n", mysqli_stmt_errno($stmt), mysqli_stmt_error($stmt));

    if (true !== ($tmp = mysqli_stmt_store_result($stmt)))
        printf("[013] Expecting boolean/true, got %s/%s\n", gettype($tmp), $tmp);

    mysqli_stmt_free_result($stmt);

    mysqli_stmt_close($stmt);

    try {
        mysqli_stmt_free_result($stmt);
    } catch (Error $exception) {
        echo $exception->getMessage() . "\n";
    }

    mysqli_close($link);

    print "done!";
?>
--CLEAN--
<?php
    require_once 'clean_table.inc';
?>
--EXPECT--
mysqli_stmt object is not fully initialized
mysqli_stmt object is already closed
done!
