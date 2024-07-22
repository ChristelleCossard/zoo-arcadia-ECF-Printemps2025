
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `role`) VALUES
(4, 'user@test.com', '$2y$10$lEzMI.H26sDsV4PzhAVBveHiTDBrH0BGSaNDAin.89cP8y/baG0vu', 'Test', 'Test', 'user'),
(5, 'admin@test.com', '$2y$10$lEzMI.H26sDsV4PzhAVBveHiTDBrH0BGSaNDAin.89cP8y/baG0vu', 'Admin', 'Admin', 'admin'),
(6, 'coco@test.com', '$2y$10$ZTgBGdfljMJjA2c6yq83iu/10XVdCGvmE.24TrxsooiynfxNNrTdm', 'coco', 'coco', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nameservice` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photoservice` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

INSERT INTO `services` (`id`, `nameservice`, `description`, `photoservice`) VALUES
(1,'Service 1','ici description', NULL),
(2, 'Service 2', 'ici description', NULL),
(3, 'Service 3', 'ici description',NULL),
(4, 'Service 4', 'ici description', NULL);


CREATE TABLE horaires(
   id INT,
   jour VARCHAR(50),
   matin VARCHAR(50),
   apresmidi VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE avis(
   id INT,
   first_name VARCHAR(50),
   last_name VARCHAR(50),
   comments VARCHAR(255),
   note DECIMAL(2,0),
   PRIMARY KEY(id)
);


CREATE TABLE contact(
   id INT,
   first_name VARCHAR(50),
   last_name VARCHAR(50),
   email VARCHAR(50),
   telephone DECIMAL(10,0),
   message VARCHAR(255),
   PRIMARY KEY(id)
);

CREATE TABLE habitats(
   id INT,
   namehabitat VARCHAR(50),
   photohabitat VARCHAR(50),
   description VARCHAR(50),
   animals_id INT,
   PRIMARY KEY(id)
);

CREATE TABLE animals(
   id INT,
   firstname VARCHAR(50),
   description VARCHAR(50),
   imageanimal VARCHAR(50),
   state VARCHAR(50),
   food VARCHAR(50),
   quantity INT,
   id_1 INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES categories(id)
);

CREATE TABLE animalimage(
   Id INT,
   animals_id INT NOT NULL,
   urlimage VARCHAR(50),
   id_1 INT NOT NULL,
   PRIMARY KEY(Id),
   FOREIGN KEY(id_1) REFERENCES animals(id)
);
