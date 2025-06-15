<?php 
session_start();
// connection 
$conn = new mysqli('localhost', 'root', '', 'medicine');
   
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
else{
    if(isset($_GET['med_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['med_id']);
        $medicine = "SELECT * FROM med_store WHERE med_id = $id";
        $bind = mysqli_query($conn, $medicine);
        $result = mysqli_fetch_assoc($bind);
        mysqli_free_result($bind);
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Medicine Detail</title>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
  <?php include 'navbar.php'; ?>

  <h1 class="text-center text-3xl font-bold mt-8 mb-6 text-blue-800">Medicine Detail</h1>

  <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row gap-8">
    <?php if($result): ?>
    <div class="flex-shrink-0">
      <img src="./image/img/<?php echo htmlspecialchars($result['img']); ?>" alt="" class="w-64 h-64 object-cover rounded-lg shadow" />
    </div>
    <div class="flex-1 space-y-4">
      <?php if(isset($_SESSION['role'])): ?>
        <h3 class="text-gray-600">ID: <span class="font-medium"><?php echo htmlspecialchars($result['med_id']); ?></span></h3>
      <?php endif; ?>

      <h2 class="text-2xl font-semibold text-blue-700"><?php echo htmlspecialchars($result['med_name']); ?></h2>
      <h3 class="text-xl font-medium text-green-700">Price: $<?php echo htmlspecialchars($result['price']); ?>.00</h3>

      <?php if(isset($_SESSION['role'])): ?>
        <h3 class="text-sm text-gray-600">Expire Date: <span class="font-medium"><?php echo htmlspecialchars($result['exp_date']); ?></span></h3>
      <?php endif; ?>

      <p class="text-base leading-relaxed">
        <span class="font-semibold">Description:</span> <?php echo htmlspecialchars($result['med_desc']); ?>
      </p>

      <a href="add_report.php">
        <button class="mt-4 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">BUY</button>
      </a>

      <?php endif; ?>

      <?php if(isset($_SESSION['role'])): ?>
      <div class="flex gap-4 mt-6">
        <a href="add_update_med.php?med_id=<?php echo $result['med_id']?>">
          <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Edit</button>
        </a>
        <form action="pharmacy.php?med_id=<?php echo $result['med_id']?>" method="POST">
          <button type="submit" name="delete" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Delete</button>
        </form>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
