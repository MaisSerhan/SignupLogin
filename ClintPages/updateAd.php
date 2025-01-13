<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" Account Creation with Privileges and File Upload (HTML + PHP)">
    <meta name="author" content="Mais Sarhan">
    <meta name="keywords" content="PTUK, CSE, Kadoorie, Web, Login">
    <link rel="shortcut icon" href="../sourse/photo/logo.png">
    <title>update the user data</title>
    <link rel="stylesheet" href="../sourse/css/Users.css">
</head>
<body>
    <?php
    include('../ServerPage/config.php');
    $ID = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$ID) {
        echo "ID is missing.";
        exit;
    }

    // استخدام استعلام محضر لتفادي ثغرات SQL Injection
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // تأكد من وجود البيانات
    if (!$data) {
        echo "No User found with this ID.";
        exit;
    }
    ?>
    <?php 
        if(isset($priv_error)){
            echo$priv_error;
        }
    ?>
    <center>
        <div class="main">
            <form action="../ServerPage/upAD.php" method="post" enctype="multipart/form-data">
                <h2>user data update</h2>
                <input type="text" name="id" value='<?php echo $data['id']; ?>'>
                <br>
                <input type="text" name="username" placeholder="username" value='<?php echo $data['username']; ?>'>
                <br>
                <input type="text" name="password" placeholder="password" value='<?php echo $data['password']; ?>'>
                <input type="text" name="privileges" placeholder="privileges" value='<?php echo $data['privileges']; ?>'>
                <br>
                <input type="file" id="photo" name="photo"  style="display: none;" accept=".png, .jpg, .jpeg">
                <label for="photo" name="photo">تحديث صورة الملف</label>
                <button name="update">تعديل للصفحة</button>
                <input type="file" id="file" name="uploading" style="display: none;" accept=".pdf, .docx, .xlsx">
                <label for="file">تحديث الملف </label>
                <br>
                <a href="Users.php">show all users</a>
            </form>
        </div>
        <p>Developer Mais</p>
    </center>
</body>
</html>
