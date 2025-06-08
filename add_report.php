<?php 
session_start();
    if(($_SESSION["role"] != "Sales")){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/session.css">
    <title>Register members </title>
</head>

<body>
    <header>
            <?php include 'navbar.php'; ?>
        </header>
        <?php
    if(isset($_SESSION['role'])) {?>
        
        <div class="session">
            <img src="image/profile.jpg" alt="" width="50" height="50">
            <h2>
                <a href="pharmacist.php" style="color: black;"><?php echo $_SESSION["role"]; ?></a>
            </h2>
            <form action="login.php" method="POST">
                <div class="for" style="margin:1px;"><button name="logout" type="submit">Logout</button></div>
            </form>
        </div>
<?php } ?>
    <center>
        <h1 class="reg">Report Writhing</h1>
        <div class="form-box">
            <form class="form" action="pharm_record.php" method="POST" enctype="multipart/form-data"> <span class="title">ADD Report</span>
                <span class="subtitle">Add every detail of buyer information.</span>
                <div class="form-container">
                    <input type="file" class="input" name="image" required>
                    <input type="text" class="input" name="first_name" placeholder="First Name" required>
                    <input type="text" class="input" name="last_name" placeholder="Last Name" required>
                    <input type="Address" class="input" name="address" placeholder="Address" required>
                    <input type="number" class="input" name="phone_no" placeholder="Phone Number" required>
                    <input type="text" class="input" name="med_name" placeholder="Medicine Name" required>
                    <input type="text" class="input" name="buy_date" placeholder="Buy Date" required>
                    <input type="text" class="input" name="quantity" placeholder="Quantity" required>
                </div> <button type="submit" name="submit">ADD</button>
            </form>
        </div>
    </center>
    <?php include 'footer.php'; ?>
</body>

</html>