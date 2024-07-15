-- Create table for admin users
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    login_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create table for general users
CREATE TABLE IF NOT EXISTS sign_up (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    login_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
