<?php
// الاتصال بقاعدة البيانات
$con = new mysqli('localhost', 'root', '', 'webass');

// التحقق من نجاح الاتصال
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// هنا يتم تنفيذ أي استعلامات أخرى بعد هذا السطر
?>
