<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

$message = '';
$messageType = '';
$menuItem = null;

// Get menu item ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Fetch menu item from database
$conn = getConnection();
$stmt = $conn->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: index.php');
    exit;
}

$menuItem = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
    
    // Validate input
    if (empty($name) || empty($description) || $price <= 0) {
        $message = 'All fields are required and price must be greater than 0';
        $messageType = 'error';
    } else {
        // Update database
        $stmt = $conn->prepare("UPDATE menu SET name = ?, description = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $name, $description, $price, $id);
        
        if ($stmt->execute()) {
            $message = 'Menu item updated successfully!';
            $messageType = 'success';
            // Refresh menu item data
            $stmt->close();
            $stmt = $conn->prepare("SELECT * FROM menu WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $menuItem = $result->fetch_assoc();
        } else {
            $message = 'Error updating menu item: ' . $conn->error;
            $messageType = 'error';
        }
        
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item - Warung Kopikir</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-gray-800 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-mug-hot text-2xl text-amber-500 mr-2"></i>
                        <span class="text-xl font-bold">Warung Kopikir Admin</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-300 hover:text-white font-medium">Dashboard</a>
                    <a href="add_menu.php" class="text-gray-300 hover:text-white font-medium">Add Menu</a>
                    <a href="logout.php" class="text-gray-300 hover:text-white font-medium">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Edit Menu Item</h1>
            <p class="text-gray-600">Update your coffee menu item</p>
        </div>

        <?php if ($message): ?>
            <div class="mb-8 p-4 rounded-lg <?php echo $messageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Edit Menu Item Form -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
            <form method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($menuItem['name']) ? htmlspecialchars($menuItem['name']) : ''; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-700" required>
                </div>
                
                <div>
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-700" required><?php echo isset($menuItem['description']) ? htmlspecialchars($menuItem['description']) : ''; ?></textarea>
                </div>
                
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price (Rp)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo isset($menuItem['price']) ? htmlspecialchars($menuItem['price']) : ''; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-700" required>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="bg-amber-700 hover:bg-amber-800 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        Update Menu Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-10 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2023 Warung Kopikir Admin Panel. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>