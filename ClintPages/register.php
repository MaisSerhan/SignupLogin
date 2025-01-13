<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" Account Creation with Privileges and File Upload (HTML + PHP)">
    <meta name="author" content="Mais Sarhan">
    <meta name="keywords" content="PTUK, CSE, Kadoorie, Web, Login">
    <link rel="shortcut icon" href="../sourse/photo/logo.png">
    <link rel="stylesheet" href="../sourse/css/register.css">
    <title>Register</title>
</head>
<body>
    <h1>Register for Account Creation</h1>
    <form action="../ServerPage/register_POST.php" method="post" enctype="multipart/form-data" target="_blank">
    <?php 
        if(isset($user_error)){
            echo$user_error;
        }
        ?>
        <label for="usernm">user name : </label>
        <input type="text" id="usernm" name="username" placeholder="username" required>
        <br>
        <?php 
        if(isset($password_error)){
            echo$password_error;
        }
        ?>
        <label for="password">password : </label>
        <input type="password" id="password" name="password" size="20" maxlength="20" placeholder="password" required>
        <br>
        <?php 
        if(isset($priv_error)){
            echo$priv_error;
        }
        ?>
        <label for="priv">privileges : </label>
        <select name="priv" title="priv choose User or Admin" onchange="checkPrivilege()" id="priv" required>
            <option disabled selected>choose</option>
            <option >User</option>
            <option >Admin</option>
        </select>
        <br>
        <div class="code" id="contcode">
        <?php 
        if(isset($code_error)){
            echo$code_error;
        }
        ?>
            <label for="code">enter code : </label>
            <input id="code" type="text" name="code">
        </div>
        <br>
        <label for="photo">Profile Photo : </label>
        <input type="file" id="photo" name="photo" accept=".png, .jpg, .jpeg" required>
        <br>
        <label for="file">Uploading File : </label>
        <input type="file" id="file" name="uploading" required accept=".pdf, .docx, .xlsx">
        <br>
        <input type="submit"name="upload" value="Register">
    </form>
    <script src="../sourse/js/register.js"></script>
</body>
</html>