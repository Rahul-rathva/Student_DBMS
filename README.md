# Student Database Management System

A beginner-friendly PHP & MySQL web app to manage student records and course enrollments. Built using XAMPP, Tailwind CSS, and phpMyAdmin.

## 🔧 Features
- Add/Edit/Delete students
- Enroll students in courses
- View all students and their enrollments
- Responsive design using Tailwind CSS
- Secure: PDO prepared statements & form validation

## 🖥️ Technologies Used
- PHP (Backend)
- MySQL (Database)
- Apache Server via XAMPP
- Tailwind CSS (Design)
- HTML

## 📂 Project Structure
```
student_db/
│
├── index.php       → View and manage students
├── enroll.php      → Enroll students in courses
├── config.php      → DB connection using PDO
├── student_db.sql  → SQL file to create tables and database
```

## 🚀 Setup Instructions

1. Install **XAMPP** from: https://www.apachefriends.org/
2. Start **Apache** and **MySQL** from XAMPP control panel
3. Open `http://localhost/phpmyadmin` in your browser
4. Import `student_db.sql` to create the database and tables
5. Copy all project files into `C:\xampp\htdocs\student_db\`
6. Visit: `http://localhost/student_db/index.php`

## 🌐 Live Version
This app is meant to run locally using XAMPP.  
GitHub Pages does not support PHP, so it can't be hosted directly here.

## 📦 Project Status
✅ Basic features complete  

## ✨ Author
Project by Rahul  

