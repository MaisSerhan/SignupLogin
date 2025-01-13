<?php
include('config.php');

$username = $password = $code = $md5_pass ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $code = test_input($_POST['code']);
    $md5_pass = md5($password);
}

function test_input($data) {
    // تنظيف وتشفير المدخلات
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripcslashes($data);
    return $data;
}
if (isset($_POST['upload'])) {
    $err_s = 0;
//check photo
if(isset($_FILES['photo'])){
    $errors= array();
    $photo_name = $_FILES['photo']['name'];
    $photo_size = $_FILES['photo']['size'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_type = $_FILES['photo']['type'];
    $photo_name_parts = explode('.', $photo_name); // First assign explode() result to a variable
    $photo_ext = strtolower(end($photo_name_parts)); // Pass the variable to end()
    
    $expen=array("jpeg","jpg","png");
    
    // Define dynamic file names with date-time 
    $date_time = date("Ymd_His"); // Date and time format

    // New file names
    $photo_name = "photo_{$date_time}_".basename($photo_name);
    $photo_path = "../sourse/photo/" . $photo_name;

    if(in_array($photo_ext, $expen)===false){
        $errors[]="extention not allowed";
    }

    if($photo_size > 2097152){
        $errors[]="size is large";
    }
    if(file_exists("../sourse/photo/".$photo_name)){
        $errors[]="there is a file with same name";
    }
}
else{
    $priv_error = '<p class="error">Please choose a photo!</p>';
    $err_s = 1;
}

//check file
if(isset($_FILES['uploading'])){
    $errors= array();
    $file_name = $_FILES['uploading']['name'];
    $file_size = $_FILES['uploading']['size'];
    $file_tmp = $_FILES['uploading']['tmp_name'];
    $file_type = $_FILES['uploading']['type'];
    $expen=array("pdf","docx","xlsx");
    $file_name_parts = explode('.', $file_name); // First assign explode() result to a variable
    $file_ext = strtolower(end($file_name_parts)); // Pass the variable to end()
    
    // Define dynamic file names with date-time 
    $date_time = date("Ymd_His"); // Date and time format

    // New file names
    $file_name = "file_{$date_time}_".basename($file_name);
    $file_path = "../sourse/file/" . $file_name;

    if(in_array($file_ext, $expen)===false){
        $errors[]="extention not allowed";
        $user_error = '<p class="error">extention not allowed.</p>';
        $err_s = 1;
    }

    if($file_size > 2097152){
        $errors[]="size is large";
        $user_error = '<p class="error">size is large.</p>';
        $err_s = 1;
    }
    if(file_exists("../sourse/file/".$file_name)){
        $errors[]="there is a file with same name";
        $user_error = '<p class="error">there is a file with same name.</p>';
        $err_s = 1;
    }
}
else{
    $priv_error = '<p class="error">Please choose a valid file!</p>';
    $err_s = 1;
}

//check priv
$priv = isset($_POST['priv']) ? $_POST['priv'] : '';
if (!in_array($priv, ['User','Admin'])) {
    $priv_error = '<p class="error">Please choose a valid privileges!</p>';
    $err_s = 1;
}

// التحقق من تكرار اسم المستخدم
$check_user = "SELECT * FROM `users` WHERE username='$username'";
   
$check_result = mysqli_query($con, $check_user);
$num_rows = mysqli_num_rows($check_result);
if ($num_rows != 0) {
    $user_error = '<p class="error">Username already exists, please choose another one.</p>';
    $err_s = 1;
}

 // التحقق من صحة المدخلات
 if (empty($username)) {
    $user_error = '<p class="error">Please enter username.</p>';
    $err_s = 1;
} elseif (strlen($username) < 6) {
    $user_error = '<p class="error">Username must be at least 6 characters long.</p>';
    $err_s = 1;
} elseif (is_numeric($username)) {
    $user_error = '<p class="error">Username should not be a number.</p>';
    $err_s = 1;
}
if ($code !== '55g5'&& $priv == "Admin") { // تحقق إذا كانت القيمة ليست مساوية لـ '55g5'
    $code_error = '<p class="error">please enter The Admain code must be 55g5.</p>';
    $err_s = 1;
}

if (empty($password) || strlen($password) < 9) {
    $password_error = '<p class="error">Password must be at least 9 characters long.</p>';
    $err_s = 1;
}
// إذا لم يكن هناك أخطاء، قم بإدخال البيانات في قاعدة البيانات
if ($err_s == 0 && $num_rows == 0 && empty($error)==true) {
    if($priv=='Admin'){
    $sql = "INSERT INTO users(username,password,privileges,entercode,ProfilePhoto,UploadingFile,md5_pass)
            VALUES ('$username','$password','$priv','$code','$photo_path','$file_path','$md5_pass')";
    }else{
        $sql = "INSERT INTO users(username,password,privileges,entercode,ProfilePhoto,UploadingFile,md5_pass)
            VALUES ('$username','$password','$priv','','$photo_path','$file_path','$md5_pass')"; 
    }
    
    if (mysqli_query($con, $sql)) {
        if (move_uploaded_file($photo_tmp, $photo_path) && move_uploaded_file($file_tmp, $file_path)) { // رفع الصورة
            echo "<script>alert('تم رفع الصورة بنجاح وإدخال المنتج.')</script>";
        } else {
            echo "<script>alert('حدثت مشكلة أثناء رفع الصورة.')</script>";
        }
        header('Location: ../ClintPages/login.php');
        exit();
    } else {
        echo '<p class="error">Failed to register. Please try again later.</p>';
    }
} else {
    include('../ClintPages/register.php');
}

}  