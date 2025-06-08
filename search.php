<?php 
    $conn = new mysqli('localhost', 'root', '', 'medicine');
   
  if(isset($_POST['search']))
 {
  $med_name = $_POST['med_name'];

  $query = "SELECT * FROM med_store WHERE med_name='$med_name' ";
  $query_run = mysqli_query($conn, $query);

 if(mysqli_num_rows($query_run) > 0)
   {
 foreach($query_run as $row)
 {
                    
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
    <center><h1 class="med">Medicine Detail</h1></center>
    <div class="item">
     <div class="detail">
            <img src="./image/img/<?= $row['img']; ?>" alt="" width="250" height="250">
            <div class="div"><br><br>
                <h3>ID: </h3><br>
                <h2>Name :<?= $row['med_name']; ?></h2><br>
                <h2>Price: $<?= $row['price']; ?>.00</h2><br>
                <h3>Expire Date: <?= $row['exp_date']; ?></h3><br>
                <p><font size="5">Description: <?= $row['med_desc']; ?></font> </p>
                <a href="add_report.php"><button id="btn">[ BUY ]</button></a>
             </div>
    </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
 }
     }
 else
 {
 echo "No Record Found";
 }
 }
         
 ?>


