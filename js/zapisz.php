<?php
function read_and_delete_first_line($filename) {
  $file = file($filename);
  $output = $file[0];
  unset($file[0]);
  file_put_contents($filename, $file);
  return $output;
}
$msg = $_REQUEST["m"];
$name="chat.txt";
$linecount = 0;
$handle = fopen($name, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $linecount++;
}
echo $linecount;
if($linecount > 10 )
{
    $filename = "chat.txt";
    read_and_delete_first_line($filename);
    $myfile = file_put_contents('chat.txt', $msg.PHP_EOL , FILE_APPEND | LOCK_EX);
}
else
{
    $myfile = file_put_contents('chat.txt', $msg.PHP_EOL , FILE_APPEND | LOCK_EX);
}
?>