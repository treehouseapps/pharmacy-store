<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Navbar</title>
</head>

<body class="bg-gray-100">
  <div class="flex items-center justify-between px-6 py-4 bg-white shadow-md">
    <div class="flex items-center gap-4">
      <img src="image/logo.jpg" alt="Logo" class="w-12 h-12 rounded-full" />
      <h1 class="text-2xl font-bold">Lalibela</h1>
    </div>

    <ul class="flex items-center gap-6">
      <li><a href="index.php" class="hover:text-blue-600">HOME</a></li>
      <li class="relative group">
        <button class="hover:text-blue-600">PHARMACY LIST</button>
        <div class="absolute hidden group-hover:block bg-white shadow-lg p-3 mt-2 space-y-2 z-10">
          <a href="pharmacy.php" class="block hover:text-blue-500">Lalibela</a>
          <a href="pharmacy.php" class="block hover:text-blue-500">Kdus Markos</a>
          <a href="pharmacy.php" class="block hover:text-blue-500">Gozamn</a>
        </div>
      </li>
      <li><a href="#footer" class="hover:text-blue-600">ABOUT US</a></li>
      <li><a href="#footer" class="hover:text-blue-600">CONTACT</a></li>
      <li><a href="login.php" class="hover:text-blue-600">LOGIN</a></li>
    </ul>

    <div class="flex items-center gap-2">
      <img src="image/facebook.svg" alt="Facebook" class="w-6 h-6" />
      <img src="image/twitter.svg" alt="Twitter" class="w-6 h-6" />
      <img src="image/instagram.svg" alt="Instagram" class="w-6 h-6" />
    </div>
  </div>
</body>

</html>
