<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Martín Hernández - MD5 Cracker</title>
</head>
<body>
  <h1>
    MD5 Hash Cracker
  </h1>
  <pre>
Debug Output:
<?php
/*
 * Some of the MD5 Hashes to crack:
 * 0bd65e799153554726820ca639514029
 * aa36c88c27650af3b9868b723ae15dfc
 * 1ca906c1ad59db8f11643829560bab55
 * 1d8d70dddf147d2d92a634817f01b239
 * acf06cdd9c744f969958e1f085554c8b
 */

$DEBUG_OUTPUT_MAX = 15;
$PIN_LENGTH = 4;

$output_text = 'MD5 Hash not found';

if (isset($_GET['md5'])) {
  $time_start = microtime(true);
  $md5_hash = $_GET['md5'];

  for ($i = 0; $i <= 9999; $i++) {
    $number_str = (string) $i;
      
    while (strlen($number_str) < $PIN_LENGTH) {
      $number_str = '0' . $number_str;
    }

    $md5_base = hash('md5', $number_str);

    if ($i <= $DEBUG_OUTPUT_MAX) {
      echo "$md5_base\t$number_str\n";
    }

    if ($md5_base == $md5_hash) {
      $output_text = "MD5 Hash is $number_str";
      break;
    }

    $output_text = 'Error craking the MD5 Hash';
  }

  $time_end = microtime(true);
  echo "\nTime Elapsed:\n" . $time_end - $time_start . "\tmicroseconds\n";
}
?>
  </pre>
  <form>
    <input
      value="<?= isset($_GET['md5']) ? $md5_hash : '' ?>"
      type="text"
      name="md5"
      size="40">
    <input 
      type="submit"
      value="Crack MD5">
  </form>
  <br>
  <p>
    Result: <?= $output_text?>
  </p>
  <br> 
  <ul>
    <li>
      <a href="./index.php">MD5 Hash Cracker</a>
    </li>
    <li>
      <a href="./md5.php">MD5 Hash generator</a>
    </li>
  </ul>
</body>
</html>
