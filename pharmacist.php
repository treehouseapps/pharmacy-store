<?php
session_start();
if ($_SESSION["role"] != "Sales") {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pharmacist View</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

    <div class="container mx-auto p-6">
        <!-- Navbar -->
        <header class="mb-6">
            <?php include 'navbar.php'; ?>
        </header>

        <!-- User Info -->
        <div class="absolute top-4 right-4 bg-white border border-amber-700 rounded-lg shadow px-4 py-2 flex items-center gap-3">
            <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover" />
            <div class="text-center">
                <h2 class="text-lg font-semibold text-amber-700"><?php echo $_SESSION["role"]; ?></h2>
                <form action="login.php" method="POST">
                    <button name="logout" type="submit"
                        class="mt-1 px-4 py-1 bg-amber-600 text-white text-sm rounded hover:bg-amber-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Content Section -->
        <section class="text-center mt-20">
            <h1 class="text-3xl font-bold text-amber-700 mb-10">Pharmacist View</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-center">
                <a href="pharmacy.php" class="block">
                    <button class="w-full bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-amber-700 transition">
                        Medicine Store Page
                    </button>
                </a>
                <a href="pharm_record.php" class="block">
                    <button class="w-full bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-amber-700 transition">
                        Report Page
                    </button>
                </a>
                <a href="add_report.php" class="block">
                    <button class="w-full bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-amber-700 transition">
                        Add Report Page
                    </button>
                </a>
            </div>
        </section>

        <!-- Footer -->
        <div class="mt-16">
            <?php include 'footer.php'; ?>
        </div>
    </div>

</body>

</html>
