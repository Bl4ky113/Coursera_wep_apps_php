<?php

$OPTIONS_ARR = array('Rock', 'Paper', 'Scissors');

if (!key_exists('name', $_GET)) {
  die("Name parameter missing");
}

$username = $_GET['name'];
$match_results = 'Please select a strategy and press Play.';

if (key_exists('logout', $_POST)) {
  header('Location: index.php');
  return;
}

if (key_exists('human', $_POST)) {
  $user_option = (int) $_POST['human'];
  $server_option = rand(0, 2);

  if ($user_option >= 0 && $user_option <= 2) {
    $result = check($user_option, $server_option);
    $match_results = "Your Play=$OPTIONS_ARR[$user_option] Computer Play=$OPTIONS_ARR[$server_option] Result=$result\n";
  } else if ($user_option === 3) {
    $match_results = '';
    for ($user_option = 0; $user_option < 3; $user_option++) {
      for ($server_option = 0; $server_option < 3; $server_option++) {
        $result = check($user_option, $server_option);
        $match_results = $match_results . "Human=$OPTIONS_ARR[$user_option] Computer=$OPTIONS_ARR[$server_option] Result=$result\n";
      }
    }
  } 
}

function check ($option_choosen, $option_computer) {
  $option_choosen++; // So it doesn't 0 / 0
  $option_computer++;

  if ($option_choosen === $option_computer) {
    return 'Tie';
  } 

  $losing_option = ($option_choosen + 1) % 3;
  
  if ($option_computer == $losing_option) {
    return 'You Lose';
  } else {
    return 'You Win';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>e595428d - Martín's R.P.S</title>
  <style>
    * {
      font-family: Arial;
    }
  </style>
</head>
<body>
  <header>
    <h1>Rock, Paper and Scissors</h1>
  </header>
  <main>
    <h4>
      Welcome: <?= $username?>
    </h4>
    <form method="POST">
      <select 
        id=""
        name="human">
        <option value=-1>select</option>
        <option value=0>Rock</option>
        <option value=1>Paper</option>
        <option value=2>Scissors</option>
        <option value=3>Test</option>
      </select>
      <input 
        value="Play" 
        type="submit">
      <br>
      <br>
      <input 
        name="logout"
        value="Logout"
        type="submit">
    </form>
    <pre><?= $match_results ?></pre>
  </main>
</body>
</html>
