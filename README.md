# 📚 Online Library Management System

An **Online Library Management System** built using **HTML, CSS, PHP, and MySQL**.  
This project enables students, teachers, and admins to manage and interact with a digital library platform efficiently.

---

## 🚀 Overview

This system supports three types of users:

1. **Student**
2. **Teacher**
3. **Admin**

Each user has specific permissions and dashboards while sharing core features such as authentication, account management, and profile updates.

---

## 👥 User Types and Features

### 🧑‍🎓 Student
- Browse available books  
- Borrow books online  
- View borrowing history  

### 👩‍🏫 Teacher
- Recommend books for students  
- View borrowed book list of students  
- Post book reviews  

### 🧑‍💼 Admin
- Add, edit, or delete books from the catalog  
- Approve or decline borrowing requests  
- Manage user accounts (activate/deactivate users)  

---

## 🔐 Common Features (Available to All Users)

### 🔑 Authentication
- User registration  
- Login and logout  
- Password change or reset  



### 📊 Dashboard
- Personalized dashboard for each user after login  

---

## 🧩 Technologies Used

- **Frontend:** HTML, CSS  
- **Backend:** PHP  
- **Database:** MySQL  
- **Server:** XAMPP (Apache + MySQL)

---

## ⚙️ Installation & Setup

Follow these steps to run the project locally:

1. **Install XAMPP**
   - Download and install [XAMPP](https://www.apachefriends.org/download.html).
   - Start **Apache** and **MySQL** services.

2. **Move Project Files**
   - Copy the entire project folder (`online-library`) into:
     ```
     C:\xampp\htdocs\
     ```

3. **Create the Database**
   - Open **phpMyAdmin** in your browser:
     ```
     http://localhost/phpmyadmin
     ```
   - Create a new database named:
     ```
     library_system_db
     ```

4. **Import the Database Schema**
   - Click on your new database.
   - Select the **Import** tab.
   - Upload and import the provided `scheama.sql` file (database schema).


5. **Run the Application**
   - Open your browser and visit:
     ```
     http://localhost/online-library
     ```





