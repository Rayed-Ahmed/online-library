CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('student', 'teacher', 'admin') NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1, -- For the admin to manage user accounts 
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE `books` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `author` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `is_available` TINYINT(1) NOT NULL DEFAULT 1 -- Used for browsing and issuing books 
);



CREATE TABLE `borrowing_records` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `book_id` INT NOT NULL,
  `borrow_date` DATE NOT NULL,
  `return_date` DATE,
  `status` ENUM('pending', 'approved', 'returned', 'declined') NOT NULL, -- For admin approval workflow 
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`book_id`) REFERENCES `books`(`id`) ON DELETE CASCADE
);



CREATE TABLE `recommendations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `teacher_id` INT NOT NULL,
  `book_title` VARCHAR(255) NOT NULL,
  `reason` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`teacher_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);



CREATE TABLE `reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `teacher_id` INT NOT NULL,
  `book_id` INT NOT NULL,
  `review_text` TEXT NOT NULL,
  `rating` INT NOT NULL, 
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`teacher_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`book_id`) REFERENCES `books`(`id`) ON DELETE CASCADE
);


-- Email: admin@library.com
-- Password: admin123


INSERT INTO `users` (`full_name`, `email`, `password`, `role`, `is_active`) VALUES
('Admin User', 'admin@library.com', '$2y$10$p.3O2e06Vo23S23yEjsmxuaJ5sOzK7NFIGD4om82cTnoW.L252p2C', 'admin', 1);

