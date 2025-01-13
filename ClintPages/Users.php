<!DOCTYPE html>
<html lang="en">
<head>
    <!-- رابط Bootstrap للحصول على التصميم الجاهز للبطاقات والأزرار -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" Account Creation with Privileges and File Upload (HTML + PHP)">
    <meta name="author" content="Mais Sarhan">
    <meta name="keywords" content="PTUK, CSE, Kadoorie, Web, Login">
    <link rel="shortcut icon" href="../sourse/photo/logo.png">
    <title>Users</title>
    <link rel="stylesheet" href="../sourse/css/Users.css">
</head>
<body>
    <center>
        <h3>لوحة التحكم لجميع المستخدمين المتوفرة </h3>
    </center>
    <!-- لعرض المستخدمين -->
    <div class="container">
        <a href="register.php" class='btn btn-primary' style=height:50px>add</a>
        <?php
        include('../ServerPage/config.php');
        $result = mysqli_query($con, "SELECT * FROM users");

        while($row = mysqli_fetch_array($result)) {
            echo "
            <div class='card'>
                <img src='$row[ProfilePhoto]' class='card-img-top' alt='Product Image'>
                <div class='card-body'>
                    <h5 class='card-title'>id:$row[id]</h5>
                    <h5 class='card-title'>username:$row[username]</h5>
                    <p class='card-text'>password:$row[password] </p>
                    <p class='card-text'>privileges:$row[privileges] </p>
                    <a href='$row[UploadingFile]' class='card-img-top' alt='File'><img src='../sourse/photo/file.png' class='pdf' width='50px' height='30px'><h6>$row[UploadingFile]</h6></a>
                    <div class='col-sm'>
                    <a href='updateAd.php?id=$row[id]' class='btn btn-primary col-sm-12'>update user</a>
                    <a href='../ServerPage/deleteِAd.php?id=$row[id]' class='btn btn-danger col-sm-12' onclick='return confirmDelete(event, this.href);''> Delete User</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
    <center>
        <h3>لوحة التحكم لجميع المستخدمين المحذوفين </h3>
    </center>
    <div class="container">
        <?php
        include('../ServerPage/config.php');
        $result = mysqli_query($con, "SELECT * FROM deleteusers");

        while($row = mysqli_fetch_array($result)) {
            echo "
            <div class='card'>
                <img src='$row[ProfilePhoto]' class='card-img-top' alt='Product Image' width='100px' height='100px'>
                <div class='card-body'>
                    <h5 class='card-title'>username:$row[username]</h5>
                    <p class='card-text'>password:$row[password] </p>
                    <p class='card-text'>privileges:$row[privileges] </p>
                    <a href='$row[UploadingFile]' class='card-img-top' alt='File'><img src='../sourse/photo/file.png' class='pdf' width='50px' height='30px'><h6>$row[UploadingFile]</h6></a>
                </div>
            </div>";
        }
        ?>
    </div>
    <p>Developer Mais</p>

    <!-- رابط Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
// Function to show confirmation dialog
function confirmDelete(event, url) {
    // Prevent the default action (navigation)
    event.preventDefault();

    // Display the confirmation prompt
    const userConfirmed = confirm("Are you sure you want to delete this user?");

    // If user confirms, redirect to the URL
    if (userConfirmed) {
        window.location.href = url;
    }
    // If canceled, do nothing
    return false;
}
</script>
</body>
</html>
<!-- <iframe src='$row[UploadingFile]' class='card-img-top' alt='File'></iframe>-->