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
  <title>Register Admins</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

  <header>
    <?php include 'navbar.php'; ?>
  </header>

  <div
    class="fixed top-4 right-4 flex items-center space-x-3 border border-amber-700 rounded-lg bg-white px-4 py-2 shadow z-50"
  >
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
    <h1 class="text-4xl font-bold mb-8 text-amber-700">REGISTER Admin</h1>

    <form
      action="admin_store.php"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-8 rounded-lg shadow max-w-md w-full"
    >
      <span class="block text-2xl font-semibold mb-1 text-amber-700">ADD Admin</span>
      <span class="block mb-6 text-gray-600">Create admin accounts</span>

      <div class="flex flex-col space-y-4 mb-6">
        <input
          type="file"
          name="image"
          required
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
        />
        <input
          type="text"
          name="member_fname"
          placeholder="First Name"
          required
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
        />
        <input
          type="text"
          name="member_sname"
          placeholder="Last Name"
          required
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
        />
        <input
          type="text"
          name="gender"
          placeholder="Gender"
          required
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
        />
        <input
          type="text"
          name="address"
          placeholder="Address"
          required
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
        />
        <input
          type="number"
          name="phone_no"
          placeholder="Phone Number"
          required
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
        />
      </div>

      <button
        type="submit"
        name="submit"
        class="w-full bg-amber-600 text-white font-semibold py-3 rounded hover:bg-amber-700 transition"
      >
        Register
      </button>
    </form>
  </main>

  <?php include 'footer.php'; ?>

</body>

</html>
