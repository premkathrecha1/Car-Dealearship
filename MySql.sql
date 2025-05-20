
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
);
INSERT INTO users (username, password) VALUES ('admin', MD5('admin123'));
CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner_name VARCHAR(100),
    car_model VARCHAR(100),
    car_brand VARCHAR(100),
    year INT,
    price DECIMAL(10,2),
    description TEXT,
    contact VARCHAR(20),
    image VARCHAR(255)
);
INSERT INTO cars (owner_name, car_model, car_brand, year, price, description, contact, image) 
VALUES 
('Ravi Kumar', 'City', 'Honda', 2018, 550000, 'Good condition, single owner', '9876543210', 'car1.jpg'),
('Aman Sharma', 'i20', 'Hyundai', 2020, 600000, 'New tyres, top model', '9812345678', 'car2.jpg');
