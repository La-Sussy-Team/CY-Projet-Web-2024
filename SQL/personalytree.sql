-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 02:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personalytree`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `user1_id`, `user2_id`) VALUES
(14, 16, 15),
(13, 17, 13),
(12, 13, 15);

-- --------------------------------------------------------

--
-- Table structure for table `estconsulter`
--

CREATE TABLE `estconsulter` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `autre_utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estconsulter`
--

INSERT INTO `estconsulter` (`id`, `utilisateur_id`, `autre_utilisateur_id`) VALUES
(7, 13, 15),
(8, 13, 18),
(9, 18, 13),
(10, 16, 15),
(11, 17, 13);

-- --------------------------------------------------------

--
-- Table structure for table `infopersos`
--

CREATE TABLE `infopersos` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `sexe` enum('Homme','Femme','Autre','') NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `ville` varchar(30) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `pays` enum('Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cabo Verde','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Eswatini','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','North Macedonia','Norway','Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe') NOT NULL,
  `bio` blob DEFAULT NULL,
  `interets` blob DEFAULT NULL,
  `imgpath` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infopersos`
--

INSERT INTO `infopersos` (`user_id`, `email`, `phone`, `prenom`, `nom`, `sexe`, `dateNaissance`, `ville`, `adresse`, `pays`, `bio`, `interets`, `imgpath`) VALUES
(13, 'lilian@lilian.lilian', '121212121', 'Lilian', 'Jyroti', 'Homme', '2003-01-02', 'Pau', '99 grande rue', 'France', 0x4a2761646f7265206c27696e666f726d6174697175652c206d6f69206d616e67657220646573206361727465732067726170686971756573206327657374206d6f6e20747275632021204a2761646f7265206175737369206c61206d75736971756520737572746f757420636c61737369717565, 0x6d7573697175657e696e666f726d6174697175657e66696c6d73, '6618e89717125-istockphoto-1171169099-612x612.jpg'),
(15, 'pablo@gmail.com', '0123456789', 'Pablo', 'Berecoechao', 'Homme', '2002-04-22', 'Toulouse', '6 rue de Boyard', 'France', 0x53616c75742c206a652073756973207061626c6f2e206a65207375697320756e206b6f6f706c6573206574206a2761696d65206c6573206368617473206574206c6573206a657578, 0x76616c6f72616e747e666c6f707e66696c6d737e6b6f6f706c6573, '6618f3f60d25a-pablo.jpg'),
(16, 'smooss@gmail.com', '0123456788', 'Lilia', 'Bourino', 'Femme', '2001-02-02', 'Pagnan', '8 boulevard principal', 'France', 0x48656c6c6f2c206d6f69206327657374206c696c6961206a2761696d65206c657320666c65757273206574206c657320706c616e746573205e5e204e2768c3a9736974652070617320c3a0206d6520636f6e7461637465722073692074752061696d6573206c65732072616e646f6e6ec3a96573, 0x72616e646f6e6ec3a965737e706c616e7465737e6e6174757265, '6618e70acd4fb-istockphoto-1389348844-612x612.jpg'),
(17, 'megumi@ootliook.com', '0321654987', 'Megumi', 'Joliette', 'Femme', '1980-06-20', 'Moroco', '25 boulevard central', 'El Salvador', 0x53616c75742c206a652073756973204d6567756d692021204d6f69206a2761646f7265206c697265206574206d652063756c74697665722c206d616973206a2761646f72652061757373692063756c74697665722064657320706c616e746573206269656e2073c3bb72202120436f6e74616374206d6f692073692074752076657578206d65207061726c6572, 0x6c69767265737e726f6d616e737e706c616e7465737e63756c7469766572, '6618ed6d266e1-megumi.jpg'),
(18, 'pierre@proton.fr', '0321987654', 'Pierre', 'Pagnan', 'Homme', '1999-02-06', 'Paris', '9878 énorme rue du monstre', 'Seychelles', 0x496e766573746973736575722c2072696368652c20626561752c20746f70206d6f64c3a86c65206a652073756973206f7576657274206175782070726f706f736974696f6e732c206e2768c3a9736974657a2070617320c3a0206d6520636f6e746163746572, 0x626561757e72696368657e63c3a96cc3a8627265, '6618eebc01c6b-64101bd1e383a.jpeg'),
(19, 'banni@gmail.com', '0987654321', 'Jean', 'Delatoile', 'Homme', '1980-05-05', 'Suisse', '6 de bretagne', 'Finland', 0x4a65207375697320756e2072616e646f6d207574696c6973617465757220717569206e6520726563686572636865207269656e20646520706172746963756c696572205e5e, 0x677569746172657e616d6f677573, '6618f3788dfa0--761509845029662333s1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `isSub` tinyint(1) NOT NULL,
  `isBanned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `isAdmin`, `isSub`, `isBanned`) VALUES
(13, 'lilian', '$2y$10$.iEmbBkGtyz4TtQh9920guZ2Fy3LofQ3grt07uBqOa5Qwom3wmGpa', 1, 1, 0),
(15, 'pablobg', '$2y$10$eZiNwlRVswd/ZeoxzqSxHumTK6.qUv7PqtC2z6Vk5ShKrhabxu2L2', 0, 1, 0),
(16, 'smooss', '$2y$10$LjK4TCK8Ns/u0CFcIN2buuMr42WO.ngEHRtCRagEJHj2qSoV8SN8e', 0, 1, 0),
(17, 'megumi', '$2y$10$wsA0Ez6VDF/dmOjQ78oqTerav66N709jHIPUBRiNUNSFrMAGJnqkm', 0, 1, 0),
(18, 'pierre', '$2y$10$bdWuY.9P1JuxvWbmx6Y13On4kMDXWwwP4W9MZfXHPaaFWIq9YkCk6', 0, 1, 0),
(19, 'banni', '$2y$10$5MV5paLLKoBByYzAk75ZPulqeHm7HK56OZunaFLZvACuMhdis0HKu', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `isReported` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `receiver_id`, `message`, `timestamp`, `isReported`) VALUES
(72, 0, 13, 17, 'moi ça va aussi', '2024-04-12 08:34:47', 0),
(73, 0, 13, 17, 'je n\'aime pas lire', '2024-04-12 08:34:51', 0),
(68, 13, 17, 13, 'J\'adore lire', '2024-04-12 08:33:31', 1),
(67, 13, 17, 13, 'Moi ça va nickel', '2024-04-12 08:33:26', 0),
(66, 13, 17, 13, 'Comment allez vous ?', '2024-04-12 08:33:22', 0),
(65, 13, 17, 13, 'Bien le bonjour', '2024-04-12 08:33:17', 0),
(64, 12, 13, 15, 'Au revoir alors', '2024-04-12 08:00:38', 0),
(63, 12, 13, 15, 'Pas de soucis ', '2024-04-12 08:00:33', 0),
(62, 0, 15, 13, 'Je te trouve gênant', '2024-04-12 08:00:15', 1),
(60, 12, 13, 15, 'J\'aime les films et toi ?', '2024-04-12 07:59:51', 0),
(61, 0, 15, 13, 'Moi non', '2024-04-12 08:00:06', 0),
(59, 12, 13, 15, 'Salut comment ça va ?', '2024-04-12 07:59:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plante`
--

CREATE TABLE `plante` (
  `id` int(11) NOT NULL,
  `plante` varchar(30) NOT NULL,
  `description` blob DEFAULT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `imgpath` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plante`
--

INSERT INTO `plante` (`id`, `plante`, `description`, `x`, `y`, `imgpath`) VALUES
(1, 'Broméliacées', 0x4a65207375697320636f6d6d6520756e652042726f6dc3a96c696163c3a9652c20c3a970616e6f75692065742076696272616e7420646520636f756c6575727320c3a9636c6174616e7465732e204d61207072c3a973656e636520696c6c756d696e65206c6573206a6f75726ec3a965732065742072c3a970616e64206c61206a6f6965206175746f7572206465206d6f692c206f666672616e7420756e20736f7572697265207261646965757820c3a020746f75732063657578207175692063726f6973656e74206d6f6e206368656d696e2e, 0, 0, 'bromeliacees.png'),
(2, 'Chlorophytum', 0x54656c20756e2043686c6f726f70687974756d2c206a6520746973736520646573206c69656e73206176656320616973616e636520657420646f75636575722c206372c3a9616e7420756e20656e7669726f6e6e656d656e74206163637565696c6c616e74206fc3b9206c657320616d697469c3a973207327c3a970616e6f75697373656e742e204d6f6e2063c5937572206f7576657274206574206d6120636f6e76697669616c6974c3a9206e61747572656c6c6520666f6e74206465206d6f6920756e20636f6d7061676e6f6e206964c3a9616c20706f757220746f75746573206c6573206f63636173696f6e732e, 1, 2, 'chlorophytum.png'),
(3, 'Cactus', 0x436f6d6d6520756e206361637475732c206a65207072c3a966c3a87265206c61207472616e7175696c6c6974c3a9206574206c6120736f6c69747564652c2074726f7576616e74206d6120666f7263652064616e73206c6120717569c3a9747564652064752064c3a9736572742e204d6f6e2073696c656e636520636163686520756e652070726f666f6e64657572206427c3a26d6520657420756e652072c3a973696c69656e636520717569206d276163636f6d7061676e656e742064616e73206c6573206d6f6d656e747320646520636f6e74656d706c6174696f6e2065742064652072c3a9666c6578696f6e2e, 3, -1, 'cactus.png'),
(4, 'Lierre', 0x4a65206d652073656e7320636f6d6d6520756e204c69657272652c20646f75782065742064c3a96c696361742c20636865726368616e742074696d6964656d656e74206d6120706c6163652064616e73206365206d6f6e64652e204d6f6e206265736f696e2064652073c3a96375726974c3a92065742064652072c3a9636f6e666f7274206d6520677569646520646f7563656d656e7420c3a02074726176657273206c657320696e746572616374696f6e7320736f6369616c65732c206f666672616e74206d6120636f6e6669616e636520617665632070727564656e6365206574207072c3a963617574696f6e2e, 6, 3, 'lierre.png'),
(5, 'Orchidée', 0x436f6d6d6520756e65204f7263686964c3a9652c206a65206d27c3a970616e6f7569732064616e73206c6520736f757469656e206574206c6520736f696e20646573206175747265732c206f666672616e74206d6f6e20616964652061766563206772c3a2636520657420636f6d70617373696f6e2e204d6f6e20c3a9636f75746520617474656e74697665206574206d612067c3a96ec3a9726f736974c3a920696e636f6e646974696f6e6e656c6c65206372c3a9656e7420756e20726566756765206fc3b92063686163756e20706575742074726f7576657220636f6e666f7274206574206775c3a97269736f6e2e, 2, 5, 'orchidee.png'),
(6, 'Lavande', 0x54656c20756e65204c6176616e64652c206a65207375697320696d7072c3a9676ec3a9206427756e6520646f7563652066726167696c6974c3a92c20746f75726d656e74c3a9207061722064657320766167756573206427616e7869c3a974c3a920717569207669656e6e656e7420657420726570617274656e7420636f6d6d65206c652076656e742e204d6f6e2070617266756d206170616973616e74206574206d6573207665727475732063616c6d616e746573206f666672656e7420756e2072c3a9706974206269656e76656e752064616e73206c657320746f75726d656e7473206465206c276573707269742e, -1, 7, 'lavande.png'),
(7, 'Oiseau de paradis', 0x436f6d6d6520756e204f697365617520646520506172616469732c206a6520737569732067756964c3a92070617220756e2064c3a973697220696e7361746961626c652064652070657266656374696f6e206574206427657863656c6c656e63652e204368617175652064c3a97461696c206465206d612076696520657374206dc3a9746963756c657573656d656e74206661c3a76f6e6ec3a92064616e7320756e65207175c3aa746520c3a97465726e656c6c65206465206772616e646575722c207265636865726368616e74206c276861726d6f6e6965206574206c2765737468c3a97469717565207061726661697465732064616e7320746f757420636520717565206a6520666169732e, -4, 4, 'oiseau-de-paradis.png'),
(8, 'Pothos', 0x4a652076616761626f6e64652074656c20756e20506f74686f732c206c61697373616e74206d65732070656e73c3a965732065727265722073616e7320636f6e747261696e746520c3a02074726176657273206c6573206dc3a9616e64726573206465206d6f6e206573707269742e204d6f6e20657370726974206c696272652065742064c3a973696e766f6c74652074726f757665206c61206265617574c3a92064616e73206c612073706f6e74616ec3a96974c3a9206574206c61206c6962657274c3a92c206f666672616e7420756e2072656761726420756e6971756520737572206c65206d6f6e646520717569206d27656e746f7572652e, -2, 1, 'pothos.png'),
(9, 'Dracaena citron', 0x54656c20756e204472616361656e6120636974726f6e2c206a652074726f757665206c612070616978206574206c612073c3a972c3a96e6974c3a92064616e73206c612073696d706c69636974c3a9206574206c27657373656e7469656c2e204d6f6e206d6f64652064652076696520c3a9707572c3a92065742064c3a9706f75727675206465207375706572666c75207265666cc3a87465206d612072656368657263686520636f6e7374616e74652064276861726d6f6e696520696e74c3a972696575726520657420646520636c617274c3a92064276573707269742e, -5, 0, 'dracaena.png'),
(10, 'Olivier', 0x4a65207375697320656e726163696ec3a920636f6d6d6520756e204f6c69766965722c20616e6372c3a92064616e73206c6120746572726520657420636f6e6e656374c3a920617578206379636c657320696e74656d706f72656c73206465206c61206e61747572652e204d612073696d706c69636974c3a92061757468656e7469717565206574206d61207361676573736520616e6369656e6e65206f666672656e7420756e20726566756765206fc3b9206c276f6e207065757420726574726f75766572206c27c3a97175696c69627265206574206c612076c3a9726974c3a92064616e7320756e206d6f6e646520656e20636f6e7374616e746520c3a9766f6c7574696f6e2e, -7, 2, 'olivier.png'),
(11, 'Tradescantia', 0x436f6d6d6520756e652054726164657363616e7469612c206a65207375697320636f6e7374616d6d656e7420656e206d6f7576656d656e742c206578706c6f72616e74206465206e6f75766561757820686f72697a6f6e732065742064c3a9636f757672616e7420646573206368656d696e7320696e636f6e6e75732e204d6f6e20657370726974206176656e747572657578206574206d6120736f6966206427657870c3a97269656e6365206f666672656e7420756e20766f7961676520696e66696e6920c3a02074726176657273206c6573206d65727665696c6c6573206475206d6f6e64652e, 3, 3, 'tradescantia.png');

-- --------------------------------------------------------

--
-- Table structure for table `relationplante`
--

CREATE TABLE `relationplante` (
  `id` int(11) NOT NULL,
  `id_plante` int(11) NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relationplante`
--

INSERT INTO `relationplante` (`id`, `id_plante`, `x`, `y`) VALUES
(13, 6, -0.142857, 2.14286),
(15, 2, 1.14286, 2),
(16, 11, 2.28571, 3.42857),
(17, 7, 0.571429, 3),
(18, 2, 0.571429, 2),
(19, 9, 1.85714, 2.57143);

-- --------------------------------------------------------

--
-- Table structure for table `serveurs_messages`
--

CREATE TABLE `serveurs_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `serveurs_messages`
--

INSERT INTO `serveurs_messages` (`id`, `user_id`, `other_user_id`) VALUES
(16, 16, 15),
(15, 17, 13),
(14, 13, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `estconsulter`
--
ALTER TABLE `estconsulter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `autre_utilisateur_id` (`autre_utilisateur_id`);

--
-- Indexes for table `infopersos`
--
ALTER TABLE `infopersos`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `plante`
--
ALTER TABLE `plante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationplante`
--
ALTER TABLE `relationplante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idlink_plante_plante` (`id_plante`);

--
-- Indexes for table `serveurs_messages`
--
ALTER TABLE `serveurs_messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_users` (`user_id`,`other_user_id`),
  ADD KEY `other_user_id` (`other_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `estconsulter`
--
ALTER TABLE `estconsulter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `serveurs_messages`
--
ALTER TABLE `serveurs_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estconsulter`
--
ALTER TABLE `estconsulter`
  ADD CONSTRAINT `estconsulter_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `estconsulter_ibfk_2` FOREIGN KEY (`autre_utilisateur_id`) REFERENCES `login` (`id`);

--
-- Constraints for table `infopersos`
--
ALTER TABLE `infopersos`
  ADD CONSTRAINT `idlink` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `relationplante`
--
ALTER TABLE `relationplante`
  ADD CONSTRAINT `idlink_plante_plante` FOREIGN KEY (`id_plante`) REFERENCES `plante` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `idlink_user_plante` FOREIGN KEY (`id`) REFERENCES `login` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
