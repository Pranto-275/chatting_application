<?php
global $connection;
include 'connection.php';
session_start();
$message = '';

$user_name =     $_SESSION['user_name'];
$user_image =     $_SESSION['user_image'];
$use_id = $_SESSION['user_id'];

if (!$_SESSION['user_name']){
  header('Location:login.php');
}


$user_list = "SELECT * FROM users WHERE  user_id <> '$use_id'";
$user_list_query = mysqli_query($connection,$user_list);

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
  <div id="home">

    <div class="header">
      <div class="content">
        <img src="<?php echo $user_image; ?>" alt="" style="height:50px;width: 50px;">
        <div class="details">
          <span><?php echo $user_name; ?></span>
          <p>Active Now</p>
        </div>
      </div>
      <a href="logout.php" class="btn btn-dark">Logout</a>
    </div>


    <div class="search mt-3">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter name to search..">
        <button class="btn btn-dark" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
    </div>



    <div class="peopole_list_body">


      <?php
      while ($row = mysqli_fetch_assoc($user_list_query)){   ?>

        <div class="people_list">
          <div class="content">
            <img src="<?php echo $row['image']; ?>" alt="" style="height:50px;width: 50px;">
            <div class="details">
              <a href="chatbox.php?user_id=<?php echo $row['user_id']; ?>"><span><?php echo $row['full_name']; ?></span></a>
              <p>This is text Message</p>
            </div>
          </div>
          <span style="color:#4cd137"><i class="fa-solid fa-circle"></i></span>
        </div>


        <?php
      }

      ?>

    

  </div>

    
  </div>




  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>