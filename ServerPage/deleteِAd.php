<?php
include('config.php');

// استلام ID المستخدم
$ID = isset($_GET['id']) ? intval($_GET['id']) : null;

// التأكد من أن ID موجود
if (!$ID) {
    echo "ID is required.";
    exit;
}

try {
    // بدء المعاملة (Transaction)
    $con->begin_transaction();

    // جلب بيانات المستخدم من الجدول الأول
    $selectStmt = $con->prepare("SELECT username, password, privileges, entercode, ProfilePhoto, UploadingFile, md5_pass FROM users WHERE id = ?");
    $selectStmt->bind_param("i", $ID);
    $selectStmt->execute();
    $result = $selectStmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("User with ID $ID not found.");
    }

    // الحصول على البيانات من الجدول الأول
    $userData = $result->fetch_assoc();

    // إضافة البيانات إلى الجدول الثاني
    $insertStmt = $con->prepare("
        INSERT INTO deleteusers (username, password, privileges, entercode, ProfilePhoto, UploadingFile, md5_pass) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $insertStmt->bind_param(
        "sssssss",
        $userData['username'],
        $userData['password'],
        $userData['privileges'],
        $userData['entercode'],
        $userData['ProfilePhoto'],
        $userData['UploadingFile'],
        $userData['md5_pass']
    );
    $insertStmt->execute();

    if ($insertStmt->affected_rows === 0) {
        throw new Exception("Failed to insert data into deleteusers.");
    }

    // حذف البيانات من الجدول الأول
    $deleteStmt = $con->prepare("DELETE FROM users WHERE id = ?");
    $deleteStmt->bind_param("i", $ID);
    $deleteStmt->execute();

    if ($deleteStmt->affected_rows === 0) {
        throw new Exception("Failed to delete the user from users.");
    }

    // تأكيد التغييرات
    $con->commit();

    // إعادة التوجيه
    header('Location: ../ClintPages/Users.php');
    exit;

} catch (Exception $e) {
    // في حالة حدوث خطأ، يتم التراجع عن التغييرات
    $con->rollback();
    echo "Error: " . $e->getMessage();
}

// إغلاق الموارد
if (isset($selectStmt)) $selectStmt->close();
if (isset($insertStmt)) $insertStmt->close();
if (isset($deleteStmt)) $deleteStmt->close();
$con->close();
?>
