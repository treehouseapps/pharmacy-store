<?php
session_start();

// Redirect if not logged in or no role
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'medicine');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$result = null;
if (isset($_GET['report_id'])) {
    $id = $conn->real_escape_string($_GET['report_id']);
    $sql = "SELECT * FROM report_store WHERE report_id = $id";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        $result = $res->fetch_assoc();
    }
    $res->free();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer Profile Detail</title>
    <!-- Tailwind CDN for quick styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<?php include 'navbar.php'; ?>

<main class="container mx-auto px-4 py-10 flex-grow">
    <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">Customer Profile Detail</h1>

    <?php if ($result): ?>
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md flex flex-col md:flex-row gap-8 items-center">
            <img
                src="./image/img/<?php echo htmlspecialchars($result['img'] ?? 'empty.jpg'); ?>"
                alt="Customer Image"
                class="w-64 h-64 rounded-lg object-cover border-4 border-amber-400 shadow-md"
                loading="lazy"
                onerror="this.onerror=null; this.src='image/empty.jpg'"
            />

            <div class="flex-grow space-y-4">
                <p><strong>Report ID:</strong> <?php echo htmlspecialchars($result['report_id']); ?></p>
                <p><strong>First Name:</strong> <?php echo htmlspecialchars($result['first_name']); ?></p>
                <p><strong>Last Name:</strong> <?php echo htmlspecialchars($result['last_name']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($result['address']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($result['phone_no']); ?></p>
                <p><strong>Medicine Name:</strong> <?php echo htmlspecialchars($result['med_name']); ?></p>
                <p><strong>Buy Date:</strong> <?php echo htmlspecialchars($result['buy_date']); ?></p>
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($result['quantity']); ?></p>

                <div class="flex space-x-4 mt-6">
                    <a href="add_update.php?report_id=<?php echo urlencode($result['report_id']); ?>">
                        <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded shadow">
                            Edit
                        </button>
                    </a>

                    <form
                        action="pharm_record.php?report_id=<?php echo urlencode($result['report_id']); ?>"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this record?');"
                    >
                        <button
                            type="submit"
                            name="delete"
                            class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded shadow"
                        >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center text-red-600 font-semibold">No report found with this ID.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
