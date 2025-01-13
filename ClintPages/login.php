<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="this is a login page for user and admin (HTML + PHP + MySQL)">
    <meta name="author" content="Mais Sarhan">
    <meta name="keywords" content="PTUK, CSE, Kadoorie, Web, Login">
    <link rel="shortcut icon" href="../sourse/photo/logo.png">
    <link rel="stylesheet" href="../sourse/css/login.css">
    <title>Login page</title>
</head>
<body>
    <div class="container">
        <h1>Login in</h1>
        <form action="../ServerPage/login.php" method="post" target="_blank">
            <label for="usernm">username : </label>
            <input type="text" id="usernm" name="username" placeholder="username" required>
            <br>
            <label for="password">password : </label>
            <input type="password" id="password" name="password" size="20" maxlength="20" placeholder="password" required>
            <br>
            <input type="submit" value="login">
            <br>
            <a href="register.php">Register</a>
        </form>
    </div>
</body>
</html>