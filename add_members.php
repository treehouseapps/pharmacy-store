<?php 
session_start();
    if(($_SESSION["role"] != "Admin")){
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
        <div class="user"><img src="image/profile.jpg" alt="" width="50" height="50">
        <h2><?php echo $_SESSION["role"]; ?></h2>
        <form action="login.php" method="POST">
            <div class="for">
                <button name="logout" type="submit">Logout</button>
            </div>
        </form>
    </div>
    <center>
        <h1 class="reg">REGISTER SHOP MEMBERS</h1>
        <div class="form-box">
            <form class="form" action="member_store.php" method="POST" enctype="multipart/form-data"> <span class="title">ADD Member</span>
                <span class="subtitle">Create User acount for Shop Members.</span>
                <div class="form-container">
                    <input type="file" class="input" name="image" required>
                    <input type="text" class="input" name="member_fname" placeholder="First Name" required>
                    <input type="text" class="input" name="member_sname" placeholder="Last Name" required>
                    <input type="text" class="input" name="gender" placeholder="Gender" required>
                    <input type="text" class="input" name="address" placeholder="Address" required>
                    <input type="number" class="input" name="phone_no" placeholder="Phone Number" required>
                    <input type="text" class="input" name="role" placeholder="User Type" required>
                </div> <button type="submit" name="submit">Register</button>
            </form>
        </div>
    </center>
    <?php include 'footer.php'; ?>
</body>

</html>