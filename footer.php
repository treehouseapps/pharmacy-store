<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<footer id="footer" class="bg-gray-100 text-gray-800 py-10 px-6">
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
    
    <div class="space-y-2 text-center md:text-left">
      <img src="image/logo.jpg" alt="Logo" width="70" height="70" class="mx-auto md:mx-0">
      <h2 class="text-2xl font-bold">Lalibela</h2>
    </div>

    <div class="space-y-4 text-sm">
      <div class="flex items-center">
        <img src="image/location.png" class="bg-gray-300 p-1 mx-1"  alt="Location" width="24" height="24">
        <span>Debremarkos, Ethiopia</span>
      </div>
      <div class="flex items-center">
        <img src="image/phone.png" class="bg-gray-300 p-1 mx-1" alt="Phone" width="24" height="24">
        <span>+251 911 111 111</span>
      </div>
      <div class="flex items-center">
        <img src="image/message.png"  class="bg-gray-300 p-1 mx-1" alt="Email" width="24" height="24">
        <a href="mailto:bbekijunior@gmail.com" class="hover:underline">bbekijunior@gmail.com</a>
      </div>
    </div>

    <div class="space-y-2 text-sm">
      <h2 class="text-lg font-semibold">About the Company</h2>
      <p class="text-gray-600">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
      </p>
    </div>
  </div>

  <div class="text-center mt-10 text-sm">
  &copy; <span id="date">2025</span> Self Motivation, Inc — All Rights Reserved.
</div>
</footer>
<script>
  document.getElementById('date').innerHTML = new Date().getFullYear();
</script>

</body>
</html>