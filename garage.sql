-- Active: 1689342976980@@127.0.0.1@3306@garage
CREATE TABLE persons (
  id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  email VARCHAR(100) NOT NULL
);
CREATE TABLE users (
  password CHAR(60) NOT NULL,
  person_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY, -- Inheritance with the table persons
  FOREIGN KEY (person_id) REFERENCES persons(id)
);
CREATE TABLE administrator (
  opening_hours VARCHAR(96) NOT NULL,
  user_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY, -- Inheritance with the table users
  FOREIGN KEY (user_id) REFERENCES users(person_id)
);
CREATE TABLE visitors (
  phone VARCHAR(13) NOT NULL,
  person_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY, -- Inheritance with the table persons
  FOREIGN KEY (person_id) REFERENCES persons(id)
);
CREATE TABLE vehicles (
  ad_number SMALLINT UNSIGNED NOT NULL PRIMARY KEY,
  make VARCHAR(30) NOT NULL,
  model VARCHAR(60) NOT NULL,
  body_type ENUM('citadine', 'compacte', 'coupé', 'berline', 'break', 'SUV') NOT NULL,
  fuel_type ENUM('essence', 'diesel', 'éthanol', 'lpg', 'hybride', 'électrique') NOT NULL,
  engine_capacity DECIMAL(2,1) UNSIGNED NULL,
  price SMALLINT UNSIGNED NOT NULL,
  power SMALLINT UNSIGNED NOT NULL,
  mileage MEDIUMINT UNSIGNED NOT NULL,
  first_registration DATE NOT NULL,
  warranty TINYINT UNSIGNED NOT NULL
);
CREATE TABLE manage_vehicles (
  user_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(person_id),
  vehicle_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(ad_number),
  PRIMARY KEY (user_id, vehicle_id) -- Association between the tables users and vehicles
);
CREATE TABLE messages (
  id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  ask_info TEXT(500) NULL,
  vehicle_id SMALLINT UNSIGNED NULL, -- Foreign key can be NULL
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(ad_number),
  visitor_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (visitor_id) REFERENCES visitors(person_id) ON DELETE CASCADE,
  PRIMARY KEY (id, visitor_id) -- Composition with the table visitors
);
CREATE TABLE images (
  id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  image_file_name VARCHAR(30) NOT NULL,
  vehicle_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(ad_number) ON DELETE CASCADE,
  PRIMARY KEY (id, vehicle_id) -- Composition with the table vehicles
);
CREATE TABLE equipments (
  id TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  specification VARCHAR(60) NOT NULL
);
CREATE TABLE options (
  vehicle_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(ad_number),
  equipment_id TINYINT UNSIGNED NOT NULL,
  FOREIGN KEY (equipment_id) REFERENCES equipments(id),
  PRIMARY KEY (vehicle_id, equipment_id) -- Association between the tables vehicles and equipments
);
CREATE TABLE services (
  id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  image_file_name VARCHAR(30),
  service_type VARCHAR(30),
  administrator_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (administrator_id) REFERENCES administrator(user_id),
  PRIMARY KEY (id, administrator_id) -- Composition with the table administrator
);
CREATE TABLE testimonials (
  id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  comment TEXT(500) NOT NULL,
  note TINYINT NOT NULL CHECK(note BETWEEN 1 and 5),
  user_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(person_id),
  person_id SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (person_id) REFERENCES persons(id) ON DELETE CASCADE,
  PRIMARY KEY (id, person_id) -- Composition with the table person
);
INSERT INTO persons (first_name, last_name, email) VALUES
  ('Vincent', 'Parrot', 'vincent.parrot@example.com'),
  ('Jean', 'Dupont', 'jean.dupont@example.com'),
  ('Lisa', 'Desmarais', 'lisa.desmarais@example.com'),
  ('Marie', 'Desart', 'marie.desart@example.com'),
  ('John', 'Smith', 'john.smith@example.com');
INSERT INTO users (password, person_id) VALUES
  ('AdminVP_1', 1),
  ('UserLD_21', 3),
  ('UserJS_22', 5);
