<?php 
session_start();
    if(($_SESSION["role"] != "StoreMan")){
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
    <title>Register Medicine </title>
</head>

<body>
        <header>
            <?php include 'navbar.php'; ?>
        </header>
        <div class="user"><img src="image/profile.jpg" alt="" width="50" height="50">
        <h2><?php echo $_SESSION["role"]; ?></h2>
        <form action="login.php" method="POST"><div class="for"><button name="logout" type="submit">Logout</button></div></form>
    </div>
    <center>
        <h1 class="reg">REGISTER NEW MEDICINE</h1>
        <div class="form-box">
            <form class="form" action="pharmacy.php" method="POST" enctype="multipart/form-data"> <span class="title">ADD Medicine</span>
                <span class="subtitle">Add every detail of the medicine.</span>
                <div class="form-container">
                    <input type="file" class="input" name="image" required>
                    <input type="text" class="input" name="med_name" placeholder="Medicine Name " required>
                    <input type="text" class="input" name="exp_date" placeholder="Expire date" required>
                    <input type="number" class="input" name="price" placeholder="Price" required>
                    <input type="text" class="input" name="med_desc" placeholder="Description" required>
                </div> <button type="submit" name="submit">Register</button>
            </form>
        </div>
            <?php include 'footer.php'; ?>
    </center>
</body>

</html>