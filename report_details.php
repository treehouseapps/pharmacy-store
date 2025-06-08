<?php 
session_start();
// connection 
$conn = new mysqli('localhost', 'root', '', 'medicine');
   
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
else{
    if(isset($_GET['report_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['report_id']);

        // Select the table
        $report = "SELECT * FROM report_store WHERE report_id = $id";
        // Get results
        $bind = mysqli_query($conn, $report);
        // Fetch the results
        $result = mysqli_fetch_assoc($bind);
        // Free the results
        mysqli_free_result($bind);
        // Close connection
        mysqli_close($conn);
    }
    

}

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
    
<?php 
    if(isset($_SESSION['role'])) {?>
    <?php include 'navbar.php'; ?>
    <center><h1 class="med">Customer Profile Detail</h1></center>
    <div class="item">
    <?php if($result): ?>
     <div class="detail">
            <img src="./image/img/<?php echo htmlspecialchars($result['img']); ?>" alt="" width="250" height="250">
            <div class="div"><div class="divv"><br>
                <h3>Report ID: <?php echo htmlspecialchars($result['report_id']); ?></h3>
                <h3>First Name : <?php echo htmlspecialchars($result['first_name']); ?></h3>
                <h3>Last Name : <?php echo htmlspecialchars($result['last_name']); ?></h3>
                <h3>Address: <?php echo htmlspecialchars($result['address']); ?></h3>
                <h3>Phone Number: <?php echo htmlspecialchars($result['phone_no']); ?></h3>
                <h3>Medicine Name: <?php echo htmlspecialchars($result['med_name']); ?></h3>
                <h3>Buy Date: <?php echo htmlspecialchars($result['buy_date']); ?></h3>
                <h3>Quantity: <?php echo htmlspecialchars($result['quantity']); ?></h3>
                <?php endif; ?></div>
                <div class="btninline">
             <a href="add_update.php?report_id=<?php echo $result['report_id']?>"><button class="btn">Edit </button></a>
             <form action="pharm_record.php?report_id=<?php echo $result['report_id']?>" method="POST">
                <button type="submit" name="delete" class="btn">delete</button>
             </form></div><?php } ?>
            </div>
    </div>
    </div>
    <?php include 'footer.php'; ?>
             
</body>
</html>