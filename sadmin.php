<?php
session_start();
if ($_SESSION["role"] != "SAdmin") {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Super Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

  <header>
    <?php include 'navbar.php'; ?>
  </header>

  <!-- User info box top-right -->
  <div
    class="fixed top-4 right-4 flex items-center space-x-3 border border-amber-700 rounded-lg bg-white px-4 py-2 shadow z-50">
    <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover" />
    <div class="text-center">
      <h2 class="font-semibold text-amber-700"><?php echo htmlspecialchars($_SESSION["role"]); ?></h2>
      <form action="login.php" method="POST" class="mt-1">
        <button
          name="logout"
          type="submit"
          class="px-4 py-1 bg-amber-600 text-white rounded hover:bg-amber-700 transition text-sm"
        >
          Logout
        </button>
      </form>
    </div>
  </div>

  <main class="flex-grow flex flex-col items-center justify-center py-20 px-4">
    <section class="w-full max-w-lg bg-white rounded-lg shadow p-8 text-center">
      <h1 class="text-3xl font-bold mb-8 text-amber-700">Admin View</h1>

      <div class="flex justify-center gap-6">
        <a href="add_smembers.php"
          class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-semibold px-8 py-4 rounded shadow transition">
          Add Members
        </a>
        <a href="admin_store.php"
          class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-semibold px-8 py-4 rounded shadow transition">
          Members List
        </a>
      </div>
    </section>
  </main>

  <?php include 'footer.php'; ?>

</body>

</html>
