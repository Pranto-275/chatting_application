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

$friend_id = $_REQUEST['id'];



$friend_info_query = "SELECT * FROM users WHERE  user_id = '$friend_id'";
$friend_info_query_result = mysqli_query($connection,$friend_info_query);

$data = mysqli_fetch_assoc($friend_info_query_result);



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
  <div id="chatpage">

    <div class="header">
      <div class="content">
       <div class="back">
       <a href="home.php"> <i class="fa-solid fa-arrow-left"></i></a>
       </div>
        <img src="<?php echo $data['image']; ?>" alt="" style="height:50px;width: 50px;">
        <div class="details">
          <span><b><?php echo $data['full_name']; ?></b></span>
          <p>Active Now</p>
        </div>
      </div>
     
    </div>

    <div class="chatbox">
      <div class="chat_outgoing">
        <div class="details">
          <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui aliquid, quae magni dignissimos exercitationem consequatur architecto vitae sequi voluptatum consequuntur..</p>
        </div>
      </div>
      <div class="chat_incoming">
        <img src="img/4.jpg" alt="">
        <div class="details">
          <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, nesciunt? Beatae error repellat soluta accusantium at cum incidunt vel quia consequatur distinctio asperiores, eum laudantium? At sed eos incidunt rerum labore sunt officia modi. Minima similique cumque libero in unde iste perferendis deleniti. Quos, maiores molestias ipsum quam iure sit deserunt corporis impedit, ad rem alias similique iusto aperiam! Magnam non dicta recusandae quas, explicabo fugiat quidem! Explicabo quisquam ea fugiat voluptates earum nobis, beatae exercitationem nesciunt sit praesentium laborum dolores. Debitis vel sunt repudiandae omnis totam qui, perferendis quod accusantium aperiam dolore, ea beatae corrupti aspernatur nisi eius. A!</p>
        </div>
      </div>
    </div>



    <div class="footer">
      <div class="">
        <div class="input-group ">
          <input type="text" class="form-control" placeholder="Type here......">
          <button class="btn btn-dark" type="button"><i class="fa-solid fa-paper-plane"></i></button>
        </div>
      </div>
     
    </div>


    
  </div>




  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>



<?php
mysqli_close($connection);
?>