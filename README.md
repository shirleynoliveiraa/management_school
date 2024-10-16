# School Management System

This project is a simple school management system where users can register students and manage classes.

## Requirements

To run this project, you will need the following software installed on your machine:

- **PHP** (version 7.4 or higher): To run the server code.
- **MySQL** or **MariaDB**: To manage the database.
- **Composer** (optional): To manage test dependencies.
- **Web Server** (such as Apache or Nginx): To serve the application.

## Step-by-Step Setup

### 1. Clone the Repository

First, you need to clone the project repository to your machine. Open your terminal or command prompt and run:

```
git clone https://github.com/shirleynoliveiraa/management_school.git

cd management_school
```

### 2. Create the Database
- Open your MySQL client: You can use the terminal, MySQL Workbench, or phpMyAdmin.
- Make sure your credentials are correct on the config/database.php file

```
$host = '127.0.0.1:3307'; // MySQL server address (check if it's correct, MySQL usually runs on port 3306)
$dbname = 'school_management'; // Database name
$username = 'root'; // MySQL user
$password = ''; // MySQL password
```

- Execute the script contained in the dump.sql file. This script will create the database and the necessary tables.
- The dump.sql file also contains some initial data for the tables students and classes, it is optional to execute these parts of the script.


### 3. Insert a User
- After creating the database and tables, you need to insert an administrator user.
- To do this, in your terminal run the insert_user.php script:

```
php insert_user.php
```

- This script will insert a user with the username admin@admin.com and the password admin into the database.

### 4. Configure Database Connection
- Make sure the database connection credentials in your insert_user.php file are correct. Open the insert_user.php file and update the variables as necessary:
```
$host = '127.0.0.1:3307'; // MySQL server address (check if it's correct, MySQL usually runs on port 3306)
$dbname = 'school_management'; // Database name
$username = 'root'; // MySQL user
$password = ''; // MySQL password
```

### 5. Run the Web Server
- If you are using the built-in PHP server, you can start a local server with the following command:
```
php -S localhost:8000
```
- If you are using a web server like Apache or Nginx, make sure it is configured to point to your project directory.


### 6. Access the Application
- Now you can access the application in your browser. Enter the following URL:

```
http://localhost:8000/public/index.php
```
- You should see the login interface of the system. Use the credentials of the administrator user you inserted earlier to log in.

### 7. Tests
- To run the tests, you can run in the terminal:
```
./vendor/bin/phpunit tests/
```

### 8. Features
- **Student Management**: Create, edit, and delete students. List all registered students.
- **Class Management**: Create, edit, and delete classes offered by the institution. List all registered classes.
- **User Registration**: Register users with encrypted passwords for authentication. New users can be registered using the `insert_user.php` script.
- **Enrollments**: Enroll students in classes and list all completed enrollments.
- **User Authentication**: Login and logout functionality for users.