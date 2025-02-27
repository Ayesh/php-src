--TEST--
avif decoding/encoding tests
--EXTENSIONS--
gd
--SKIPIF--
<?php
    if (!function_exists("imagecreatefrompng") || !function_exists("imagepng")) {
        die("skip png support unavailable");
    }
    if (!function_exists("imagecreatefromavif") || !function_exists("imageavif")) {
        die("skip avif support unavailable");
    }
?>
--FILE--
<?php

    require_once __DIR__ . '/func.inc';

    $infile = __DIR__  . '/girl.avif';
    $outfile = __DIR__  . '/test.avif';

    echo 'Decoding AVIF image: ';
    $img = imagecreatefromavif($infile);
    echo_status($img);

    echo 'Default AVIF encoding: ';
    echo_status(imageavif($img, $outfile));

    echo 'Encoding AVIF at quality 70: ';
    echo_status(imageavif($img, $outfile, 70));

    echo 'Encoding AVIF at quality 70 with speed 5: ';
    echo_status(imageavif($img, $outfile, 70, 5));

    echo 'Encoding AVIF with default quality: ';
    echo_status(imageavif($img, $outfile, -1));

    echo 'Encoding AVIF with illegal quality: ';
    try {
    	imageavif($img, $outfile, 1234);
    } catch (\ValueError $e) {
        echo $e->getMessage() . PHP_EOL;
    }

    echo 'Encoding AVIF with illegal speed: ';

    try {
    	imageavif($img, $outfile, 70, 1234);
    } catch (\ValueError $e) {
        echo $e->getMessage() . PHP_EOL;
    }

    echo 'Encoding AVIF losslessly... ';
    echo_status(imageavif($img, $outfile, 100, 0));

    echo "Decoding the AVIF we just wrote...\n";
    $img_from_avif = imagecreatefromavif($outfile);

    // Note we could also forgive a certain number of pixel differences.
    // With the current test image, we just didn't need to.
    echo 'What is the mean squared error of the two images? ',
        mse($img, $img_from_avif);

    unlink($outfile);


    function echo_status($success) {
        echo $success ? "ok\n" : "failed\n";
    }
?>

--EXPECT--
Decoding AVIF image: ok
Default AVIF encoding: ok
Encoding AVIF at quality 70: ok
Encoding AVIF at quality 70 with speed 5: ok
Encoding AVIF with default quality: ok
Encoding AVIF with illegal quality: imageavif(): Argument #3 ($quality) must be between -1 and 100
Encoding AVIF with illegal speed: imageavif(): Argument #4 ($speed) must be between -1 and 10
Encoding AVIF losslessly... ok
Decoding the AVIF we just wrote...
What is the mean squared error of the two images? 0
