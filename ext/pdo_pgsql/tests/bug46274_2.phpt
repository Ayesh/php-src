--TEST--
Bug #46274 (pdo_pgsql - Segfault when using PDO::ATTR_STRINGIFY_FETCHES and blob)
--EXTENSIONS--
pdo_pgsql
--SKIPIF--
<?php
require __DIR__ . '/config.inc';
require __DIR__ . '/../../../ext/pdo/tests/pdo_test.inc';
PDOTest::skip();
?>
--FILE--
<?php
require __DIR__ . '/../../../ext/pdo/tests/pdo_test.inc';
$db = PDOTest::test_factory(__DIR__ . '/common.phpt');

$db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);

try {
        @$db->query("SET bytea_output = 'escape'");
} catch (Exception $e) {
}

$db->query('CREATE TABLE test_one_blob_46274_2 (id SERIAL NOT NULL, blob1 BYTEA)');

$stmt = $db->prepare("INSERT INTO test_one_blob_46274_2 (blob1) VALUES (:foo)");

$data = 'foo';
$blob = fopen('php://memory', 'a');
fwrite($blob, $data);
rewind($blob);

$stmt->bindparam(':foo', $blob, PDO::PARAM_LOB);
$stmt->execute();

$blob = '';
$stmt->bindparam(':foo', $blob, PDO::PARAM_LOB);
$stmt->execute();

$data = '';
$blob = fopen('php://memory', 'a');
fwrite($blob, $data);
rewind($blob);

$stmt->bindparam(':foo', $blob, PDO::PARAM_LOB);
$stmt->execute();

$blob = NULL;
$stmt->bindparam(':foo', $blob, PDO::PARAM_LOB);
$stmt->execute();

$res = $db->query("SELECT blob1 from test_one_blob_46274_2");
// Resource
var_dump($x = $res->fetch());
var_dump(fread($x['blob1'], 10));

// Resource
var_dump($res->fetch());
var_dump(fread($x['blob1'], 10));

// Resource
var_dump($res->fetch());
var_dump(fread($x['blob1'], 10));

// NULL
var_dump($res->fetch());
?>
--CLEAN--
<?php
require __DIR__ . '/../../../ext/pdo/tests/pdo_test.inc';
$db = PDOTest::test_factory(__DIR__ . '/common.phpt');
$db->query('DROP TABLE IF EXISTS test_one_blob_46274_2');
?>
--EXPECTF--
array(2) {
  ["blob1"]=>
  resource(%d) of type (stream)
  [0]=>
  resource(%d) of type (stream)
}
string(3) "foo"
array(2) {
  ["blob1"]=>
  resource(%d) of type (stream)
  [0]=>
  resource(%d) of type (stream)
}
string(0) ""
array(2) {
  ["blob1"]=>
  resource(%d) of type (stream)
  [0]=>
  resource(%d) of type (stream)
}
string(0) ""
array(2) {
  ["blob1"]=>
  NULL
  [0]=>
  NULL
}
