# CRUD User App (PHP)

## Overview
This is a simple CRUD (Create, Read, Update, Delete) application for user management built using PHP. The project follows an MVC (Model-View-Controller) structure and uses Composer for dependency management.

## Features
- Add new users
- Edit existing users
- Delete users
- View a list of users
- Store user data in a MySQL database

## Project Structure
```
d:/Admin/Documents/Study/PHP/crud-user-app/
├── .gitignore
├── .htaccess
├── app/
│   ├── configs/
│   │   ├── database.php       # Database configuration
│   │   └── database.sql       # SQL schema for the users table
│   ├── controllers/
│   │   └── UserController.php # Handles user-related operations
│   ├── models/
│   │   └── User.php           # User model
│   ├── providers/
│   │   └── UserProvider.php   # Handles database queries for users
│   ├── routes/
│   │   └── index.php          # Defines application routes
│   └── views/
│       ├── addUser.php        # Form to add a new user
│       ├── editUser.php       # Form to edit an existing user
│       └── index.php          # Displays the list of users
├── composer.json              # Composer dependencies
├── index.php                  # Entry point of the application
├── public/
│   ├── css/
│   │   └── styles.css         # Stylesheet
│   └── js/                    # JavaScript files (if needed)
├── uploads/                   # Stores uploaded user images (ignored in .gitignore)
└── vendor/                     # Composer dependencies
```

## Installation
### Prerequisites
- PHP 7.4 or higher
- MySQL Database
- Composer (Dependency Manager)
- Apache or any PHP-compatible server

### Steps to Run the Project
1. **Clone the repository:**
   ```sh
   git clone https://github.com/your-repository/crud-user-app.git
   cd crud-user-app
   ```

2. **Install dependencies:**
   ```sh
   composer install
   ```

3. **Configure the database:**
   - Create a MySQL database.
   - Import the `database.sql` file located in `app/configs/`.
   - Update `app/configs/database.php` with your database credentials.

4. **Run the project:**
   ```sh
   php -S localhost:8000
   ```
   Open `http://localhost:8000` in your browser.

## Usage
- Navigate to the home page to see the list of users.
- Click "Add User" to create a new user.
- Use "Edit" and "Delete" buttons to update or remove users.

## License
This project is open-source and available under the MIT License.

