<?php
session_start();
if (($_SESSION["role"] != "Admin")) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'medicine');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Add member
if (isset($_POST['submit'])) {
    $img = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./image/img/" . $img;
    move_uploaded_file($tempname, $folder);

    $stmt = $conn->prepare("INSERT INTO member_store(img, member_fname, member_sname, gender, address, phone_no, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $img, $_POST['member_fname'], $_POST['member_sname'], $_POST['gender'], $_POST['address'], $_POST['phone_no'], $_POST['role']);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Member Added Successfully');</script>";
}

// Update member
if (isset($_POST['update']) && isset($_GET['member_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['member_id']);
    $img = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./image/img/" . $img;
    move_uploaded_file($tempname, $folder);

    $sql = "UPDATE member_store SET member_fname=?, member_sname=?, img=?, address=?, phone_no=?, role=? WHERE member_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisi", $_POST['member_fname'], $_POST['member_sname'], $img, $_POST['address'], $_POST['phone_no'], $_POST['role'], $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Data Updated Successfully');</script>";
}

// Delete member
if (isset($_POST['delete']) && isset($_GET['member_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['member_id']);
    $result = mysqli_query($conn, "DELETE FROM member_store WHERE member_id = $id");
    echo "<script>alert('" . ($result ? 'Deleted' : 'Failed to delete') . "');</script>";
}

// Fetch members
$members = $conn->query("SELECT * FROM member_store")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Member Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <?php if (isset($_SESSION['role'])) : ?>
        <div class="flex items-center justify-end p-4">
            <div class="flex items-center gap-4 bg-white shadow p-3 rounded-xl border border-amber-600">
                <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover" />
                <div>
                    <h2 class="font-bold"><?php echo $_SESSION["role"]; ?></h2>
                    <form action="login.php" method="POST">
                        <button name="logout" type="submit"
                            class="mt-1 px-3 py-1 bg-amber-600 text-white text-sm rounded hover:bg-amber-700">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <main class="px-6 py-10">
        <h1 class="text-3xl font-bold text-center text-amber-700 mb-10">Pharmacy Members Store</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($members as $member) : ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden p-4 text-center">
                    <img src="./image/img/<?php echo htmlspecialchars($member['img']); ?>" alt="Profile" class="mx-auto w-32 h-32 object-cover rounded-full mb-4" />
                    <h5 class="text-gray-700 text-sm font-medium">ID: <?php echo htmlspecialchars($member['member_id']); ?></h5>
                    <h3 class="text-lg font-bold mt-1"><?php echo htmlspecialchars($member['member_fname'] . ' ' . $member['member_sname']); ?></h3>
                    <p class="text-sm text-gray-600"><?php echo htmlspecialchars($member['role']); ?></p>
                    <a href="member_details.php?member_id=<?php echo $member['member_id']; ?>">
                        <button class="mt-4 px-4 py-2 bg-amber-600 text-white rounded hover:bg-amber-700 text-sm">
                            More Info
                        </button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
