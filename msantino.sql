--
-- Table structure for table `Amministratore`
--

CREATE TABLE `Amministratore` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Amministratore`
--

INSERT INTO `Amministratore` (`id`, `user`, `password`) VALUES
(1, 'admin01', 'pass-789'),
(2, 'admin02', 'pass-456');

-- --------------------------------------------------------

--
-- Table structure for table `Auto`
--

CREATE TABLE `Auto` (
  `id` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modello` varchar(20) NOT NULL,
  `trazione` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Auto`
--

INSERT INTO `Auto` (`id`, `marca`, `modello`, `trazione`) VALUES
(1, 'Toyota', 'Yaris WRC', 'AWD'),
(2, 'Citroen', 'C3 WRC', 'AWD'),
(3, 'Hyundai', 'i20 WRC', 'AWD'),
(4, 'Ford', 'Fiesta WRC', 'AWD');

-- --------------------------------------------------------

--
-- Table structure for table `Gara`
--

CREATE TABLE `Gara` (
  `id` int(11) NOT NULL,
  `giorno` date NOT NULL,
  `id_pista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Gara`
--

INSERT INTO `Gara` (`id`, `giorno`, `id_pista`) VALUES
(1, '2018-01-25', 1),
(2, '2018-02-15', 2),
(3, '2018-03-08', 3),
(4, '2018-04-05', 4),
(5, '2018-04-26', 5),
(6, '2018-05-17', 6),
(7, '2018-06-07', 7),
(8, '2018-07-26', 8),
(9, '2018-08-16', 9),
(10, '2018-09-13', 10),
(11, '2018-10-04', 11),
(12, '2018-10-25', 12),
(13, '2018-11-15', 13);

-- --------------------------------------------------------

--
-- Table structure for table `Iscritto`
--

CREATE TABLE `Iscritto` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Pilota`
--

