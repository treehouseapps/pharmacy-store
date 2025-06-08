<?php
session_start();
if(($_SESSION["role"]!= "StoreMan")){
    header("Location: login.php");
    }
    $conn = new mysqli('localhost', 'root', '', 'medicine');
    
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
else{
    if(isset($_GET['med_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['med_id']);
        $new = $id;
        $report = "SELECT * FROM med_store WHERE med_id = $id";
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
    <title>Medicine Detail</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <center><h1 class="med">Edit medicine</h1></center>
    <form action="pharmacy.php?med_id=<?php echo $result['med_id']?>" method="POST" enctype="multipart/form-data">
    <div class="item">
     <div class="detail">
     <div class="order">
            <img src="image/empty.jpg" alt="" width="250" height="250"><br><br>
            <input type="file" class="inputt" name="image" required></div>
            <div class="div"><br><br>
                <h3>Medicine ID:  <?php echo htmlspecialchars($id); ?></h3><br>
                <h2>Name :  <input type="text" name="username" required></h3><br>
                <h2>Price: <input type="number" name="price" required></h3><br>
                <h2>Expire Date: <input type="number" name="expire" required></h3><br>
                <h3>Descreption: <input type="text" name="descreption" required></h3>
                <button id="btn" type="submit" name="update">Done</button>
             </div>
    </div>
    </div></form>
    <?php include 'footer.php'; ?>
</body>
</html>