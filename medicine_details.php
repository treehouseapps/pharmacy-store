<?php 
session_start();
// connection 
$conn = new mysqli('localhost', 'root', '', 'medicine');
   
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
else{
    if(isset($_GET['med_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['med_id']);

        // Select the table
        $medicine = "SELECT * FROM med_store WHERE med_id = $id";
        // Get results
        $bind = mysqli_query($conn, $medicine);
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
    <title>Medicine Detail</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <center><h1 class="med"> Medicine Detail </h1></center>
    <div class="item">
    <?php if($result): ?>
     <div class="detail">
            <img src="./image/img/<?php echo htmlspecialchars($result['img']); ?>" alt="" width="250" height="250">
            <div class="div"><br><br>
            <?php if(isset($_SESSION['role'])) {?>
                <h3>ID: <?php echo htmlspecialchars($result['med_id']); ?></h3><br><?php }?>
                <h2> <?php echo htmlspecialchars($result['med_name']); ?></h2><br>
                <h3>Price: $<?php echo htmlspecialchars($result['price']); ?>.00</h3><br>
                <?php if(isset($_SESSION['role'])) {?>
                <h3>Expire Date: <?php echo htmlspecialchars($result['exp_date']); ?></h3><br>
                <?php }?>
                <p><font size="5">Description:</font> <?php echo htmlspecialchars($result['med_desc']); ?></p>
                <a href="add_report.php"><button id="btn"> BUY </button></a>
                <?php endif; ?>
                <?php 
                if(isset($_SESSION['role'])) {?>
                <div class="btninline">
             <a href="add_update_med.php?med_id=<?php echo $result['med_id']?>"><button class="btn">Edit </button></a>
             <form action="pharmacy.php?med_id=<?php echo $result['med_id']?>" method="POST">
                <button type="submit" name="delete" class="btn">delete</button>
             </form></div>
             <?php } ?>
             </div>
    </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>