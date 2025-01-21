# Library Management System task for SubconIT

A book management system built with Symfony 6.4, featuring a clean UI design inspired by SubconIT's style.

## Features

- Book management (CRUD operations)
- User authentication system
- Image upload functionality for book covers
- Real-time image preview when uploading
- Search and filter functionality
- Responsive grid layout
- Hover effects for book descriptions

## Technical Requirements

- PHP 8.1 or higher
- Composer
- MySQL
- Symfony CLI
- Node.js and npm

## Installation

1. Clone the repository:
git clone https://github.com/BevardisEsu/SubconIT-task.git

2. Install PHP dependencies:
composer install

3. Install JavaScript dependencies:
npm install

4. Configure your database in .env.local:
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0.32&charset=utf8mb4"

5. Create database and run migrations:
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

6. Load fixture data
php bin/console doctrine:fixtures:load

7. Build assets:
npm run build

8. Start the Symfony server:
symfony server:start

Usage

Create an account using the registration form
Log in to access the book management system
Add new books with cover images
View all books in a responsive grid layout
Hover over books to see descriptions
Edit or delete existing books
Use the search functionality to find specific books

File Structure

/src/Controller/ - Contains all controllers
/src/Entity/ - Database entities
/src/Form/ - Form types
/templates/ - Twig templates
/public/uploads/covers/ - Book cover images
/assets/ - CSS and JavaScript files

Contributing
This project was developed as part of a task for SubconIT.
Credits
Developed by [Your Name] for SubconIT task.
License
This project is private and intended for SubconIT evaluation purposes.