--TEST--
imagecreatefromstring() - WEBP format
--EXTENSIONS--
gd
--SKIPIF--
<?php
if (!(imagetypes() & IMG_WEBP)) die('skip AVIF support required');
?>
--FILE--
<?php
// create an image from a WEBP string representation
$im = imagecreatefromstring(file_get_contents(__DIR__ . '/girl.avif'));
var_dump(imagesx($im));
var_dump(imagesy($im));

?>
--EXPECT--
int(407)
int(484)
