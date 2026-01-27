<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
  </head>
  <body>
    <div class="login-container">
      <h2>Login</h2>
      <form action="index.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input onclick="location.href='admin/data-pengaduan.php'"type="submit" value="Login">
      </form>
    </div>
  </body>
</html>