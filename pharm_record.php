<?php
session_start();
if ($_SESSION["role"] != "Sales") {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'medicine');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Report
if (isset($_POST["submit"])) {
    $img = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./image/img/" . $img;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];
    $med_name = $_POST['med_name'];
    $buy_date = $_POST['buy_date'];
    $quantity = $_POST['quantity'];

    move_uploaded_file($tempname, $folder);

    $stmt = $conn->prepare("INSERT INTO report_store (img, first_name, last_name, address, phone_no, med_name, buy_date, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss", $img, $first_name, $last_name, $address, $phone_no, $med_name, $buy_date, $quantity);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Report Added Successfully');</script>";
}

// Update Report
if (isset($_POST["update"])) {
    $img = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./image/img/" . $img;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];
    $med_name = $_POST['med_name'];
    $buy_date = $_POST['buy_date'];
    $quantity = $_POST['quantity'];

    if (isset($_GET['report_id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['report_id']);
        move_uploaded_file($tempname, $folder);

        $sql = "UPDATE report_store SET first_name = ?, last_name = ?, img = ?, address = ?, phone_no = ?, med_name = ?, buy_date = ?, quantity = ? WHERE report_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisssi", $first_name, $last_name, $img, $address, $phone_no, $med_name, $buy_date, $quantity, $id);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Report Updated Successfully');</script>";
    }
}

// Delete Data
if (isset($_POST['delete'])) {
    if (isset($_GET['report_id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['report_id']);
        $query = "DELETE FROM report_store WHERE report_id = $id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "<script>alert('Data Not Deleted');</script>";
        } else {
            echo "<script>alert('Report deleted Successfully');</script>";
        }
    }
}

// Select all reports
$mem = "SELECT * FROM report_store";
$bin = mysqli_query($conn, $mem);
$prints = mysqli_fetch_all($bin, MYSQLI_ASSOC);
mysqli_free_result($bin);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Medicine Buyers Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen text-gray-800">
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="container mx-auto px-4 py-6 relative">
        <!-- User Info Top Right -->
        <div
            class="absolute top-4 right-4 flex items-center space-x-3 border border-amber-700 rounded-lg bg-white px-4 py-2 shadow">
            <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover" />
            <div class="text-center">
                <a href="pharmacist.php" class="font-semibold text-amber-700 hover:underline">
                    <?php echo htmlspecialchars($_SESSION["role"]); ?>
                </a>
                <form action="login.php" method="POST" class="mt-1">
                    <button name="logout" type="submit"
                        class="px-4 py-1 bg-amber-600 text-white rounded hover:bg-amber-700 transition text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <section class="max-w-7xl mx-auto mt-16">
            <h1 class="text-4xl font-bold text-center text-amber-700 mb-12">Medicine Buyers Information</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <?php foreach ($prints as $print) : ?>
                <div
                    class="bg-white rounded-lg shadow p-5 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="./image/img/<?php echo htmlspecialchars($print['img']); ?>" alt="Buyer Image"
                        class="w-36 h-36 object-cover rounded mb-4" />
                    <div class="space-y-1">
                        <h4 class="font-semibold">Id: <?php echo htmlspecialchars($print['report_id']); ?></h4>
                        <h3>First Name: <?php echo htmlspecialchars($print['first_name']); ?></h3>
                        <h3>Last Name: <?php echo htmlspecialchars($print['last_name']); ?></h3>
                        <h3>Medicine: <?php echo htmlspecialchars($print['med_name']); ?></h3>
                    </div>
                    <a href="report_details.php?report_id=<?php echo $print['report_id']; ?>"
                        class="mt-4 inline-block bg-amber-600 text-white px-5 py-2 rounded shadow hover:bg-amber-700 transition">
                        More info
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
