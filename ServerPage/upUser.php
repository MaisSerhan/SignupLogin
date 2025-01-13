<?php
include('config.php');

if (isset($_POST['update'])) {

    // استدعاء ID والاسم وكلمة السر والصورة من النموذج
    $ID = mysqli_real_escape_string($con, $_POST['id']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $privileges = "User";

    $IMAGE = $_FILES['photo']['name'];
    
    $image_location =  $_FILES['photo']['tmp_name']; // مسار الصورة المؤقت
    $image_name = $_FILES['photo']['name']; // اسم الصورة
    $date_time = date("Ymd_His"); // Date and time format

    // New file names
    $image_name = "photo_{$date_time}_".basename($image_name);
    $image_up = "../sourse/photo/" . $image_name;
    $photo_name_parts = explode('.', $image_name); // First assign explode() result to a variable
    $photo_ext = strtolower(end($photo_name_parts)); // Pass the variable to end()
    
    $expen=array("jpeg","jpg","png");
    if(in_array($photo_ext, $expen)===false){
        $priv_error = '<p class="error">extention not allowed</p>';
        $err_s = 1;
    }
    $UploadingFile = $_FILES['uploading']['name'];
    $UploadingFile_location =  $_FILES['uploading']['tmp_name']; // مسار الصورة المؤقت
    $UploadingFile_name = $_FILES['uploading']['name']; // اسم الصورة
    $date_time = date("Ymd_His"); // Date and time format
    
    $expen=array("pdf","docx","xlsx");
    $file_name_parts = explode('.', $UploadingFile); // First assign explode() result to a variable
    $file_ext = strtolower(end($file_name_parts)); // Pass the variable to end()
    
    if(in_array($file_ext, $expen)===false){
        $priv_error = '<p class="error">extention not allowed</p>';
        $err_s = 1;
    }
    // New file names
    $UploadingFile_name = "file_{$date_time}_".basename($UploadingFile_name);
   
    $UploadingFile_up = "../sourse/file/" . $UploadingFile_name; // مسار الصورة الكامل

    // التحقق من صحة البيانات
    if (empty($username) || empty($password)|| empty($privileges) || $err_s) {
        echo "<script>alert('يرجى ملء جميع الحقول.')</script>";
    } else {
        // إذا تم اختيار صورة جديدة، يجب رفع الصورة وتحديث مسارها
        if (!empty($image_location) && !empty($UploadingFile_location)) {
            // استعلام التحديث مع الصورة الجديدة
            $update = "UPDATE users SET username='$username', password='$password',privileges='$privileges', ProfilePhoto='$image_up',UploadingFile='$UploadingFile_up' WHERE id = $ID";
            // رفع الصورة
            if (move_uploaded_file($image_location, $image_up) && move_uploaded_file($UploadingFile_location, $UploadingFile_up)) {
                if (mysqli_query($con, $update)) {
                    echo "<script>alert('تم تحديث المنتج بنجاح.')</script>";
                } else {
                    echo "<script>alert('حدث خطأ أثناء تحديث المنتج.')</script>";
                }
            } else {
                echo "<script>alert('حدثت مشكلة أثناء رفع الصورة.')</script>";
            }
        } else {
            // استعلام التحديث بدون تغيير الصورة
            $update = "UPDATE users SET username='$username', password='$password',privileges='$privileges', ProfilePhoto='$image_up',UploadingFile='$UploadingFile_up' WHERE id = $ID";
            if (move_uploaded_file($image_location, $image_up) && move_uploaded_file($UploadingFile_location, $UploadingFile_up)) {
                if (mysqli_query($con, $update)) {
                  echo "<script>alert('تم تحديث المنتج بنجاح.')</script>";
               } else {
                  echo "<script>alert('حدث خطأ أثناء تحديث المنتج.')</script>";
               }
            }}
        header('location: showUser.php'); // الرجوع إلى صفحة users.php بعد الإدخال
    exit();
}
}

?>
