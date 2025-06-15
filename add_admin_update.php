<?php
session_start();
if ($_SESSION["role"] != "SAdmin") {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'medicine');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    if (isset($_GET['member_id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['member_id']);
        $report = "SELECT * FROM admin_store WHERE member_id = $id";
        $bind = mysqli_query($conn, $report);
        $result = mysqli_fetch_assoc($bind);
        mysqli_free_result($bind);
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Admin</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<?php include 'navbar.php'; ?>

<main class="container mx-auto px-4 py-10 flex-grow">
    <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-10">Edit Admin</h1>

    <?php if ($result): ?>
    <form action="admin_store.php?member_id=<?php echo (int)$result['member_id']; ?>" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row md:space-x-8 items-center">
            <div class="mb-6 md:mb-0 flex flex-col items-center">
                <img
                    src="./image/img/<?php echo htmlspecialchars($result['img']); ?>"
                    alt="Admin Image"
                    class="w-64 h-64 object-cover rounded-full border-4 border-amber-400 shadow-md mb-6"
                    loading="lazy"
                />
                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                    file:rounded file:border-0
                    file:text-sm file:font-semibold
                    file:bg-amber-500 file:text-white
                    hover:file:bg-amber-600
                    cursor-pointer" />
            </div>

            <div class="flex-grow space-y-6 w-full">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Member ID:</label>
                    <p class="text-gray-900 font-mono text-lg"><?php echo htmlspecialchars($id); ?></p>
                </div>

                <div>
                    <label for="member_fname" class="block text-gray-700 font-semibold mb-1">First Name</label>
                    <input
                        type="text"
                        id="member_fname"
                        name="member_fname"
                        required
                        value="<?php echo htmlspecialchars($result['member_fname']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-400"
                    />
                </div>

                <div>
                    <label for="member_sname" class="block text-gray-700 font-semibold mb-1">Last Name</label>
                    <input
                        type="text"
                        id="member_sname"
                        name="member_sname"
                        required
                        value="<?php echo htmlspecialchars($result['member_sname']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-400"
                    />
                </div>

                <div>
                    <label for="gender" class="block text-gray-700 font-semibold mb-1">Gender</label>
                    <input
                        type="text"
                        id="gender"
                        name="gender"
                        required
                        value="<?php echo htmlspecialchars($result['gender']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-400"
                    />
                </div>

                <div>
                    <label for="address" class="block text-gray-700 font-semibold mb-1">Address</label>
                    <input
                        type="text"
                        id="address"
                        name="address"
                        required
                        value="<?php echo htmlspecialchars($result['address']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-400"
                    />
                </div>

                <div>
                    <label for="phone_no" class="block text-gray-700 font-semibold mb-1">Phone Number</label>
                    <input
                        type="number"
                        id="phone_no"
                        name="phone_no"
                        required
                        value="<?php echo htmlspecialchars($result['phone_no']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-400"
                    />
                </div>

                <div>
                    <label for="role" class="block text-gray-700 font-semibold mb-1">User Type</label>
                    <input
                        type="text"
                        id="role"
                        name="role"
                        required
                        value="<?php echo htmlspecialchars($result['role'] ?? ''); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-400"
                    />
                </div>

                <button
                    type="submit"
                    name="update"
                    class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded shadow focus:outline-none focus:ring-2 focus:ring-amber-400"
                >
                    Done
                </button>
            </div>
        </div>
    </form>
    <?php else: ?>
        <p class="text-center text-red-600 font-semibold">Admin data not found.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
