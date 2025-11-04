<?php
require_once 'config/database.php';

// Fetch menu items from database
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
    <title>Menu - Warung Kopikir</title>
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
        
        .coffee-card {
            transition: all 0.3s ease;
        }
        
        .coffee-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-mug-hot text-2xl text-amber-800 mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">Warung Kopikir</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 hover:text-amber-800 font-medium">Home</a>
                    <a href="index.php#about" class="text-gray-700 hover:text-amber-800 font-medium">About</a>
                    <a href="menu.php" class="text-amber-800 font-medium">Menu</a>
                    <a href="index.php#products" class="text-gray-700 hover:text-amber-800 font-medium">Produk</a>
                    <a href="index.php#testimonials" class="text-gray-700 hover:text-amber-800 font-medium">Testimonials</a>
                    <a href="index.php#contact" class="text-gray-700 hover:text-amber-800 font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Menu Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Coffee Menu</h1>
                <div class="w-20 h-1 bg-amber-700 mx-auto"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Nikmati berbagai varian kopi spesial yang kami siapkan dengan bahan-bahan alami dan berkualitas tinggi</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($menuItems)): ?>
                    <?php foreach ($menuItems as $item): ?>
                        <div class="coffee-card bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-56 flex items-center justify-center">
                                <i class="fas fa-mug-hot text-5xl text-amber-700"></i>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-xl font-bold text-gray-800"><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <span class="text-amber-700 font-bold text-lg">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></span>
                                </div>
                                <p class="text-gray-600 mt-2"><?php echo htmlspecialchars($item['description']); ?></p>
                                <div class="mt-4">
                                    <button class="w-full bg-amber-700 hover:bg-amber-800 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                        Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-3 text-center py-10">
                        <p class="text-gray-600">No menu items available at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center">
                        <i class="fas fa-mug-hot text-2xl text-amber-500 mr-2"></i>
                        <span class="text-xl font-bold">Warung Kopikir</span>
                    </div>
                    <p class="mt-2 text-gray-400">Menyajikan kopi terbaik sejak 2015</p>
                </div>
                
                <div class="flex space-x-6">
                    <a href="index.php" class="text-gray-300 hover:text-white">Home</a>
                    <a href="index.php#about" class="text-gray-300 hover:text-white">About</a>
                    <a href="menu.php" class="text-gray-300 hover:text-white">Menu</a>
                    <a href="index.php#products" class="text-gray-300 hover:text-white">Produk</a>
                    <a href="index.php#testimonials" class="text-gray-300 hover:text-white">Testimonials</a>
                    <a href="index.php#contact" class="text-gray-300 hover:text-white">Contact</a>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 Warung Kopikir. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Custom JavaScript -->
    <script src="assets/js/main.js"></script>
</body>
</html>