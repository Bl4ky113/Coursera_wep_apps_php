<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Martin Steven Hernández Ortiz | e595428d</title>
</head>
<body>
  <h1>The Guessging Game</h1>
  <p>
    <?php
      $correct_value = 47;   
      $guess_passed = array_key_exists('guess', $_GET);
      $guessing_value;
    
      if (!$guess_passed) {
        echo 'Missing guess parameter';
        exit;
      }

      $guessing_value = $_GET['guess'];

      if ($guessing_value == '') {
        echo 'Your guess is too short';
        exit;
      }

      if (!is_numeric($guessing_value)) {
        echo 'Your guess is not a number';
        exit;
      }

      if ($guessing_value < $correct_value) {
        echo 'Your guess is too low';
        exit;
      } else if ($guessing_value > $correct_value) {
        echo 'Your guess is too high';
        exit;
      } else {
        echo 'Congratulations - You are right';
        exit;
      }
    ?>
  </p>
</body>
</html>
