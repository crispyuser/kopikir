<?php
// Simple contact page that demonstrates database connection
$message = '';

// Simulate form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = 'Thank you for your message! We will contact you soon.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Warung Kopikir</title>
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
                    <a href="menu.php" class="text-gray-700 hover:text-amber-800 font-medium">Menu</a>
                    <a href="index.php#products" class="text-gray-700 hover:text-amber-800 font-medium">Produk</a>
                    <a href="testimonials.php" class="text-gray-700 hover:text-amber-800 font-medium">Testimonials</a>
                    <a href="contact.php" class="text-amber-800 font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Get In Touch</h1>
                <div class="w-20 h-1 bg-amber-700 mx-auto"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
            
            <?php if ($message): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <div class="flex flex-col md:flex-row gap-10">
                <div class="md:w-1/2">
                    <form method="POST" class="bg-white p-8 rounded-lg shadow-md">
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-700 form-input" placeholder="Enter your name" required>
                        </div>
                        
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-700 form-input" placeholder="Enter your email" required>
                        </div>
                        
                        <div class="mb-6">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-700 form-input" placeholder="Enter subject" required>
                        </div>
                        
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-700 form-input" placeholder="Write your message here..." required></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-amber-700 hover:bg-amber-800 text-white font-bold py-3 px-4 rounded-lg transition duration-300 btn-hover">
                            Send Message
                        </button>
                    </form>
                </div>
                
                <div class="md:w-1/2">
                    <div class="bg-white p-8 rounded-lg shadow-md h-full">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Contact Information</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="text-amber-700 mr-4 mt-1">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Address</h4>
                                    <p class="text-gray-600">Jl. Raya Kopi No. 123, Jakarta Selatan, Indonesia</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-amber-700 mr-4 mt-1">
                                    <i class="fas fa-phone-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Phone</h4>
                                    <p class="text-gray-600">+62 21 1234 5678</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-amber-700 mr-4 mt-1">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Email</h4>
                                    <p class="text-gray-600">info@warungkopikita.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-amber-700 mr-4 mt-1">
                                    <i class="fas fa-clock text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Opening Hours</h4>
                                    <p class="text-gray-600">Monday - Sunday: 07:00 - 22:00 WIB</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-10">
                            <h4 class="font-bold text-gray-800 mb-4">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-amber-700 flex items-center justify-center text-white hover:bg-amber-800 transition duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-amber-700 flex items-center justify-center text-white hover:bg-amber-800 transition duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-amber-700 flex items-center justify-center text-white hover:bg-amber-800 transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-amber-700 flex items-center justify-center text-white hover:bg-amber-800 transition duration-300">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <a href="testimonials.php" class="text-gray-300 hover:text-white">Testimonials</a>
                    <a href="contact.php" class="text-gray-300 hover:text-white">Contact</a>
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