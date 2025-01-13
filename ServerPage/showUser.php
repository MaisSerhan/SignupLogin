<?php
session_start();
include('config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php'); // إعادة التوجيه إلى صفحة تسجيل الدخول إذا لم يكن هناك جلسة
    exit();
}

$id = $_SESSION['id']; // جلب معرف المستخدم من الجلسة

// جلب بيانات المستخدم من قاعدة البيانات
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<p>لا توجد بيانات متاحة لهذا المستخدم.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" Account Creation with Privileges and File Upload (HTML + PHP)">
    <meta name="author" content="Mais Sarhan">
    <meta name="keywords" content="PTUK, CSE, Kadoorie, Web, Login">
    <link rel="shortcut icon" href="../sourse/photo/logo.png">
    <title>بيانات المستخدم</title>
    <!-- رابط Bootstrap للحصول على التصميم الجاهز للبطاقات والأزرار -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../sourse/css/Users.css"> <!-- تعديل المسار حسب الحاجة -->
</head>
<body>
<div class="container">
    <div class="card">
        <img src="<?= $user['ProfilePhoto']; ?>" class="card-img-top" alt="Profile Photo">
        <div class="card-body">
            <h5 class="card-title">اسم المستخدم: <?= htmlentities($user['username']); ?></h5>
            <p class="card-text">كلمة المرور: <?= htmlentities($user['password']); ?></p>
            <p class="card-text">الصلاحيات: <?= htmlentities($user['privileges']); ?></p>
            <?php if (!empty($user['UploadingFile'])): ?>
                <a href="<?= $user['UploadingFile']?>" class="card-img-top" title="Uploaded File"><img src='../sourse/photo/file.png' class='pdf' width='50px' height='30px'><h6><?= $user['UploadingFile']?></h6></a>
            <?php else: ?>
                <p>لا يوجد ملف مرفوع.</p>
            <?php endif; ?>
            <a href="deleteUser.php?id=<?= $user['id']; ?>" class='btn btn-danger col-sm-12' class='btn btn-danger col-sm-12' onclick='return confirmDelete(event, this.href);'> Delete User</a>
            <a href="../ClintPages/updateUser.php?id=<?= $user['id']; ?>"  class='btn btn-primary col-sm-12'>Update user</a>

            <br>
            <br>
        </div>
    </div>
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
