<?php
session_start();

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == 'med' && $password == 'med' ){
        $_SESSION['role'] = "StoreMan";
        header('Location: doctor.php');
    }
    else if($username == 'admin' && $password == 'admin'){
            $_SESSION['role'] = "Admin";
            header('Location: admin.php');
        }
    else if($username == 'pharm' && $password == 'pharm'){
            $_SESSION['role'] = "Sales";
            header('Location: pharmacist.php');
        }
    else if($username == 'sadmin' && $password == 'sadmin'){
            $_SESSION['role'] = "SAdmin";
            header('Location: sadmin.php');
        }
        else{
            echo  "<script> alert('Wrong Username or Password');</script>"; 
        }
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <style>
        .body{    background-image: url("image/backgroung1.jpg");}
    </style>
    <title>Login</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="body">
        <div class="conbox">
            <center>
                <div class="profile"><img src="image/profile.jpg" alt=""><br>
                    <h1>Member</h1>
                    <h2>LOGIN</h2>
                </div>
                <form class="uinput" action="login.php" method="POST">
                    <div class="uname"><img src="image/uiconu.png" alt="" width="30" height="30">
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <br>
                    <div class="uname"><img src="image/uiconk.png" alt="" width="30" height="30">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <button class="button" type="submit" name="login">Login</button>
                    <a href="login.php">
                        <font color="blue">
                            <p>Forgot Password ?</p>
                        </font>
                    </a>
                    <br>
                </form>
        </div>
        </center>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>