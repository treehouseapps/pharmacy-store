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
  <title>Storeman List</title>
</head>

<body class="bg-gray-100 text-gray-800">
  <div class="container mx-auto px-4 py-6">
    <header>
      <?php include 'navbar.php'; ?>
    </header>

    <div class="absolute top-4 right-4 bg-white border border-purple-800 rounded-lg p-4 shadow-md flex items-center space-x-4">
      <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover">
      <div>
        <h2 class="font-semibold text-purple-800"><?php echo $_SESSION["role"]; ?></h2>
        <form action="login.php" method="POST" class="mt-1">
          <button name="logout" type="submit" class="text-sm text-white bg-red-600 px-3 py-1 rounded hover:bg-red-700 transition">
            Logout
          </button>
        </form>
      </div>
    </div>

    <section class="mt-20 text-center">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-blue-700">Storeman View</h1>
      </div>

      <div class="flex flex-col md:flex-row justify-center gap-6">
        <div class="bg-white shadow-md rounded-lg px-6 py-4 hover:shadow-lg transition">
          <a href="add_medicine.php">
            <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
              Add Medicine
            </button>
          </a>
        </div>
        <div class="bg-white shadow-md rounded-lg px-6 py-4 hover:shadow-lg transition">
          <a href="pharmacy.php">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
              Medicine Store Page
            </button>
          </a>
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>
  </div>
</body>

</html>
