--TEST--
SplFileObject::fputcsv(): Usage variations -- with default enclosure value
--FILE--
<?php

/* Testing fputcsv() to write to a file when default enclosure value is provided */

echo "*** Testing fputcsv() : with default enclosure value ***\n";

/* the array is with three elements in it. Each element should be read as
   1st element is delimiter, 2nd element is enclosure
   and 3rd element is csv fields
*/
$csv_lists = array (
  array(',', '"', array('water,fruit') ),
  array(',', '"', array('"water","fruit') ),
  array(',', '"', array('"water","fruit"') ),
  array(' ', '^', array('^water^ ^fruit^')),
  array(':', '&', array('&water&:&fruit&')),
  array('=', '=', array('=water===fruit=')),
  array('-', '-', array('-water--fruit-air')),
  array('-', '-', array('-water---fruit---air-')),
  array(':', '&', array('&""""&:&"&:,:":&,&:,,,,'))

);
$file_path = __DIR__;
$file = "$file_path/fputcsv_variation11.tmp";

$file_modes = array ("r+", "r+b", "r+t",
                     "a+", "a+b", "a+t",
                     "w+", "w+b", "w+t",
                     "x+", "x+b", "x+t");

$loop_counter = 1;
foreach ($csv_lists as $csv_list) {
  for($mode_counter = 0; $mode_counter < count($file_modes); $mode_counter++) {

    echo "\n-- file opened in $file_modes[$mode_counter] --\n";
    // create the file and add the content with has csv fields
    if ( strstr($file_modes[$mode_counter], "r") ) {
      $fo = new SplFileObject($file, 'w');
    } else {
      $fo = new SplFileObject($file, $file_modes[$mode_counter]);
    }
    $fo->setCsvControl(escape: '\\');

    $delimiter = $csv_list[0];
    $enclosure = $csv_list[1];
    $csv_field = $csv_list[2];

    // write to a file in csv format
    var_dump( $fo->fputcsv($csv_field, $delimiter) );
    // check the file pointer position and eof
    var_dump( $fo->ftell() );
    var_dump( $fo->eof() );
    //close the file
    unset($fo);

    // print the file contents
    var_dump( file_get_contents($file) );

    //delete file
    unlink($file);
  } //end of mode loop
} // end of foreach

echo "Done\n";
?>
--EXPECTF--
*** Testing fputcsv() : with default enclosure value ***

-- file opened in r+ --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in r+b --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in r+t --
int(14)
int(14)
bool(false)
string(%d) ""water,fruit"
"

-- file opened in a+ --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in a+b --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in a+t --
int(14)
int(14)
bool(false)
string(%d) ""water,fruit"
"

-- file opened in w+ --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in w+b --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in w+t --
int(14)
int(14)
bool(false)
string(%d) ""water,fruit"
"

-- file opened in x+ --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in x+b --
int(14)
int(14)
bool(false)
string(14) ""water,fruit"
"

-- file opened in x+t --
int(14)
int(14)
bool(false)
string(%d) ""water,fruit"
"

-- file opened in r+ --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in r+b --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in r+t --
int(20)
int(20)
bool(false)
string(%d) """"water"",""fruit"
"

-- file opened in a+ --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in a+b --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in a+t --
int(20)
int(20)
bool(false)
string(%d) """"water"",""fruit"
"

-- file opened in w+ --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in w+b --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in w+t --
int(20)
int(20)
bool(false)
string(%d) """"water"",""fruit"
"

-- file opened in x+ --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in x+b --
int(20)
int(20)
bool(false)
string(20) """"water"",""fruit"
"

-- file opened in x+t --
int(20)
int(20)
bool(false)
string(%d) """"water"",""fruit"
"

-- file opened in r+ --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in r+b --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in r+t --
int(22)
int(22)
bool(false)
string(%d) """"water"",""fruit"""
"

-- file opened in a+ --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in a+b --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in a+t --
int(22)
int(22)
bool(false)
string(%d) """"water"",""fruit"""
"

-- file opened in w+ --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in w+b --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in w+t --
int(22)
int(22)
bool(false)
string(%d) """"water"",""fruit"""
"

-- file opened in x+ --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in x+b --
int(22)
int(22)
bool(false)
string(22) """"water"",""fruit"""
"

