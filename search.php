<?php
$conn = new mysqli('localhost', 'root', '', 'medicine');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$med = null;
$med_found = false;
if (isset($_POST['search'])) {
    $med_name = $_POST['med_name'];

    // Prepared statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM med_store WHERE med_name = ?");
    $stmt->bind_param('s', $med_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $med = $result->fetch_assoc();
        $med_found = true;
    } else {
        $med_found = false;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Medicine Detail</title>
    <!-- Optional: Tailwind CSS for quick styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/pharm.css" />
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<?php include 'navbar.php'; ?>

<main class="container mx-auto p-6 flex-grow">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Medicine Detail</h1>

    <?php if (isset($_POST['search'])): ?>
        <?php if ($med_found): ?>
            <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md flex flex-col md:flex-row gap-6 items-center">
                <img
                    src="./image/img/<?php echo htmlspecialchars($med['img']); ?>"
                    alt="<?php echo htmlspecialchars($med['med_name']); ?>"
                    class="w-64 h-64 object-cover rounded border-4 border-amber-400 shadow"
                    loading="lazy"
                    onerror="this.onerror=null; this.src='image/empty.jpg'"
                />
                <div class="flex-grow space-y-4">
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($med['med_id'] ?? 'N/A'); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($med['med_name']); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($med['price']); ?>.00</p>
                    <p><strong>Expire Date:</strong> <?php echo htmlspecialchars($med['exp_date']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($med['med_desc']); ?></p>

                    <a href="add_report.php" class="inline-block mt-4 px-6 py-2 bg-amber-700 hover:bg-amber-600 text-white rounded shadow">
                        BUY
                    </a>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-red-600 font-semibold">No record found for medicine: <?php echo htmlspecialchars($med_name); ?></p>
        <?php endif; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
