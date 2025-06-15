<?php
session_start();
if ($_SESSION["role"] !== "SAdmin") {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'medicine');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    if (!empty($_FILES["image"]["name"])) {
        $img = basename($_FILES["image"]["name"]);
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/img/" . $img;

        if (move_uploaded_file($tempname, $folder)) {
            $member_fname = $_POST['member_fname'];
            $member_sname = $_POST['member_sname'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $phone_no = $_POST['phone_no'];

            $stmt = $conn->prepare("INSERT INTO admin_store (img, member_fname, member_sname, gender, address, phone_no) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $img, $member_fname, $member_sname, $gender, $address, $phone_no);
            $stmt->execute();
            $stmt->close();

            echo "<script>alert('Admin Added Successfully');</script>";
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    } else {
        echo "<script>alert('Please upload an image');</script>";
    }
}

if (isset($_POST['update']) && isset($_GET['member_id'])) {
    $id = (int) $_GET['member_id'];

    $member_fname = $_POST['member_fname'];
    $member_sname = $_POST['member_sname'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];

    $img = null;
    if (!empty($_FILES["image"]["name"])) {
        $img = basename($_FILES["image"]["name"]);
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/img/" . $img;
        move_uploaded_file($tempname, $folder);
    }

    if ($img) {
        $stmt = $conn->prepare("UPDATE admin_store SET member_fname=?, member_sname=?, img=?, address=?, phone_no=? WHERE member_id=?");
        $stmt->bind_param("sssssi", $member_fname, $member_sname, $img, $address, $phone_no, $id);
    } else {
        $stmt = $conn->prepare("UPDATE admin_store SET member_fname=?, member_sname=?, address=?, phone_no=? WHERE member_id=?");
        $stmt->bind_param("sssii", $member_fname, $member_sname, $address, $phone_no, $id);
    }
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Data Updated Successfully');</script>";
}

if (isset($_POST['delete']) && isset($_GET['member_id'])) {
    $id = (int) $_GET['member_id'];
    $stmt = $conn->prepare("DELETE FROM admin_store WHERE member_id = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        echo "<script>alert('Report deleted Successfully');</script>";
    } else {
        echo "<script>alert('Data Not Deleted');</script>";
    }
}

// Fetch all admins
$sql = "SELECT * FROM admin_store";
$result = $conn->query($sql);
$admins = [];
if ($result) {
    $admins = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Super Admin</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<header>
    <?php include 'navbar.php'; ?>
</header>

<?php if (isset($_SESSION['role'])): ?>
    <div
        class="absolute top-4 right-4 flex items-center space-x-4 border border-amber-700 rounded-lg p-3 bg-white shadow-md z-50"
        aria-label="User session info"
    >
        <img src="image/profile.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover" />
        <h2 class="text-xl font-semibold text-amber-900">
            <a href="sadmin.php" class="hover:underline"><?php echo htmlspecialchars($_SESSION["role"]); ?></a>
        </h2>
        <form action="login.php" method="POST" class="">
            <button
                name="logout"
                type="submit"
                class="bg-amber-700 hover:bg-amber-900 text-white px-4 py-2 rounded shadow"
            >
                Logout
            </button>
        </form>
    </div>
<?php endif; ?>

<main class="container mx-auto px-4 py-10 flex-grow">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-10 text-center">Admin List</h1>

    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php foreach ($admins as $admin): ?>
            <article
                class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300"
                role="article"
                aria-label="Admin <?php echo htmlspecialchars($admin['member_fname'] . ' ' . $admin['member_sname']); ?>"
            >
                <img
                    src="./image/img/<?php echo htmlspecialchars($admin['img']); ?>"
                    alt="Admin Image"
                    class="w-36 h-36 rounded-full object-cover mb-4"
                    width="150"
                    height="150"
                    loading="lazy"
                />
                <h5 class="text-gray-600 font-semibold mb-1">ID: <?php echo htmlspecialchars($admin['member_id']); ?></h5>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    <?php echo htmlspecialchars($admin['member_fname'] . ' ' . $admin['member_sname']); ?>
                </h3>
                <a href="admin_details.php?member_id=<?php echo (int)$admin['member_id']; ?>">
                    <button
                        class="bg-amber-700 hover:bg-amber-600 text-white px-5 py-2 rounded font-semibold shadow focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-opacity-75"
                        type="button"
                    >
                        More info
                    </button>
                </a>
            </article>
        <?php endforeach; ?>
    </section>
</main>

<footer>
    <?php include 'footer.php'; ?>
</footer>

</body>
</html>