-- file opened in x+t --
int(22)
int(22)
bool(false)
string(%d) """"water"",""fruit"""
"

-- file opened in r+ --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in r+b --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in r+t --
int(18)
int(18)
bool(false)
string(%d) ""^water^ ^fruit^"
"

-- file opened in a+ --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in a+b --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in a+t --
int(18)
int(18)
bool(false)
string(%d) ""^water^ ^fruit^"
"

-- file opened in w+ --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in w+b --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in w+t --
int(18)
int(18)
bool(false)
string(%d) ""^water^ ^fruit^"
"

-- file opened in x+ --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in x+b --
int(18)
int(18)
bool(false)
string(18) ""^water^ ^fruit^"
"

-- file opened in x+t --
int(18)
int(18)
bool(false)
string(%d) ""^water^ ^fruit^"
"

-- file opened in r+ --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in r+b --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in r+t --
int(18)
int(18)
bool(false)
string(%d) ""&water&:&fruit&"
"

-- file opened in a+ --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in a+b --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in a+t --
int(18)
int(18)
bool(false)
string(%d) ""&water&:&fruit&"
"

-- file opened in w+ --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in w+b --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in w+t --
int(18)
int(18)
bool(false)
string(%d) ""&water&:&fruit&"
"

-- file opened in x+ --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in x+b --
int(18)
int(18)
bool(false)
string(18) ""&water&:&fruit&"
"

-- file opened in x+t --
int(18)
int(18)
bool(false)
string(%d) ""&water&:&fruit&"
"

-- file opened in r+ --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in r+b --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in r+t --
int(18)
int(18)
bool(false)
string(%d) ""=water===fruit="
"

-- file opened in a+ --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in a+b --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in a+t --
int(18)
int(18)
bool(false)
string(%d) ""=water===fruit="
"

-- file opened in w+ --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in w+b --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in w+t --
int(18)
int(18)
bool(false)
string(%d) ""=water===fruit="
"

-- file opened in x+ --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in x+b --
int(18)
int(18)
bool(false)
string(18) ""=water===fruit="
"

-- file opened in x+t --
int(18)
int(18)
bool(false)
string(%d) ""=water===fruit="
"

-- file opened in r+ --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in r+b --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in r+t --
int(20)
int(20)
bool(false)
string(%d) ""-water--fruit-air"
"

-- file opened in a+ --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in a+b --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in a+t --
int(20)
int(20)
bool(false)
string(%d) ""-water--fruit-air"
"

-- file opened in w+ --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in w+b --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in w+t --
int(20)
int(20)
bool(false)
string(%d) ""-water--fruit-air"
"

-- file opened in x+ --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in x+b --
int(20)
int(20)
bool(false)
string(20) ""-water--fruit-air"
"

-- file opened in x+t --
int(20)
int(20)
bool(false)
string(%d) ""-water--fruit-air"
"

-- file opened in r+ --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in r+b --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in r+t --
int(24)
int(24)
bool(false)
string(%d) ""-water---fruit---air-"
"

-- file opened in a+ --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in a+b --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in a+t --
int(24)
int(24)
bool(false)
string(%d) ""-water---fruit---air-"
"

-- file opened in w+ --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in w+b --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in w+t --
int(24)
int(24)
bool(false)
string(%d) ""-water---fruit---air-"
"

-- file opened in x+ --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in x+b --
int(24)
int(24)
bool(false)
string(24) ""-water---fruit---air-"
"

-- file opened in x+t --
int(24)
int(24)
bool(false)
string(%d) ""-water---fruit---air-"
"

-- file opened in r+ --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in r+b --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in r+t --
int(32)
int(32)
bool(false)
string(%d) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in a+ --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in a+b --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in a+t --
int(32)
int(32)
bool(false)
string(%d) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in w+ --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in w+b --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in w+t --
int(32)
int(32)
bool(false)
string(%d) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in x+ --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in x+b --
int(32)
int(32)
bool(false)
string(32) ""&""""""""&:&""&:,:"":&,&:,,,,"
"

-- file opened in x+t --
int(32)
int(32)
bool(false)
string(%d) ""&""""""""&:&""&:,:"":&,&:,,,,"
"
Done
