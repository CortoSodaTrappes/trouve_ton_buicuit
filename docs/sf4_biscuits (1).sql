-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 24 2018 г., 16:00
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sf4_biscuits`
--

-- --------------------------------------------------------

--
-- Структура таблицы `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mainimage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naissance` date NOT NULL,
  `trait_caractere` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_relation` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taille` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silhouette` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yeux` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheveux` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fume` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mange` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jesuis` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jeveux` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `punchline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `animaux` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobby` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `email`, `password`, `role`, `mainimage`, `ville`, `naissance`, `trait_caractere`, `type_relation`, `taille`, `silhouette`, `yeux`, `cheveux`, `fume`, `mange`, `jesuis`, `jeveux`, `description`, `punchline`, `animaux`, `hobby`, `statut`) VALUES
(2, 'Creator', 'margotliash@gmail.com', '$2y$13$sRsVQNV/E1VL.WwMHUpkGuyDbl6WUwD2C8zcKvO5YEuUCUw/3m8kq', 'ROLE_USER', 'margotliashs.jpeg', 'Nantes', '1990-12-24', 'Calme', 'Durable', '1m50 - 1m70', 'mince et/ou sportif', 'Marron', 'Châtain', 'Jamais', 'Végétarie/végan', 'Femme', 'Homme', 'Faire le site : Faire le site bien', 'Faire le site', 'Chat', 'Musique', 'Jamais marié'),
(3, 'Borat', 'borat@gmail.com', '$2y$13$YoHxgryeU5woV34xPUFX/.9r/Oso5ETnKjqodJi4ZElsNO/sVGamG', 'ROLE_USER', 'Borat.jpeg', 'Astana', '1980-01-16', 'Extravagant', 'Durable', '1m80 - 2m', 'Maigre ou mince', 'Marron', 'Châtain', 'Jamais', 'Hallal', 'Homme', 'Femme', 'Je suis fils de Assimar Barra Sagdiyev et de Bortak le Violeur qui est aussi mon grand-père maternel.', 'Niiiice', 'Autre', 'Voyages', 'Veuve'),
(4, 'Charlie', 'charlie@gmail.com', '$2y$13$BltYjog3u919TlvbeRViiO6zCnJu5IzZfpO8DbrfQVS4ECnG/WNDi', 'ROLE_USER', 'Charlie.jpeg', 'Philadelphia', '1983-02-10', 'Sociable', 'Sex-friend', '1m60 - 1m80', 'Maigre ou mince', 'Verts', 'Châtain', 'Un peu', 'Tout', 'Homme', 'Homme', 'Cannibalism? Racism? Dude, that’s not for us ... those decisions are better left to the suits in Washington. We’re just here to eat some dude!', 'What is your spaghetti policy here?', 'Oiseau', 'Musique', 'Jamais marié'),
(5, 'Sweetdee', 'sweetdee@gmail.com', '$2y$13$6H.U5CUD.QNcGb3AlDzZeOu7jFYA8PmBY9XgO6jniODbBYSKWz7gG', 'ROLE_USER', 'Sweetdee.jpeg', ' Philadelphia', '1978-07-14', 'Aventureux', 'One shot', '1m60 - 1m80', 'Maigre ou mince', 'Bleus', 'Blonds', 'Beaucoup', 'Tout', 'Femme', 'Homme', 'Sister of Dennis Reynolds, and the legal daughter of Frank and Barbara Reynolds.', 'We used to be losers, like all of you peuple', 'Chat', 'Arts', 'Jamais marié'),
(6, 'Frank', 'frank@gmail.com', '$2y$13$Y6Pq2kKkUIkIOhOjCceSFOh.w5kE76ORPRyfEmhUZ.LdOKamabeiC', 'ROLE_USER', 'Frank.jpeg', 'Philadelphia', '1965-11-18', 'Sociable', 'Sans prise de tête', '1m40 - 1m60', 'pulpeu(se) et/ou rond(e)', 'Marron', 'Autre', 'Enormément', 'Tout', 'Homme', 'Couple hf', 'I’m not gonna be buried in a grave. When I’m dead, just throw me in the trash.', 'Ham', 'Chien', 'Arts', 'Veuve'),
(7, 'Prince', 'prince@gmail.com', '$2y$13$pwHTKOAuNE6hFcoUOMHYCusU67O9/pdoyNPXTsw4g0mtnaqwiiynG', 'ROLE_USER', 'Prince.jpeg', 'London', '1972-02-09', 'Drôle', 'Sex-friend', '1m60 - 1m80', 'sportif et/ou normal', 'Bleus', 'Châtain', 'Jamais', 'Casher', 'Homme', 'Troisième sexe', 'Je suis prince!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', 'Je suis prince', 'Poisson', 'Littérature', 'Divorcé'),
(8, 'Tommy', 'tommy@gmail.com', '$2y$13$He6KxIjnqWeojP9jSTyDBOqKXeRD8./poSTqSb8KK5QRR1/Va/0hG', 'ROLE_USER', 'Tommy.jpeg', 'London', '1976-04-24', 'Aventureux', 'Durable', '1m60 - 1m80', 'mince et/ou sportif', 'Bleus', 'Châtain', 'Enormément', 'Tout', 'Homme', 'Femme', 'London is just smoke and trouble', 'Peaky Blinders', 'Autre', 'Sport', 'Divorcé'),
(9, 'Madmax', 'madmax@gmail.com', '$2y$13$ssaMnJN7sUe.WKwj2fPHWeMntdQA0H5t.q7ofNNZtzXMUn6LmuG3.', 'ROLE_USER', 'Madmax.jpeg', 'Desert', '1981-12-16', 'Aventureux', 'One shot', '1m60 - 1m80', 'sportif et/ou normal', 'Verts', 'Châtain', 'Jamais', 'Tout', 'Homme', 'Femme', 'I am mad', 'Water', 'Autre', 'Voyages', 'Jamais marié'),
(10, 'Jess', 'jess@gmail.com', '$2y$13$FsPOFA6oZVkDLIBasoBFKOJ7VMxYcd/K21XXqDKKfiYKjqTocaXCi', 'ROLE_USER', 'Jess.jpeg', 'Los Angeles', '1977-02-17', 'Calme', 'Durable', '1m60 - 1m80', 'sportif et/ou normal', 'Verts', 'Roux', 'Jamais', 'Végétarie/végan', 'Femme', 'Homme', 'I am rich and beautiful', 'Women Power', 'Chien', 'Arts', 'Jamais marié');

