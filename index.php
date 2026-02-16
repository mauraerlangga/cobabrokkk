<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap-login">
        <h1 class="greet-welcome">Selamat Datang Di CareSapras</h1><br>
        <div class="wrap-fomlog">
            <h2 style="font-size: 40px;">Login</h2>

            <form action="proses-login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required><br><br>

                <input type="password" name="password" placeholder="Password" required><br><br>

                <button type="submit" class="btn-login">Login</button>
            </form>

        </div>

    </div>
</body>
</html>
