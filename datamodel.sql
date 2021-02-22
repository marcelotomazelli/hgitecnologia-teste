CREATE DATABASE management;

USE management;

CREATE TABLE users (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  birthdate DATE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY(id),
  UNIQUE INDEX UNIQUE_EMAIL(email)
);

INSERT INTO users(first_name, last_name, birthdate, email, password, created_at) VALUES
('Jayden', 'Quesado ', '1989-02-02', 'jayden_quesado@email.com', '$2y$10$Sp60EZmkpJKJ1IJTUxI6zu06mshX2wOHHZqYOYGDq54p8Tqw.9Q0q', '2017-10-16 14:56:42'),
('Santhiago', 'Graça', '1972-08-21', 'santhiago_graca@email.com', '$2y$10$gm8wfWfE.6Unx0PMLzeBDuLn4mmmYEaQEp2ErOQdav9spA0T1t/pS', '2020-07-12 14:56:42'),
('Élia', 'Valverde', '1997-02-28', 'elia_valverde@email.com', '$2y$10$hGliLwyIeimQkdXOVq/zj.7.5ZxpvvjqKD3m1tShHuT.AXfAgszZK', '2017-11-14 14:56:42'),
('Erica', 'Quirino', '1986-12-24', 'erica_quirino@email.com', '$2y$10$1u.R1ea/.P8WaWFj1kj2Su356M6Wf4xmL/cr2dHhQZ.FwVJ2RsMEa', '2020-06-24 14:56:42'),
('Adrien', 'Jamandas', '2001-08-17', 'adrien_jamandas@email.com', '$2y$10$HmPPlF1DogqRHIuDi9HPWOu7s9K3RlHTf5O9Y9m04ryexPKgWZXa2', '2018-12-17 14:56:42'),
('Santhiago', 'Grilo', '1973-04-22', 'santhiago_grilo@email.com', '$2y$10$Va.uDC28I2RlZ8BNQPPPyuFT7Rzxb6BMiXFupUQl.DNm.ofLvcO5G', '2018-02-10 14:56:42'),
('Derick', 'Lacerda', '1980-12-02', 'derick_lacerda@email.com', '$2y$10$Vorb7N6KHJMi5sFAOj0LOOa6GifDTY3yyD7njhO/vJED6l3HJw3ve', '2020-02-18 14:56:42'),
('Santhiago', 'Zarco', '1994-11-26', 'santhiago_zarco@email.com', '$2y$10$jahFStwwlmI7VY3Sn9/k0..MHemAlipKR.UvUp/qyfr3oHiT34vU6', '2018-04-09 14:56:43'),
('Iara', 'Graça', '1992-12-14', 'iara_graca@email.com', '$2y$10$kqZttcTQ9CFDpPN6VTSjge99wLt1nVBPdYZ6PTlNpQRub.N6DzZ36', '2018-06-05 14:56:43'),
('Adrien', 'Foquiço', '2000-12-29', 'adrien_foquico@email.com', '$2y$10$wP1IOVqdbac8p2ou2fCp2.eA9csx6hkQ8uCqY/NTaforpuOmR/gFi', '2020-02-11 14:56:43'),
('Sales', 'Zarco', '1982-02-25', 'sales_zarco@email.com', '$2y$10$.Pj42ESF1WiBxGYUTlXd5.1JCVMopCDorZimmxd60rqKn/1WkwCf.', '2020-11-29 14:56:43'),
('Derick', 'Valverde', '1990-09-30', 'derick_valverde@email.com', '$2y$10$tozXxHBttNDwrb1z.eFtOu5id4sLdJDHnQmy2GnnVE71mCxvRg3i6', '2018-02-08 14:56:43'),
('George', 'Lacerda', '1978-11-16', 'george_lacerda@email.com', '$2y$10$MzYPtipp6Dv0/gI3RNx5X.ef0GyW2PywOS2tph.3dGrfAyAS0OzhC', '2016-11-28 14:56:43'),
('Jayden', 'Jamandas', '1992-05-04', 'jayden_jamandas@email.com', '$2y$10$pdE6PgrKtORAMGrTn6jnYeXhR3cxEsFI7XtAu.BHJ4hli90WnB4JW', '2018-01-23 14:56:43'),
('Adrien', 'Pederneiras', '1994-08-26', 'adrien_pederneiras@email.com', '$2y$10$uc8yKnpuxRRnNvXarBbhw.0yRrlnX8rVWEB08v4GPqhh99kBPFltO', '2020-05-13 14:56:44'),
('Virgínia', 'Covilhã', '1992-12-22', 'virginia_covilha@email.com', '$2y$10$nr2SWN87K0H3nctFX8jcWOicN/aFdOLbnRlVInXjW9nfEa212Rv1G', '2019-08-08 14:56:44'),
('Dilan', 'Foquiço', '1975-04-29', 'dilan_foquico@email.com', '$2y$10$uZN4Jx6l15haIbWMyTGaneosQJJUjrVTFtNtNzWfmg/j8Su9d9vQy', '2019-11-03 14:56:44'),
('Erica', 'Grilo', '1977-08-11', 'erica_grilo@email.com', '$2y$10$BCtJKmzS.OP3Bdt3ElV4A.gZFcMAjt8/dKu88mpbT10yXdb5q5wj6', '2016-07-03 14:56:44'),
('Jayden', 'Foquiço', '1974-02-18', 'jayden_foquico@email.com', '$2y$10$TEMdS3axRb5/nCbhelc9tuotchKCYa3w3fcxVvRaVj6Uub5x6oOEO', '2018-04-12 14:56:44'),
('Marcelo', 'Tomazelli', '2002-08-21', 'marcelo_tomazelli@email.com', '$2y$10$p77I9urIn9SqjsIvi2Po7evtDlXtA1pb9VKTWGgqEAHoF2rBbRa1G', '2020-08-17 14:56:44')