INSERT INTO administrator (opening_hours, user_id) VALUES
  ('070012001400190007001200140019000700120014001900070012001400190007001200140019000700120014001900', 1);
INSERT INTO vehicles (ad_number, make, model, body_type, fuel_type, engine_capacity, price, power,
  mileage, first_registration, warranty) VALUES
  (8031, 'Audi', 'A3 Sportback TDI sport', 'berline', 'essence', 1.6, 19990, 116, 67700, '2018-10-08', 24),
  (8099, 'Audi', 'A4 Avant TDI sport', 'break', 'diesel', 2.0, 21990, 150, 94850, '2017-03-15', 24),
  (3174, 'Audi', 'A6 Avant TDI S-Tronic Quattro', 'break', 'diesel', 2.0, 29990, 190, 50100, '2018-11-28', 24),
  (8351, 'BMW', '430 Gran Coupé X-Drive Serie 4' ,'berline', 'essence', NULL, 29990, 252, 75400, '2017-06-29', 24),
  (5468, 'DS', '7 Crossback blueHDI Rivoli', 'SUV', 'diesel', NULL, 24990, 130, 90100, '2018-11-29', 24),
  (4695, 'Ford', 'Puma T Ecoboost ST-Line', 'SUV', 'essence', 1.0, 19990, 125, 95250, '2020-10-20', 24),
  (9106, 'Mini', 'Cooper SE 135kW BVA', 'coupé', 'électrique', NULL, 25990, 184, 10100, '2020-08-14', 24),
  (2116, 'Mini', 'Countryman Cooper', 'berline', 'diesel', 2.0, 23990, 150, 37300, '2017-05-26', 24),
  (9206, 'Seat', 'Leon TDI ST', 'break', 'diesel', 2.0, 22990, 184, 58850, '2018-07-26', 24),
  (8529, 'Tesla', 'Model S 386kW BVA', 'berline', 'électrique', NULL, 42990, 517, 98300, '2018-12-26', 24),
  (1316, 'Volkswagen', 'Golf TSI GTE DSG', 'compacte', 'hybride', 1.4, 24990, 150, 22400, '2017-08-03', 24);
INSERT INTO images (id, image_file_name, vehicle_id) VALUES
  (1, 'volkswagen_1316_1.png', 1316), (2, 'volkswagen_1316_2.png', 1316), (3, 'volkswagen_1316_3.png', 1316),
  (4, 'volkswagen_1316_4.png', 1316), (5, 'volkswagen_1316_5.png', 1316),
  (6, 'mini_2116_1.png', 2116), (7, 'mini_2116_2.png', 2116), (8, 'mini_2116_3.png', 2116),
  (9, 'mini_2116_4.png', 2116), (10, 'mini_2116_5.png', 2116),
  (11, 'audi_3174_1.png', 3174), (12, 'audi_3174_2.png', 3174), (13, 'audi_3174_3.png', 3174),
  (14, 'audi_3174_4.png', 3174), (15, 'audi_3174_5.png', 3174),
  (16, 'ford_4695_1.png', 4695), (17, 'ford_4695_2.png', 4695), (18, 'ford_4695_3.png', 4695),
  (19, 'ford_4695_4.png', 4695), (20, 'ford_4695_5.png', 4695),
  (21, 'ds_5468_1.png', 5468), (22, 'ds_5468_2.png', 5468), (23, 'ds_5468_3.png', 5468),
  (24, 'ds_5468_4.png', 5468), (25, 'ds_5468_5.png', 5468),
  (26, 'audi_8031_1.png', 8031), (27, 'audi_8031_2.png', 8031), (28, 'audi_8031_3.png', 8031),
  (29, 'audi_8031_4.png', 8031), (30, 'audi_8031_5.png', 8031),
  (31, 'audi_8099_1.png', 8099), (32, 'audi_8099_2.png', 8099), (33, 'audi_8099_3.png', 8099),
  (34, 'audi_8099_4.png', 8099), (35, 'audi_8099_5.png', 8099),
  (36, 'bmw_8351_1.png', 8351), (37, 'bmw_8351_2.png', 8351), (38, 'bmw_8351_3.png', 8351),
  (39, 'bmw_8351_4.png', 8351), (40, 'bmw_8351_5.png', 8351),
  (41, 'tesla_8529_1.png', 8529), (42, 'tesla_8529_2.png', 8529), (43, 'tesla_8529_3.png', 8529),
  (44, 'tesla_8529_4.png', 8529), (45, 'tesla_8529_5.png', 8529),
  (46, 'mini_9106_1.png', 9106), (47, 'mini_9106_2.png', 9106), (48, 'mini_9106_3.png', 9106),
  (49, 'mini_9106_4.png', 9106), (50, 'mini_9106_5.png', 9106),
  (51, 'seat_9206_1.png', 9206), (52, 'seat_9206_2.png', 9206), (53, 'seat_9206_3.png', 9206),
  (54, 'seat_9206_4.png', 9206), (55, 'seat_9206_5.png', 9206);
