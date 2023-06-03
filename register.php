<?php
global $connection;
include 'connection.php';
$message = '';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['register'])){
        $full_name = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $image = $_FILES['image'];

        if (empty($full_name) || $image['size'] == 0 || empty($email) || empty($phone) || empty($password) || empty($cpassword)){
            $message = "Filed Should Not Empty!";
        }else{

            if (!preg_match("/^[a-zA-Z-' ]*$/", $full_name)) {
                $message = "Invalid User Name";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "Invalid email";
            } else if($password != $cpassword){
                $message = "Password do not match!";
            }else{

                $image_name = $image['name'];
                $temp_name_of_file = $image['tmp_name'];
                $format = explode('.', $image_name);
                $file_name = strtolower($format[0]);
                $file_extension = strtolower($format[1]);
                $allowed_format = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($file_extension, $allowed_format)) {
                    $location = 'img/'.time(). $file_name . '.' . $file_extension;

                    move_uploaded_file($temp_name_of_file, $location);

                    $user_unique_id = rand(10000,99999);
                    $password = password_hash($password,PASSWORD_DEFAULT);

                    $register_query = "INSERT INTO users (user_id,full_name,email,phone,password,image) VALUES ('$user_unique_id','$full_name','$email','$phone','$password','$location')";

                    if (mysqli_query($connection, $register_query)) {
                        $message = "record inserted";

                    } else {
                        $message = "Failed to Update";
                    }


                }

            }


        }
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div id="register">
    <div class="headline text-center">
        <h2>E-Chat</h2>
        <h4>Registration</h4>
    </div>
    <div class="regform">
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <h5 style="color: red;text-align: center"><?php echo $message; ?></h5>
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" name="fullname">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email">
              </div>
              <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone">
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword">
            </div>
              <div class="mb-3">
                <label class="form-label">Profile Image</label>
                <input type="file" class="form-control" name="image">
              </div>

            <button type="submit" class="btn btn-dark w-100" name="register">Register</button>
            <a href="login.php">Already signed up? Login now</a>
        </form>
    </div>
   </div>




    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($connection);
?>