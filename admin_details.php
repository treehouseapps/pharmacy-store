<?php 
session_start();
if(($_SESSION["role"] != "SAdmin")){
    header("Location: login.php");
    exit();
}
// connection 
$conn = new mysqli('localhost', 'root', '', 'medicine');

if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    if(isset($_GET['member_id'])){
        $id = mysqli_real_escape_string($conn, $_GET['member_id']);

        // Select the table
        $report = "SELECT * FROM admin_store WHERE member_id = $id";
        // Get results
        $bind = mysqli_query($conn, $report);
        // Fetch the results
        $result = mysqli_fetch_assoc($bind);
        // Free the results
        mysqli_free_result($bind);
        // Close connection
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
    <title>Admin Detail</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<?php include 'navbar.php'; ?>

<main class="container mx-auto px-4 py-10 flex-grow">
    <h1 class="text-3xl font-extrabold text-center text-amber-800 mb-12">Admin Profile Detail</h1>

    <?php if($result): ?>
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 flex flex-col md:flex-row items-center gap-10">
        <img
            src="./image/img/<?php echo htmlspecialchars($result['img']); ?>"
            alt="Admin Image"
            class="w-64 h-64 object-cover rounded-full border-4 border-amber-400 shadow-md"
            width="250"
            height="250"
            loading="lazy"
        />
        <div class="flex flex-col space-y-4 flex-grow">
            <div class="space-y-1 text-gray-700">
                <h3 class="text-lg font-semibold">ID: <span class="font-normal"><?php echo htmlspecialchars($result['member_id']); ?></span></h3>
                <h3 class="text-lg font-semibold">First Name: <span class="font-normal"><?php echo htmlspecialchars($result['member_fname']); ?></span></h3>
                <h3 class="text-lg font-semibold">Last Name: <span class="font-normal"><?php echo htmlspecialchars($result['member_sname']); ?></span></h3>
                <h3 class="text-lg font-semibold">Gender: <span class="font-normal"><?php echo htmlspecialchars($result['gender']); ?></span></h3>
                <h3 class="text-lg font-semibold">Address: <span class="font-normal"><?php echo htmlspecialchars($result['address']); ?></span></h3>
                <h3 class="text-lg font-semibold">Phone Number: <span class="font-normal"><?php echo htmlspecialchars($result['phone_no']); ?></span></h3>
            </div>

            <div class="flex space-x-4 mt-6">
                <a href="add_admin_update.php?member_id=<?php echo $result['member_id']?>">
                    <button
                        type="button"
                        class="bg-amber-700 hover:bg-amber-600 text-white font-semibold px-6 py-2 rounded shadow focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-opacity-75"
                    >
                        Edit
                    </button>
                </a>

                <form action="admin_store.php?member_id=<?php echo $result['member_id']?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                    <button
                        type="submit"
                        name="delete"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded shadow focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75"
                    >
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php else: ?>
        <p class="text-center text-red-600 font-semibold">Admin not found.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
