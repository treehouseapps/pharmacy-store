<?php 
session_start();
if ($_SESSION["role"] != "Admin") {
    header("Location: login.php");
    exit();
}

// Connection
$conn = new mysqli('localhost', 'root', '', 'medicine');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = null;
if (isset($_GET['member_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['member_id']);
    $report = "SELECT * FROM member_store WHERE member_id = $id";
    $bind = mysqli_query($conn, $report);
    $result = mysqli_fetch_assoc($bind);
    mysqli_free_result($bind);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Member Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">
    <?php include 'navbar.php'; ?>

    <main class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center text-amber-700 mb-10">Member Profile Detail</h1>

        <?php if ($result): ?>
        <div class="bg-white shadow-md rounded-xl p-6 md:flex gap-10 items-start">
            <div class="flex-shrink-0 mx-auto md:mx-0">
                <img src="./image/img/<?php echo htmlspecialchars($result['img']); ?>" alt="Profile" class="w-64 h-64 object-cover rounded-xl shadow" />
            </div>
            <div class="mt-6 md:mt-0">
                <div class="space-y-2 text-gray-700">
                    <h3><span class="font-semibold">ID:</span> <?php echo htmlspecialchars($result['member_id']); ?></h3>
                    <h3><span class="font-semibold">First Name:</span> <?php echo htmlspecialchars($result['member_fname']); ?></h3>
                    <h3><span class="font-semibold">Last Name:</span> <?php echo htmlspecialchars($result['member_sname']); ?></h3>
                    <h3><span class="font-semibold">Gender:</span> <?php echo htmlspecialchars($result['gender']); ?></h3>
                    <h3><span class="font-semibold">Address:</span> <?php echo htmlspecialchars($result['address']); ?></h3>
                    <h3><span class="font-semibold">Phone Number:</span> <?php echo htmlspecialchars($result['phone_no']); ?></h3>
                    <h3><span class="font-semibold">User Type:</span> <?php echo htmlspecialchars($result['role']); ?></h3>
                </div>

                <div class="flex gap-4 mt-6">
                    <a href="add_member_update.php?member_id=<?php echo $result['member_id']; ?>">
                        <button class="px-4 py-2 bg-amber-600 text-white rounded hover:bg-amber-700 transition">
                            Edit
                        </button>
                    </a>
                    <form action="member_store.php?member_id=<?php echo $result['member_id']; ?>" method="POST">
                        <button type="submit" name="delete"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="text-center text-gray-600 text-lg">
            Member not found or invalid ID.
        </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