INSERT INTO equipments (specification) VALUES
  ('Airbags'),
  ('Alarme'),
  ('Anti brouillard'),
  ('Caméra de recul'),
  ('Feux automatiques'),
  ('Intérieur cuir sport'),
  ('Ordinateur de bord'),
  ('Régulateur de vitesse'),
  ('Rétroviseurs électriques'),
  ('Sièges chauffants'),
  ('Toit ouvrant'),
  ('Vitres électriques (4)');
INSERT INTO options (vehicle_id, equipment_id) VALUES
  (8031, 1), (8031, 2), (8031, 4), (8031, 5), (8031, 7), (8031, 8), (8031, 9), (8031, 12),
  (8099, 1), (8099, 2), (8099, 4), (8099, 5), (8099, 7), (8099, 8), (8099, 9), (8099, 10), (8099, 12),
  (3174, 1), (3174, 2), (3174, 3), (3174, 4), (3174, 5), (3174, 7), (3174, 8), (3174, 9), (3174, 10), (3174, 12),
  (8351, 1), (8351, 2), (8351, 3), (8351, 4), (8351, 5), (8351, 6), (8351, 7), (8351, 8), (8351, 9), (8351, 10), (8351, 12),
  (5468, 1), (5468, 2), (5468, 3), (5468, 5), (5468, 7), (5468, 8), (5468, 9), (5468, 11), (5468, 12),
  (4695, 1), (4695, 2), (4695, 3), (4695, 4), (4695, 5), (4695, 7), (4695, 8), (4695, 9), (4695, 12),
  (9106, 1), (9106, 2), (9106, 3), (9106, 4), (9106, 5), (9106, 7), (9106, 8), (9106, 9), (9106, 12),
  (2116, 1), (2116, 2), (2116, 3), (2116, 7), (2116, 8), (2116, 9), (2116, 11), (2116, 12),
  (9206, 1), (9206, 2), (9206, 3), (9206, 5), (9206, 7), (9206, 8), (9206, 9), (9206, 11), (9206, 12),
  (8529, 1), (8529, 2), (8529, 3), (8529, 4), (8529, 5), (8529, 6), (8529, 7), (8529, 8), (8529, 9), (8529, 10), (8529, 12),
  (1316, 1), (1316, 2), (1316, 5), (1316, 7), (1316, 8), (1316, 9), (1316, 10), (1316, 12);
INSERT INTO services (id, image_file_name, service_type, administrator_id) VALUES
  (1, 'battery.png', 'Batterie', 1),
  (2, 'air_conditionning.png', 'Climatisation', 1),
  (3, 'check.png', 'Contrôle', 1),
  (4, 'exhaust.png', 'Echappement', 1),
  (5, 'lighting.png', 'Eclairage', 1),
  (6, 'braking.png', 'Freinage', 1),
  (7, 'motor.png', 'Moteur', 1),
  (8, 'repair.png', 'Réparation', 1),
  (9, 'suspension.png', 'Suspension', 1),
  (10, 'oil_change.png', 'Vidange', 1);