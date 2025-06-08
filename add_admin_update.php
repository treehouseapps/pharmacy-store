<?php
session_start();
if(($_SESSION["role"]!= "SAdmin")){
    header("Location: login.php");
    }
$conn = new mysqli('localhost', 'root', '', 'medicine');

if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
else{
    if(isset($_GET['member_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['member_id']);
        $new = $id;
        $report = "SELECT * FROM admin_store WHERE member_id = $id";
        // Get results
        $bind = mysqli_query($conn, $report);
        // Fetch the results
        $result = mysqli_fetch_assoc($bind);
        // Free the results
        mysqli_free_result($bind);
        // Close connection
        mysqli_close($conn);
    }}
?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pharm.css">
    <title>Admin Detail</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <center><h1 class="med">Edit Admin</h1></center>
    <form action="admin_store.php?member_id=<?php echo $result['member_id']?>" method="POST" enctype="multipart/form-data">
    <div class="item">
     <div class="detail">
     <div class="order">
            <img src="image/empty.jpg" alt="" width="250" height="250"><br><br>
            <input type="file" class="inputt" name="image" required></div>
            <div class="div"><br><br>
            <div class="divv">
                <h3>Member ID:  <?php echo htmlspecialchars($id); ?></h3>
                <h3>First Name :  <input type="text" name="member_fname" required></h3>
                <h3>Last Name :  <input type="text" name="member_sname" required></h3>
                <h3>Gender :  <input type="text" name="gender" required></h3>
                <h3>Adress: <input type="text" name="address" required></h3>
                <h3>Phone Number: <input type="number" name="phone_no" required></h3>
                <h3>User Type: <input type="text" name="role" required></h3></div>
                <button id="btn" type="submit" name="update">Done</button>
             </div>
    </div>
    </div></form>
    <?php include 'footer.php'; ?>
</body>
</html>