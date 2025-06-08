<?php
session_start();
    if(($_SESSION["role"] != "Sales")){
        header("Location: login.php");
    }else{
// connection 
$conn = new mysqli('localhost', 'root', '', 'medicine');
   
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}else{

    // Add Report
if(isset($_POST["submit"])){
    $img = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./image/img/" . $img;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];
    $med_name = $_POST['med_name'];
    $buy_date = $_POST['buy_date'];
    $quantity = $_POST['quantity'];
    move_uploaded_file($tempname, $folder);
    $stmt = $conn->prepare("insert into report_store(img, first_name, last_name, address, phone_no, med_name, buy_date, quantity)values(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss", $img, $first_name, $last_name, $address, $phone_no, $med_name, $buy_date, $quantity);
    $stmt->execute();
    $stmt->close();
    echo  "<script> alert('Report Added Sucessfuly');</script>"; 


}

// Update Report
if(isset($_POST["update"])){
    $img = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./image/img/" . $img;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];
    $med_name = $_POST['med_name'];
    $buy_date = $_POST['buy_date'];
    $quantity = $_POST['quantity'];
    if(isset($_GET['report_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['report_id']);
        move_uploaded_file($tempname, $folder);
    //select the tabel
    $sql = "UPDATE report_store SET first_name = '$first_name', last_name = '$last_name', img = '$img', address = '$address', phone_no = '$phone_no', med_name = '$med_name', buy_date = '$buy_date', quantity = '$quantity' WHERE report_id= $id";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    echo  "<script> alert('Report Updated Successfully');</script>"; 

}}


// Delete Data
if (isset($_POST['delete'])) {
    if(isset($_GET['report_id'])){
        // get id to delete
        $id = mysqli_real_escape_string($conn, $_GET['report_id']);}
        // mysql delete query 
        $query = "DELETE FROM `report_store` WHERE `report_id` = $id";
        $result = mysqli_query($conn, $query);
        if(!$result){echo  "<script> alert('Data Not Deleted');</script>";} 
        else{echo  "<script> alert('Report deleted Sucessfully');</script>";}

}

// Select the table
$mem = 'SELECT * FROM report_store';
// Get results
$bin = mysqli_query($conn, $mem);
// Fetch the results
$prints = mysqli_fetch_all($bin, MYSQLI_ASSOC);
// Free the results
mysqli_free_result($bin);
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
    <link rel="stylesheet" href="css/session.css">
    <title>List</title>
</head>

<body>


    <div class="container">
        <header>
            <?php include 'navbar.php'; ?>
        </header>
        <div
            style="margin: 2px;width: max-content;border: 1px solid rgb(88, 5, 77);border-radius: 10px;padding: 5px;position: absolute;right: 0px;">
            <img src="image/profile.jpg" alt="" width="50" height="50">
            <h2>
            <a href="pharmacist.php" style="color: black;"><?php echo $_SESSION["role"]; ?></a>
            </h2>
            <form action="login.php" method="POST">
                <div class="for" style="margin:1px;"><button name="logout" type="submit">Logout</button></div>
            </form>
        </div>

        <section>
            <center>
                <div class="contain">
                <div class="list"><br><br>
                        <h1> Medicine Buyers Information </h1><br><br><br><br>
                        <div class="itemm">
                            <?php foreach($prints as $print){ ?>
                    <div class="cardd">
                        <center>
                            <img src="./image/img/<?php echo htmlspecialchars($print['img']); ?>" alt="" width="150" height="150">
                            <div class="div">
                                <h4>Id : <?php echo htmlspecialchars($print['report_id']); ?></h4>
                                <h3>First Name : <?php echo htmlspecialchars($print['first_name']); ?></h3>
                                <h3>Last Name : <?php echo htmlspecialchars($print['last_name']); ?></h3>
                                <h3>Medicine : <?php echo htmlspecialchars($print['med_name']); ?></h3>
                                <a href="report_details.php?report_id=<?php echo $print['report_id']?>"><button class="btn">More info</button></a>
                                </div>
                        </center>
                    </div><?php } ?>
                        </div>
                    </div>

                </div>
            </center>
        </section>
        <?php include 'footer.php'; ?>

</body>

</html>