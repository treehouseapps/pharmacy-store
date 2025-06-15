<?php
session_start();
if ($_SESSION["role"] != "Admin") {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'medicine');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = null;
$id = null;
if (isset($_GET['member_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['member_id']);
    $report = "SELECT * FROM member_store WHERE member_id = $id";
    $bind = mysqli_query($conn, $report);
    $result = mysqli_fetch_assoc($bind);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Member</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

    <?php include 'navbar.php'; ?>

    <main class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-amber-700 mb-10">Edit Member Info</h1>

        <?php if ($result): ?>
        <form action="member_store.php?member_id=<?php echo $result['member_id']; ?>" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow space-y-6">
            <div class="flex flex-col md:flex-row gap-10">
                <div class="w-full md:w-1/3 flex flex-col items-center">
                    <img src="./image/img/<?php echo htmlspecialchars($result['img']); ?>" alt="Profile"
                        class="w-60 h-60 object-cover rounded shadow mb-4" />
                    <input type="file" name="image" required class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-amber-50 file:text-amber-700
                        hover:file:bg-amber-100" />
                </div>
                <div class="w-full md:w-2/3 space-y-4">
                    <p class="text-gray-600"><strong>Member ID:</strong> <?php echo htmlspecialchars($id); ?></p>
                    <div>
                        <label class="block font-medium">First Name</label>
                        <input type="text" name="member_fname" value="<?php echo htmlspecialchars($result['member_fname']); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded" required />
                    </div>
                    <div>
                        <label class="block font-medium">Last Name</label>
                        <input type="text" name="member_sname" value="<?php echo htmlspecialchars($result['member_sname']); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded" required />
                    </div>
                    <div>
                        <label class="block font-medium">Gender</label>
                        <input type="text" name="gender" value="<?php echo htmlspecialchars($result['gender']); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded" required />
                    </div>
                    <div>
                        <label class="block font-medium">Address</label>
                        <input type="text" name="address" value="<?php echo htmlspecialchars($result['address']); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded" required />
                    </div>
                    <div>
                        <label class="block font-medium">Phone Number</label>
                        <input type="number" name="phone_no" value="<?php echo htmlspecialchars($result['phone_no']); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded" required />
                    </div>
                    <div>
                        <label class="block font-medium">User Type</label>
                        <input type="text" name="role" value="<?php echo htmlspecialchars($result['role']); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded" required />
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" name="update"
                    class="px-6 py-2 bg-amber-600 text-white font-semibold rounded hover:bg-amber-700 transition">
                    Done
                </button>
            </div>
        </form>
        <?php else: ?>
        <div class="text-center text-gray-600 text-lg">
            Member not found or invalid ID.
        </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
