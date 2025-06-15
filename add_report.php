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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register Members</title>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <?php if (isset($_SESSION['role'])) : ?>
    <div
        class="fixed top-4 right-4 flex items-center space-x-3 border border-amber-700 rounded-lg bg-white px-4 py-2 shadow z-50">
        <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover" />
        <div class="text-center">
            <a href="pharmacist.php" class="font-semibold text-amber-700 hover:underline">
                <?php echo htmlspecialchars($_SESSION["role"]); ?>
            </a>
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
    <?php endif; ?>

    <main class="flex-grow flex flex-col justify-center items-center py-16 px-4">
        <h1 class="text-4xl font-bold text-amber-700 mb-10">Report Writing</h1>

        <form
            class="bg-white shadow-lg rounded-lg max-w-md w-full p-8 space-y-6"
            action="pharm_record.php"
            method="POST"
            enctype="multipart/form-data"
        >
            <h2 class="text-xl font-semibold mb-2">Add Report</h2>
            <p class="mb-6 text-gray-600">Add every detail of buyer information.</p>

            <input
                type="file"
                name="image"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <input
                type="text"
                name="first_name"
                placeholder="First Name"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <input
                type="text"
                name="last_name"
                placeholder="Last Name"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <input
                type="text"
                name="address"
                placeholder="Address"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <input
                type="number"
                name="phone_no"
                placeholder="Phone Number"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <input
                type="text"
                name="med_name"
                placeholder="Medicine Name"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <input
                type="text"
                name="buy_date"
                placeholder="Buy Date"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <input
                type="text"
                name="quantity"
                placeholder="Quantity"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
            />

            <button
                type="submit"
                name="submit"
                class="w-full bg-amber-600 text-white font-semibold py-2 rounded hover:bg-amber-700 transition"
            >
                ADD
            </button>
        </form>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>
