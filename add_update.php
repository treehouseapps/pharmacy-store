<?php
session_start();
if(($_SESSION["role"]!= "Sales")){
    header("Location: login.php");
    }
    $conn = new mysqli('localhost', 'root', '', 'medicine');
   
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
else{
    if(isset($_GET['report_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['report_id']);
        $new = $id;
        $report = "SELECT * FROM report_store WHERE report_id = $id";
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
    <title>Customer Detail</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <center><h1 class="med">Edit Customer Information</h1></center>
    <form action="pharm_record.php?report_id=<?php echo $result['report_id']?>" method="POST" enctype="multipart/form-data">
    <div class="item">
     <div class="detail">
     <div class="order">
            <img src="image/empty.jpg" alt="" width="250" height="250"><br><br>
            <input type="file" class="inputt" name="image" required></div>
            <div class="div"><br><br>
                <h3>Report ID:  <?php echo htmlspecialchars($id); ?></h3><br>
                <h3>First Name :  <input type="text" name="first_name" required></h3><br>
                <h3>Last Name :  <input type="text" name="last_name" required></h3><br>
                <h3>Address: <input type="text" name="address" required></h3><br>
                <h3>Phone Number: <input type="text" name="phone_no" required></h3><br>
                <h3>Medicine Name: <input type="text" name="med_name" required></h3><br>
                <h3>Buy Date: <input type="text" name="buy_date" required></h3><br>
                <h3>Quantity: <input type="text" name="quantity" required></h3>
                <button id="btn" type="submit" name="update">Done</button>
             </div>
    </div>
    </div></form>
    <?php include 'footer.php'; ?>
</body>
</html>