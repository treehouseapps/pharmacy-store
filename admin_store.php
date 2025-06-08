<?php
session_start();
    if(($_SESSION["role"] != "SAdmin")){
        header("Location: login.php");
    }
    else{
        $conn = new mysqli('localhost', 'root', '', 'medicine');
   
if($conn->connect_error){
    die('Connection faild '.$conn->connect_error);
}else{

    // Add Admins
    if(isset($_POST["submit"])){
        $img = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/img/" . $img;
        $member_fname = $_POST['member_fname'];
        $member_sname = $_POST['member_sname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone_no = $_POST['phone_no'];
               //Add files to database
            move_uploaded_file($tempname, $folder);
            $stmt = $conn->prepare("insert into admin_store(img, member_fname, member_sname, gender, address, phone_no)values(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $img, $member_fname, $member_sname, $gender, $address, $phone_no);
            $stmt->execute();
            $stmt->close();
            echo  "<script> alert('Admin Added Sucessfully');</script>";

        }

        // Update Admin 
if (isset($_POST['update'])) {
        $img = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/img/" . $img;
        $member_fname = $_POST['member_fname'];
        $member_sname = $_POST['member_sname'];
        $address = $_POST['address'];
        $phone_no = $_POST['phone_no'];
            if(isset($_GET['member_id'])){
                $id = mysqli_real_escape_string($conn, $_GET['member_id']);
             move_uploaded_file($tempname, $folder);
            //select the tabel
            $sql = "UPDATE admin_store SET member_fname = '$member_fname', member_sname = '$member_sname', img = '$img', address = '$address', phone_no = '$phone_no' WHERE member_id= $id";
          // Prepare statement
          $stmt = $conn->prepare($sql);
          // execute the query
          $stmt->execute();
          echo  "<script> alert('Data Updated Sucessfully');</script>";
        }
    }
    // Delete Data
if (isset($_POST['delete'])) {
            if(isset($_GET['member_id'])){
                // get id to delete
                $id = mysqli_real_escape_string($conn, $_GET['member_id']);}
                // mysql delete query 
                $query = "DELETE FROM `admin_store` WHERE `member_id` = $id";
                $result = mysqli_query($conn, $query);
                if(!$result){echo  "<script> alert('Data Not Deleted');</script>";} 
        else{echo  "<script> alert('Report deleted Sucessfully');</script>";}
    
    }
        
    // Display All Table Files
// Select the table
$medicine = 'SELECT * FROM admin_store';
// Get results
$bind = mysqli_query($conn, $medicine);
// Fetch the results
$result = mysqli_fetch_all($bind, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/session.css">
    <title>Super Admin</title>
</head>
<body>
    <header><?php include 'navbar.php'; ?></header>
    <?php
    if(isset($_SESSION['role'])) {?>
        
        <div class="session">
            <img src="image/profile.jpg" alt="" width="50" height="50">
            <h2>
                <a href="sadmin.php" style="color: black;"><?php echo $_SESSION["role"]; ?></a>
            </h2>
            <form action="login.php" method="POST">
                <div class="for" style="margin:1px;"><button name="logout" type="submit">Logout</button></div>
            </form>
        </div>
<?php } ?>
    <div class="container">
    <div class="breakk" id="get">
                <div class="iinline">
                <h1>Admin List</h1>
            </div>
        </div>
        
                <div class="items">
                <?php foreach($result as $resul){ ?>
                    <div class="card" style="width: 250px;">
                        <center>
                            <img src="./image/img/<?php echo htmlspecialchars($resul['img']); ?>" alt="" width="150" height="150">
                            <div class="div">
                                <h5>ID : <?php echo htmlspecialchars($resul['member_id']); ?></h5>
                                <h3> <?php echo htmlspecialchars($resul['member_fname']); ?>
                                <?php echo htmlspecialchars($resul['member_sname']); ?></h3>
                            </div>
                            <a href="admin_details.php?member_id=<?php echo $resul['member_id']?>"><button class="btn">More info</button></a>
                        </center><br>
                    </div><?php } ?>
                    </div>
        
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>