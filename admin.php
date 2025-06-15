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
    <title>Admin View</title>
</head>

<body class="bg-gray-100 min-h-screen font-sans">
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

    <section class="text-center py-20">
        <h1 class="text-3xl font-bold text-amber-700 mb-10">Admin View</h1>

        <div class="flex flex-col md:flex-row justify-center gap-6">
            <a href="add_members.php">
                <button class="px-6 py-3 bg-amber-600 text-white font-semibold rounded-xl hover:bg-amber-700 shadow">
                    Add Members
                </button>
            </a>

            <a href="member_store.php">
                <button class="px-6 py-3 bg-amber-600 text-white font-semibold rounded-xl hover:bg-amber-700 shadow">
                    Members List
                </button>
            </a>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>
