<?php
$output_text = 'Enter a 4-digit pin to hash with MD5';

if (isset($_GET['pin'])) {
  $pin = $_GET['pin'];

  while (strlen($pin) < 4) {
    $pin = '0' . $pin;
  }

  echo $pin . ' ';

  $pin_hashed = hash('md5', $pin);

  echo $pin_hashed;

  $output_text = "Your pin's MD5 Hash is:\t\t$pin_hashed";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Martín Hernández - MD5 Generator</title>
</head>
<body>
  <h1>MD5 Generator</h1>
  <p>
    <?= $output_text?>
  </p>
  <form>
    <input
      type="number"
      min=0
      max=9999
      name="pin">
    <input
      type="submit"
      value="Generate MD5 Hash for the Pin">
  </form>
  <ul>
    <li>
      <a href="./index.php<?= isset($_GET['pin']) ? "?md5=$pin_hashed" : '' ?>">MD5 Hash Cracker</a>
    </li>
    <li>
      <a href="./md5.php">MD5 Hash generator</a>
    </li>
  </ul>
</body>
</html>