CREATE TABLE `Pilota` (
  `matricola` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `eta` int(11) NOT NULL,
  `genere` varchar(1) DEFAULT NULL,
  `nazionalita` varchar(20) DEFAULT NULL,
  `id_team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Pilota`
--

INSERT INTO `Pilota` (`matricola`, `nome`, `cognome`, `eta`, `genere`, `nazionalita`, `id_team`) VALUES
(1001, 'Sebastien', 'Ogier', 31, 'M', 'Francia', 4),
(1002, 'Elfyn', 'Evans', 31, 'M', 'Regno Unito', 4),
(1003, 'Andreas', 'Mikkelsen', 32, 'M', 'Belgio', 3),
(1004, 'Ott', 'Tanak', 31, 'M', 'Estonia', 1),
(1005, 'Jari Matti', 'Latvala', 31, 'M', 'Finlandia', 1),
(1006, 'Esapekka', 'Lappi', 31, 'M', 'Finlandia', 1),
(1007, 'Kris', 'Meeke', 37, 'M', 'Irlanda del Nord', 2),
(1008, 'Daniel', 'Sordo', 33, 'M', 'Spagna', 3),
(1009, 'Craig', 'Breen', 26, 'M', 'Irlanda', 2),
(1010, 'Thierry', 'Neuville', 28, 'M', 'Belgio', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Pista`
--

CREATE TABLE `Pista` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `citta` varchar(30) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `stato` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Pista`
--

INSERT INTO `Pista` (`id`, `nome`, `citta`, `tipo`, `stato`) VALUES
(1, 'Rallye Automobile Monte Carlo', 'Montecarlo', 'Neve-Asfalto', 'Montecarlo'),
(2, 'Rally Sweden', 'Karlstad', 'Neve', 'Svezia'),
(3, 'Rally Guanajuato Corona México', 'Leon', 'Sterrato', 'Messico'),
(4, 'CORSICA Linea Tour de Corse', 'Bastia', 'Asfalto', 'Francia'),
(5, 'YPF Rally Argentina', 'Villa Carlos Paz', 'Sterrato', 'Argentina'),
(6, 'Vodafone Rally de Portugal', 'Matosinhos', 'Sterrato', 'Portogallo'),
(7, 'Rally Italia Sardegna', 'Alghero', 'Sterrato', 'Italia'),
(8, 'Neste Rally Finland', 'Jyvaskyla', 'Sterrato', 'Finlandia'),
(9, 'ADAC Rallye Deutschland', 'Bostalsee', 'Asfalto', 'Germania'),
(10, 'Marmaris Rally Turkey', 'Marmaris', 'Sterrato', 'Turchia'),
(11, 'Dayinsure Wales Rally GB', 'Deeside', 'Sterrato', 'Regno Unito'),
(12, 'Rally RACC Catalunya - Rally de España', 'Salou', 'Asfalto - Sterrato', 'Spagna'),
(13, 'Kennards Hire Rally Australia', 'Coffs Harbour', 'Sterrato', 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `Risultati_Gare`
--

CREATE TABLE `Risultati_Gare` (
  `id_gara` int(11) NOT NULL,
  `id_pilota` int(11) NOT NULL,
  `posizione_arrivo` int(11) DEFAULT NULL,
  `punti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Risultati_Gare`
--

INSERT INTO `Risultati_Gare` (`id_gara`, `id_pilota`, `posizione_arrivo`, `punti`) VALUES
(1, 1001, 1, 25),
(1, 1002, 6, 8),
(1, 1003, 13, 0),
(1, 1004, 2, 18),
(1, 1005, 3, 15),
(1, 1006, 7, 6),
(1, 1007, 4, 12),
(1, 1008, 99, 0),
(1, 1009, 9, 2),
(1, 1010, 5, 10),
(2, 1001, 10, 1),
(2, 1002, 14, 0),
(2, 1003, 3, 15),
(2, 1004, 9, 2),
(2, 1005, 7, 6),
(2, 1006, 4, 12),
(2, 1007, 99, 0),
(2, 1008, 99, 0),
(2, 1009, 2, 18),
(2, 1010, 1, 25),
(3, 1001, 1, 25),
(3, 1002, 99, 0),
(3, 1003, 4, 12),
(3, 1004, 14, 0),
(3, 1005, 8, 4),
(3, 1006, 11, 0),
(3, 1007, 3, 15),
(3, 1008, 2, 18),
(3, 1009, 99, 0),
(3, 1010, 6, 8),
(4, 1001, 1, 25),
(4, 1002, 5, 10),
(4, 1003, 6, 8),
(4, 1004, 2, 18),
(4, 1005, 99, 0),
(4, 1006, 6, 8),
(4, 1007, 9, 2),
(4, 1008, 4, 12),
(4, 1009, 99, 0),
(4, 1010, 3, 15),
(5, 1001, 4, 12),
(5, 1002, 6, 8),
(5, 1003, 5, 10),
(5, 1004, 1, 25),
(5, 1005, 99, 0),
(5, 1006, 8, 4),
(5, 1007, 7, 6),
(5, 1008, 3, 15),
(5, 1009, 99, 0),
(5, 1010, 2, 18),
(6, 1001, 99, 0),
(6, 1002, 2, 18),
(6, 1003, 16, 0),
(6, 1004, 99, 0),
(6, 1005, 24, 0),
(6, 1006, 5, 10),
(6, 1007, 99, 0),
(6, 1008, 4, 12),
(6, 1009, 7, 6),
(6, 1010, 1, 25),
(7, 1001, 2, 18),
(7, 1002, 14, 0),
(7, 1003, 16, 0),
(7, 1004, 9, 2),
(7, 1005, 7, 6),
(7, 1006, 3, 15),
(7, 1007, 99, 0),
(7, 1008, 99, 0),
(7, 1009, 6, 8),
(7, 1010, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

CREATE TABLE `Team` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_presidente` varchar(40) NOT NULL,
  `id_auto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Team`
--

INSERT INTO `Team` (`id`, `nome`, `nome_presidente`, `id_auto`) VALUES
(1, 'Toyota Gazoo Racing WRT', 'Toshio Sato', 1),
(2, 'Citroen Total Abu-Dhabi WRT', 'Khalid Al Qassimi', 2),
(3, 'Hyundai Shell Mobis WRT', 'Gyoo-Heon Choi', 3),
(4, 'M-Sport Ford Word Rally Team', 'Malcolm Wilson', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Amministratore`
--
ALTER TABLE `Amministratore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Auto`
--
ALTER TABLE `Auto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Gara`
--
ALTER TABLE `Gara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pista` (`id_pista`);

--
-- Indexes for table `Iscritto`
--
ALTER TABLE `Iscritto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Pilota`
--
ALTER TABLE `Pilota`
  ADD PRIMARY KEY (`matricola`),
  ADD KEY `id_team` (`id_team`);

--
-- Indexes for table `Pista`
--
ALTER TABLE `Pista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Risultati_Gare`
--
ALTER TABLE `Risultati_Gare`
  ADD PRIMARY KEY (`id_gara`,`id_pilota`),
  ADD KEY `id_pilota` (`id_pilota`);

--
-- Indexes for table `Team`
--
ALTER TABLE `Team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auto` (`id_auto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Amministratore`
--
ALTER TABLE `Amministratore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Iscritto`
--
ALTER TABLE `Iscritto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Gara`
--
ALTER TABLE `Gara`
  ADD CONSTRAINT `Gara_ibfk_1` FOREIGN KEY (`id_pista`) REFERENCES `Pista` (`id`);

--
-- Constraints for table `Pilota`
--
ALTER TABLE `Pilota`
  ADD CONSTRAINT `Pilota_ibfk_1` FOREIGN KEY (`id_team`) REFERENCES `Team` (`id`);

--
-- Constraints for table `Risultati_Gare`
--
ALTER TABLE `Risultati_Gare`
  ADD CONSTRAINT `Risultati_Gare_ibfk_1` FOREIGN KEY (`id_gara`) REFERENCES `Gara` (`id`),
  ADD CONSTRAINT `Risultati_Gare_ibfk_2` FOREIGN KEY (`id_pilota`) REFERENCES `Pilota` (`matricola`) ON DELETE CASCADE;

--
-- Constraints for table `Team`
--
ALTER TABLE `Team`
  ADD CONSTRAINT `Team_ibfk_1` FOREIGN KEY (`id_auto`) REFERENCES `Auto` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
