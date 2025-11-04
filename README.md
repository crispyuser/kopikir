# Warung Kopi Kita - Coffee Shop Landing Page

A modern, responsive landing page for a coffee shop built with PHP 8, Tailwind CSS, and MySQL.

## Features

- Responsive design that works on all devices
- Dynamic content management through MySQL database
- Contact form with database integration
- Admin panel for managing menu items
- Smooth scrolling navigation
- Interactive elements with JavaScript

## Technologies Used

- **Frontend**: Tailwind CSS (via CDN), JavaScript
- **Backend**: PHP 8 Native
- **Database**: MySQL
- **Icons**: Font Awesome

## Project Structure

```
kopipas/
│
├── config/
│   └── database.php          # Database configuration
│
├── handlers/
│   └── contact_handler.php   # Contact form handler
│
├── database/
│   └── kopipas.sql           # Database schema
│
├── index.php                 # Main landing page
├── menu.php                  # Menu page
├── testimonials.php          # Testimonials page
└── admin.php                 # Admin panel
```

## Setup Instructions

1. **Database Setup**:
   - Create a MySQL database named `kopipas`
   - Import the schema from `database/kopipas.sql`

2. **Configuration**:
   - Update database credentials in `config/database.php` if needed

3. **Web Server**:
   - Place the project in your web server's document root
   - Ensure PHP 8+ is installed and configured
   - Access the site via your web browser

## Pages

- **Home** (`index.php`): Main landing page with all sections
- **Menu** (`menu.php`): Detailed view of coffee menu
- **Testimonials** (`testimonials.php`): Customer reviews
- **Admin** (`admin.php`): Backend for managing menu items

## Customization

To customize the content:
1. Update the database records for menu items and testimonials
2. Modify the HTML content in the PHP files
3. Adjust the Tailwind CSS classes for styling changes

## License

This project is open source and available under the MIT License.