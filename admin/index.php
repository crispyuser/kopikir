<?php
session_start();

// Check if user is logged in (simple authentication)
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

// Handle delete message
$message = '';
$messageType = '';

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $messageType = isset($_GET['type']) ? $_GET['type'] : 'info';
}

// Fetch all menu items
$conn = getConnection();
$result = $conn->query("SELECT * FROM menu ORDER BY id ASC");
$menuItems = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Warung Kopikir</title>
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
        
        /* Delete animation */
        .delete-animation {
            animation: slideOut 0.5s ease-out forwards;
        }
        
        @keyframes slideOut {
            0% {
                opacity: 1;
                transform: translateX(0);
            }
            50% {
                opacity: 0.7;
                transform: translateX(-20px);
            }
            100% {
                opacity: 0;
                transform: translateX(100%);
            }
        }
        
        /* Modal styles */
        .modal {
            transition: opacity 0.3s ease;
        }
        
        .modal-content {
            transition: transform 0.3s ease;
            transform: scale(0.95);
        }
        
        .modal-active .modal-content {
            transform: scale(1);
        }
        
        /* Button hover effects */
        .btn-hover {
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Smooth fade in for elements */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                    <a href="index.php" class="text-amber-400 font-medium">Dashboard</a>
                    <a href="add_menu.php" class="text-gray-300 hover:text-white font-medium">Add Menu</a>
                    <a href="logout.php" class="text-gray-300 hover:text-white font-medium">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
            <p class="text-gray-600">Manage your coffee menu items</p>
        </div>

        <?php if ($message): ?>
            <div class="mb-8 p-4 rounded-lg <?php echo $messageType === 'success' ? 'bg-green-100 text-green-700' : ($messageType === 'error' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700'); ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Current Menu Items -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Current Menu Items</h2>
                <a href="add_menu.php" class="bg-amber-700 hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-lg transition duration-300 btn-hover">
                    <i class="fas fa-plus mr-2"></i> Add New Item
                </a>
            </div>
            
            <?php if (!empty($menuItems)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="menuTable">
                            <?php foreach ($menuItems as $item): ?>
                                <tr id="menu-item-<?php echo $item['id']; ?>" class="fade-in">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($item['id']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($item['name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars(substr($item['description'], 0, 50)) . (strlen($item['description']) > 50 ? '...' : ''); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="edit_menu.php?id=<?php echo $item['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-3 btn-hover">
                                            Edit
                                        </a>
                                        <button onclick="openDeleteModal(<?php echo $item['id']; ?>, '<?php echo htmlspecialchars($item['name']); ?>')" class="text-red-600 hover:text-red-900 btn-hover">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-10">
                    <p class="text-gray-600">No menu items found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden modal">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 modal-content">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Confirm Delete</h3>
                    <button onclick="closeDeleteModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mb-6">
                    <p class="text-gray-700">Are you sure you want to delete <span id="itemName" class="font-bold"></span>? This action cannot be undone.</p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-300">
                        Cancel
                    </button>
                    <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-300 btn-hover">
                        Delete
                    </button>
                </div>
            </div>
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

    <!-- Custom JavaScript for delete functionality -->
    <script>
        let deleteItemId = null;
        
        function openDeleteModal(id, name) {
            deleteItemId = id;
            document.getElementById('itemName').textContent = name;
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('modal-active');
            
            // Set the delete action
            document.getElementById('confirmDeleteBtn').onclick = function() {
                deleteMenuItem(id);
            };
        }
        
        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('modal-active');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
        
        function deleteMenuItem(id) {
            // Add animation class to the row
            const row = document.getElementById('menu-item-' + id);
            if (row) {
                row.classList.add('delete-animation');
                
                // After animation completes, redirect to delete
                setTimeout(() => {
                    window.location.href = 'delete_menu.php?id=' + id;
                }, 500);
            } else {
                // Fallback if row not found
                window.location.href = 'delete_menu.php?id=' + id;
            }
            
            closeDeleteModal();
        }
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>