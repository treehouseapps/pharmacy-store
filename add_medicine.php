<?php 
session_start();
if ($_SESSION["role"] != "StoreMan") {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Register Medicine</title>
</head>

<body class="bg-gray-100 text-gray-800">
  <header>
    <?php include 'navbar.php'; ?>
  </header>

  <div class="flex justify-end p-4">
    <div class="flex items-center space-x-3 bg-white border border-purple-700 rounded-lg px-4 py-2 shadow">
      <img src="image/profile.jpg" alt="Profile" class="w-10 h-10 rounded-full">
      <h2 class="text-purple-800 font-semibold"><?php echo $_SESSION["role"]; ?></h2>
      <form action="login.php" method="POST">
        <button name="logout" type="submit" class="bg-red-600 text-white px-3 py-1 text-sm rounded hover:bg-red-700 transition">
          Logout
        </button>
      </form>
    </div>
  </div>

  <main class="flex flex-col items-center mt-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-4">REGISTER NEW MEDICINE</h1>

    <div class="bg-white w-full max-w-lg rounded-lg shadow-md p-6">
      <form class="space-y-4" action="pharmacy.php" method="POST" enctype="multipart/form-data">
        <h2 class="text-xl font-semibold text-center text-gray-700 mb-1">ADD Medicine</h2>
        <p class="text-sm text-center text-gray-500 mb-4">Add every detail of the medicine.</p>

        <input type="file" name="image" required class="block w-full text-sm text-gray-700 border rounded px-3 py-2">

        <input type="text" name="med_name" placeholder="Medicine Name" required
          class="block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <input type="text" name="exp_date" placeholder="Expire Date (e.g. 2025-12-31)" required
          class="block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <input type="number" name="price" placeholder="Price" required
          class="block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <input type="text" name="med_desc" placeholder="Description" required
          class="block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <button type="submit" name="submit"
          class="w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700 transition font-semibold">
          Register
        </button>
      </form>
    </div>
  </main>

  <?php include 'footer.php'; ?>
</body>

</html>