-- --------------------------------------------------------

--
-- Структура таблицы `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL,
  `id_expediteur_id` int(11) NOT NULL,
  `id_destinataire_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180821133601');

-- --------------------------------------------------------

--
-- Структура таблицы `presentations`
--

CREATE TABLE `presentations` (
  `id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `presentation` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_personne` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_relation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `recherches`
--

CREATE TABLE `recherches` (
  `id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `type_personne` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_relation` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre_recherche` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_14E8F60CAE1B8E04` (`id_expediteur_id`),
  ADD KEY `IDX_14E8F60C4DA68CE6` (`id_destinataire_id`);

--
-- Индексы таблицы `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `presentations`
--
ALTER TABLE `presentations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_72936B1DEAAC4B6D` (`id_membre_id`);

--
-- Индексы таблицы `recherches`
--
ALTER TABLE `recherches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_84050CB5EAAC4B6D` (`id_membre_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `presentations`
--
ALTER TABLE `presentations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `recherches`
--
ALTER TABLE `recherches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `messagerie`
--
ALTER TABLE `messagerie`
  ADD CONSTRAINT `FK_14E8F60C4DA68CE6` FOREIGN KEY (`id_destinataire_id`) REFERENCES `membres` (`id`),
  ADD CONSTRAINT `FK_14E8F60CAE1B8E04` FOREIGN KEY (`id_expediteur_id`) REFERENCES `membres` (`id`);

--
-- Ограничения внешнего ключа таблицы `presentations`
--
ALTER TABLE `presentations`
  ADD CONSTRAINT `FK_72936B1DEAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membres` (`id`);

--
-- Ограничения внешнего ключа таблицы `recherches`
--
ALTER TABLE `recherches`
  ADD CONSTRAINT `FK_84050CB5EAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
