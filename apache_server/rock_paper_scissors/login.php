<?php
function handle_login () {
  $salt = 'XyZzy12*_';
  $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

  if (count($_POST) <= 0) {
    return 'Enter your username and password to log in';
  }

  if ((key_exists('who', $_POST) && $_POST['who'] === '') || (key_exists('pass', $_POST) && $_POST['pass'] === '')) {
    return 'User name and password are required';
  }

  if ($stored_hash !== hash('md5', $salt . $_POST['pass'])) {
    return 'Incorrect password';
  }

  header("Location: game.php?name=" . urlencode($_POST['who']));
  return 'Redirecting...';
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
    <h1>Login</h1>
  </header>
  <main>
    <p>
      <b><?= handle_login() ?></b>
    </p>
    <form
      method="POST">
      <label for="username">
        User name:
      </label>
      <input
        id="username"
        name="who"
        type="text">
      <label for="password">
        User password:
      </label>
      <input
        id="password"
        name="pass"
        type="password">
      <br>
      <input
        value="Log In"
        type="submit">
    </form>
    <p>
      <!-- Hey, the password is: php123 -->
    </p>
  </main>
</body>
</html>
