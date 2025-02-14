CREATE DATABASE plant_rental;

USE plant_rental;

drop database plant_rental;

drop table Plants;

CREATE TABLE Plants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(255),
    price DECIMAL(10, 2),
    rating DECIMAL(2, 1),
    image_name varchar(255),
    description TEXT
);

-- Step 4: Insert the Plant Data
INSERT INTO Plants (name, category, price, rating, image_name, description) VALUES
('Fiddle Leaf Fig', 'Indoor', 1200.00, 4.5, 'img1.webp', 'A popular indoor plant with large, violin-shaped leaves.'),
('Snake Plant', 'Indoor', 800.00, 4.8, 'snakeplant.jpeg', 'Low maintenance plant with upright, sword-like leaves.'),
('Pothos', 'Indoor', 550.00, 4.9, 'pothos.jpeg', 'A vining plant known for its hardiness and air-purifying properties.'),
('Areca Palm', 'Indoor', 1500.00, 4.6, 'ArecaPalm.jpeg', 'A graceful palm that thrives indoors, improving air quality.'),
('Aloe Vera', 'Succulent', 400.00, 4.7, 'AloeVera.webp', 'A succulent with medicinal properties, known for soothing burns.'),
('Peace Lily', 'Indoor', 1000.00, 4.8, 'PeaceLily.webp', 'A beautiful flowering plant that purifies the air effectively.'),
('Rubber Plant', 'Indoor', 1300.00, 4.5, 'RubberPlant.jpg', 'A hardy plant with thick, glossy leaves that grow well indoors.'),
('Bamboo Palm', 'Indoor', 1700.00, 4.9, 'BambooPalm.webp', 'A tropical plant that adds a lush feel to indoor spaces.'),
('ZZ Plant', 'Indoor', 1100.00, 4.7, 'snakeplant.jpeg', 'A low-light indoor plant with glossy, waxy leaves.'),
('Monstera Deliciosa', 'Indoor', 1800.00, 4.9, 'snakeplant.jpeg', 'A popular plant with large, split leaves, also known as the Swiss Cheese Plant.'),
('Jade Plant', 'Succulent', 600.00, 4.8, 'snakeplant.jpeg', 'A classic succulent with thick, oval leaves, symbolizing prosperity.'),
('Cactus', 'Succulent', 500.00, 4.6, 'snakeplant.jpeg', 'A hardy succulent that requires minimal care and thrives in sunlight.'),
('Croton', 'Indoor', 900.00, 4.7, 'snakeplant.jpeg', 'A colorful foliage plant with vibrant red, yellow, and green leaves.'),
('Spider Plant', 'Indoor', 700.00, 4.8, 'snakeplant.jpeg', 'An easy-care plant with arching leaves and baby spiderettes.'),
('Money Plant', 'Vining', 750.00, 4.9, 'snakeplant.jpeg', 'A symbol of good luck and prosperity, with heart-shaped leaves.');

select * from Plants;

drop table Plants; 

CREATE TABLE Nurseries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  location VARCHAR(255) NOT NULL,
  contact VARCHAR(20),
  image_name VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Nurseries (name, description, location, contact, image_name)
VALUES
  ('Green Leaf Nursery', 'Located in the heart of the city, Green Leaf offers a wide range of indoor and outdoor plants for rental. Their plants are well-maintained and perfect for any space.', 'Pune, Maharashtra', '020-12345678', 'nursery.avif'),
  ('Plant Haven', 'Specializes in exotic and rare plants that are available for short-term or long-term rental. They offer delivery services across Pune.', 'Pune, Maharashtra', '020-23456789', 'nursery2.jpeg'),
  ('Nature’s Palette', 'Nature’s Palette offers eco-friendly and vibrant plants suitable for homes and offices. They also offer plant care services.', 'Koregaon Park, Pune', '020-34567890', 'nursery.avif'),
  ('Flora Roots', 'With a passion for nature, Flora Roots provides a wide variety of plants for rent, including succulents, cacti, and flowering plants.', 'Pimple Saudagar, Pune', '020-90123456', 'nursery.avif'),
  ('The Greenhouse', 'The Greenhouse specializes in renting rare and exotic plants, including tropical species and bonsais, perfect for any decor.', 'Viman Nagar, Pune', '020-12340987', 'nursery.avif');

select * from Nurseries;

drop table Nurseries;

drop table about_us;

CREATE TABLE about_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    mission TEXT NOT NULL,
    vision TEXT NOT NULL,
    history TEXT NOT NULL,
    value TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO about_us (title, description, mission, vision, history, value) VALUES 
(
    'About Plant Rental',
    'Welcome to Plant Rental, your one-stop solution for renting plants to bring greenery into your home, office, or event space. We provide a wide selection of plants to enhance your surroundings, making them fresher and more inviting.',
    'Our mission is to make plant rental easy, affordable, and accessible for everyone. We aim to promote green living by offering flexible plant rental services that suit different needs—whether it’s a home, workspace, or event decoration.',
    'We envision a world where every home and workplace enjoys the benefits of greenery, improving air quality and mental well-being. Our goal is to revolutionize plant accessibility and encourage eco-friendly habits globally.',
    'Founded in 2024, Plant Rental started as a small initiative to help urban dwellers bring more greenery into their spaces. Over the years, we have grown into a trusted service provider, partnering with top nurseries and plant suppliers to bring the best selection to our customers.',
    'At Plant Rental, we uphold values of sustainability, quality, affordability, and customer satisfaction. We believe in making greenery a part of everyone’s lifestyle while ensuring ethical sourcing and eco-friendly practices.'
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
    order_date DATE NOT NULL,
    expected_delivery DATE NOT NULL,
    plant_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL
);
