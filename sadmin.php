<?php
session_start();
    if(($_SESSION["role"] != "SAdmin")){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/session.css">
    <title>Super admin</title>
</head>

<body>
    

    <div class="container"><header>
            <?php include 'navbar.php'; ?>
        </header>
        <div style="margin: 2px;width: max-content;border: 1px solid rgb(88, 5, 77);border-radius: 10px;padding: 5px;position: absolute;right: 0px;">
        <img src="image/profile.jpg" alt="" width="50" height="50">
        <h2><?php echo $_SESSION["role"]; ?></h2>
        <form action="login.php" method="POST"><div class="for" style="margin:1px;"><button name="logout" type="submit">Logout</button></div></form>
    </div>

        <section>
            <center><br>
            <div class="listheader" style="margin: 10px; padding: 10px;">
                <h1>Admin View</h1>
            </div>
                <div class="listforchoose">
                <div class="choose">
                <a href="add_smembers.php"><button class="bchoose"><h4>Add Members</h4></button></a>
            </div>
                <div class="choose">
                <a href="admin_store.php"><button class="bchoose"><h4>Members List</h4></button></a>
            </div>
                </div>
            </center>
           
        </section>
        <?php include 'footer.php'; ?>

</body>

</html>