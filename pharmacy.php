<?php
session_start();
// connection 
$conn = new mysqli('localhost', 'root', '', 'medicine');
   
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
    else{
    // Add Medicine
    if(isset($_POST["submit"])){
        $img = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/img/" . $img;
        $med_name = $_POST['med_name'];
        $exp_date = $_POST['exp_date'];
        $price = $_POST['price'];
        $med_desc = $_POST['med_desc'];
        move_uploaded_file($tempname, $folder);
        $stmt = $conn->prepare("insert into med_store(img, med_name, exp_date, price, med_desc)values(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $img, $med_name, $exp_date, $price, $med_desc);
        $stmt->execute();
        $stmt->close();
        echo  "<script> alert('Medicine Added Successfully');</script>"; 
   
    }
    // Update Medicine
if (isset($_POST['update'])) {
    if(isset($_GET['med_id'])){
        $username = $_POST['username'];
        $price = $_POST['price'];
        $expire = $_POST['expire'];
        $descreption = $_POST['descreption'];
        $img = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/img/" . $img;
        $id = mysqli_real_escape_string($conn, $_GET['med_id']);
        move_uploaded_file($tempname, $folder);
        //select the tabel
        $sql = "UPDATE med_store SET med_name = '$username', img = '$img', price = '$price', med_desc = '$descreption', exp_date = '$expire' WHERE med_id= $id";
        // Prepare statement
        $stmt = $conn->prepare($sql);
        // execute the query
        $stmt->execute();
        echo  "<script> alert('Medicine Added Successfully');</script>"; 


}}
if (isset($_POST['delete'])) {
    if(isset($_GET['med_id'])){
        // get id to delete
        $id = mysqli_real_escape_string($conn, $_GET['med_id']);}
        // mysql delete query 
        $query = "DELETE FROM `med_store` WHERE `med_id` = $id";
        $result = mysqli_query($conn, $query);
        if(!$result){echo  "<script> alert('Data Not Deleted');</script>";} 
        else{ echo "<script> alert('Data deleted Sucessfully');</script>";}

}

// Select the table
$medicine = 'SELECT * FROM med_store';
// Get results
$bind = mysqli_query($conn, $medicine);
// Fetch the results
$result = mysqli_fetch_all($bind, MYSQLI_ASSOC);
// Free the results
mysqli_free_result($bind);
// Close connection
mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style.css">
  <title>Pharmacy</title>
</head>

<body class="bg-gray-50 text-gray-800">
  <header>
    <?php include 'navbar.php'; ?>
  </header>

  <?php if (isset($_SESSION['role'])) { ?>
    <div class="flex items-center gap-4 bg-white p-4 shadow-md rounded mx-auto max-w-4xl my-4">
      <img src="image/profile.jpg" alt="" width="50" height="50" class="rounded-full">
      <h2 class="text-lg font-semibold">
        <a href="pharmacist.php" class="text-blue-700 hover:underline">
          <?php echo $_SESSION["role"]; ?>
        </a>
      </h2>
      <form action="login.php" method="POST" class="ml-auto">
        <button name="logout" type="submit" class="mt-4 px-6 py-2 bg-amber-800 text-white rounded hover:bg-amber-700 transition">
          Logout
        </button>
      </form>
    </div>
  <?php } ?>

  <div class="container mx-auto px-4">
    
    <div class="bg-white shadow p-6 rounded-lg my-8 text-center space-y-4">
      <h1 class="text-2xl md:text-3xl font-bold">Lalibela Medicine Store</h1>
      <form action="search.php" method="POST" class="flex flex-col md:flex-row justify-center items-center gap-4">
        <input type="text" name="med_name" placeholder="Search Medicine..." required
          class="w-full max-w-md border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="submit" name="search"
          class="mt-4 px-6 py-2 bg-amber-800 text-white rounded hover:bg-amber-700 transition">
          Search
        </button>
      </form>
    </div>

    <div class="mb-6">
      <h2 class="text-xl font-semibold mb-4 text-center">Frequently Asked Medicines</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach($result as $resul) { ?>
          <div class="bg-white shadow rounded overflow-hidden text-center p-4 hover:shadow-lg transition">
            <img src="./image/img/<?php echo htmlspecialchars($resul['img']); ?>" alt="Medicine Image" class="w-full h-48 object-contain mx-auto mb-4">
            <h2 class="text-lg font-semibold"><?php echo htmlspecialchars($resul['med_name']); ?></h2>
            <h3 class="font-medium mt-1"><?php echo htmlspecialchars($resul['price']); ?>.00 Birr</h3>
            <a href="medicine_details.php?med_id=<?php echo $resul['med_id']; ?>">
              <button class="mt-4 px-6 py-2 bg-amber-800 text-white rounded hover:bg-amber-700 transition">
                More Info
              </button>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
