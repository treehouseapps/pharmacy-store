<?php 
session_start();
if (($_SESSION["role"] != "Admin")) {
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
    <title>Register Members</title>
</head>

<body class="bg-gray-50 font-sans min-h-screen">

    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="absolute top-4 right-4 flex items-center gap-3 bg-white border border-amber-600 rounded-xl p-3 shadow">
        <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover" />
        <div class="text-sm">
            <h2 class="font-semibold"><?php echo $_SESSION["role"]; ?></h2>
            <form action="login.php" method="POST">
                <button name="logout" type="submit"
                    class="mt-1 px-3 py-1 bg-amber-600 text-white rounded hover:bg-amber-700 text-xs">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <main class="flex flex-col items-center justify-center py-16 px-4">
        <h1 class="text-3xl font-bold text-amber-700 mb-6">REGISTER SHOP MEMBERS</h1>

        <form class="bg-white rounded-xl shadow-md p-8 w-full max-w-md"
            action="member_store.php" method="POST" enctype="multipart/form-data">
            <h2 class="text-xl font-semibold mb-2">Add Member</h2>
            <p class="text-gray-600 mb-4">Create a user account for shop members.</p>

            <div class="space-y-4">
                <input type="file" name="image" required
                    class="w-full text-sm border border-gray-300 rounded-lg p-2 bg-gray-50" />
                <input type="text" name="member_fname" placeholder="First Name" required
                    class="w-full border border-gray-300 rounded-lg p-2" />
                <input type="text" name="member_sname" placeholder="Last Name" required
                    class="w-full border border-gray-300 rounded-lg p-2" />
                <input type="text" name="gender" placeholder="Gender" required
                    class="w-full border border-gray-300 rounded-lg p-2" />
                <input type="text" name="address" placeholder="Address" required
                    class="w-full border border-gray-300 rounded-lg p-2" />
                <input type="number" name="phone_no" placeholder="Phone Number" required
                    class="w-full border border-gray-300 rounded-lg p-2" />
                <input type="text" name="role" placeholder="User Type" required
                    class="w-full border border-gray-300 rounded-lg p-2" />
            </div>

            <button type="submit" name="submit"
                class="mt-6 w-full bg-amber-600 hover:bg-amber-700 text-white py-2 px-4 rounded-lg transition">
                Register
            </button>
        </form>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
