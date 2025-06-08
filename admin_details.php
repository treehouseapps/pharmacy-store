<?php 
session_start();
if(($_SESSION["role"] != "SAdmin")){
    header("Location: login.php");
}
// connection 
$conn = new mysqli('localhost', 'root', '', 'medicine');
   
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
else{
    if(isset($_GET['member_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['member_id']);

        // Select the table
        $report = "SELECT * FROM admin_store WHERE member_id = $id";
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
    <title>Admin Detail</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <center>
        <h1 class="med">Admin profile Detail</h1>
    </center>
    <div class="item">
        <?php if($result): ?>
        <div class="detail" >
            <img src="./image/img/<?php echo htmlspecialchars($result['img']); ?>" alt="" width="250" height="250">
            <div class="div"><div class="divv">
                <h3>ID :
                    <?php echo htmlspecialchars($result['member_id']); ?>
                </h3>
                <h3>First name :
                    <?php echo htmlspecialchars($result['member_fname']); ?>
                </h3>
                <h3>Last name :
                    <?php echo htmlspecialchars($result['member_sname']); ?>
                </h3>
                <h3>Gender :
                    <?php echo htmlspecialchars($result['gender']); ?>
                </h3>
                <h3>Address :
                    <?php echo htmlspecialchars($result['address']); ?>
                </h3>
                <h3>Phone Number :
                    <?php echo htmlspecialchars($result['phone_no']); ?>
                </h3></div>
                <div class="btninline">
                <a href="add_admin_update.php?member_id=<?php echo $result['member_id']?>"><button class="btn">Edit
                    </button></a>
                <form action="admin_store.php?member_id=<?php echo $result['member_id']?>" method="POST">
                    <button type="submit" name="delete" class="btn">delete</button>
                </form>
            </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>
