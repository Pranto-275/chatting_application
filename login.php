<?php
global $connection;
include 'connection.php';
session_start();
$message = '';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['login'])){
        $login_email = $_POST['email'];
        $login_password = $_POST['password'];
    }if (empty($login_email) || empty($login_password)){
        $message = "Please Fill-up All Field!!";
    }else{
        if (!filter_var($login_email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email";
        }else{
            $login_sql = "SELECT * FROM users WHERE email= '$login_email'";
            $login_result = mysqli_query($connection,$login_sql);
            $userdata = mysqli_fetch_assoc($login_result);
            $hashpass = $userdata['password'];

            if ($login_result && password_verify($login_password,$hashpass)){

                if($login_email == $userdata['email']){
                    $_SESSION['user_name'] = $userdata['full_name'];
                    $_SESSION['user_image'] = $userdata['image'];
                    $_SESSION['user_id'] = $userdata['user_id'];
                    header('Location:home.php');
                }else{
                    $message = "Email Mismatch!";
                }
            }else{
                $message = "Password Can't Verify!!";
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
   <div id="login">
    <div class="login_headline text-center">
        <h2>Online Chatting Application</h2>
        <h4>Login</h4>
    </div>
    <div class="loginform">
        <form action="login.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
              </div>
           
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
          

            <button type="submit" class="btn btn-dark w-100" name="login">Login</button>
              <a href="register.php">Not yet signed up? Signup now</a>
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