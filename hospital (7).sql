-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 05 2021 г., 12:42
-- Версия сервера: 5.7.24
-- Версия PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hospital`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `specialist` varchar(255) NOT NULL,
  `workingStatus` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `doctors`
--

INSERT INTO `doctors` (`id`, `image`, `name`, `email`, `password`, `phone`, `gender`, `specialist`, `workingStatus`, `created`) VALUES
(1, '../dist/img/doctors/avatar.png', 'Popov A.V.', 'popovav067@gmail.com', '$2y$10$MAfm0.JoHF6X89KFaFvtfuJxmoFiI/HqdrMB046LxKKjWuAG5ZY2q', '(032) 188-7896', 0, 'Family physicians', 0, '2018-05-01 13:07:24'),
(2, '../dist/img/doctors/avatar5.png', 'Popov A.M.', 'popovmv067@gmail.com', '$2y$10$kFhLHI6aoq22jzqxcsoZHOOcMId3EC8/IMfNdsj2c8YCt6Hu.DvOy', '(032) 188-7896', 0, 'Family physicians', 0, '2018-05-01 13:07:24'),
(3, '../dist/img/doctors/avatar4.png', 'Sidorov A.V.', 'sidorov067@gmail.com', '$2y$10$iHz8/q5lxkZsrsXh/TymzueUJvlif/YrXgF.8PFknsaBp.Rv089CS', '(032) 188-7896', 0, 'Family physicians', 0, '2018-05-01 13:07:24'),
(4, '../dist/img/doctors/avatar2.png', 'Kazlova A.V.', 'kozlova067@gmail.com', '$2y$10$oQUTa33tHeP3sCGoDnOb5O56nM8Jngyxe2/S1vvyKcSo.yQPtVYXe', '(032) 188-7896', 0, 'Family physicians', 0, '2018-05-01 13:07:24'),
(5, '../dist/img/doctors/avatar4.png', 'Smirnov L.H.', 'sidorov067@gmail.com', '$2y$10$0XSLvV1WfBZi9jfD3lKaTer5HA6U3IAlROHzj5.mS8.GV7CtePvGO', '(032) 188-7896', 0, 'Family physicians', 0, '2018-05-01 13:07:24'),
(6, '../dist/img/doctors/avatar3.png', 'Kotova A.L.', 'kotova067@gmail.com', '$2y$10$D2PywmfHv1omkKKAr3AXYOBEiQKiIgsYdABP2d0FnS7EwYwHfJKgK', '(032) 188-7896', 0, 'Family physicians', 0, '2018-05-01 13:07:24'),
(37, '../dist/img/doctors/images (3).png', 'Jordon', 'vr.war@gmail.com', '$2y$10$4IQuCh/GuV2Lsnl9GYKY8u1b/50F/DY80hCurzJ5DlnK5B.Z0S6km', '(312) 313-1321', 1, 'Psychiatrists', 1, '2021-01-29 06:50:45'),
(45, '../dist/img/doctors/2131436202_preview_1_BabychanTH1.png', 'Jordon 22F.G.', '11111118965@hafutv.com', '$2y$10$gqBd/WNk3YvmPCkF6EmXx.LpKQaQzc/8Y9VT1LT8lvQvdQwzD2gVy', '(131) 233-1314', 1, 'Surgeons', 1, '2021-01-30 14:14:02'),
(88, '../dist/img/doctors/images (3).jpg', 'Robin', 'root@1111', '$2y$10$g6s3xMgFhIvGbKiuBUHsA.EZmAgu7.CJ8TGd0URF/a9OnqWYRi7AO', '(123) 131-3123', 1, 'Tennessee', 1, '2021-01-31 08:56:29'),
(98, '../dist/img/doctors/images (2).png', 'Zar A.V.', 'rootsd@dsdaa', '$2y$10$GSiFX5GoEeHgntJJg9thqON93cHkBANr8iEgFUeI.V2n7hq1YyyZi', '(131) 313-1313', 0, 'Family physicians', 0, '2021-01-31 12:54:15'),
(99, '../dist/img/doctors/images (3).png', 'Angl', 'root@dsada', '$2y$10$X5l.hxuaKsIQzpdaK26Qv.3AYz2SXycya3ucEeJJNIzUHGHR612Z2', '(123) 131-2313', 0, 'Pediatricians', 0, '2021-01-31 13:14:37'),
(100, '../dist/img/doctors/images (2).png', 'mama', 'root@DSADADASDASD', '$2y$10$tyVZe2WusCR1ncnLCYu2feol74EpEuAkXqcv0qkjRDMVY5aW7cNc6', '(123) 131-3131', 0, 'Family physicians', 0, '2021-01-31 13:47:44'),
(102, '../dist/img/doctors/images (4).png', 'Vasia', 'vasia@gmail.com', '$2y$10$bSkY8LeeGllLEl5rDUBX6.TrTGQNHer4M.n3H38WhmoNUDIcqgAaO', '(454) 651-6546', 1, 'Tennessee', 1, '2021-02-08 09:42:23'),
(103, '../dist/img/doctors/images (7).png', 'JoJo S', '112VQEEE18965@hafutv.com', '$2y$10$heC3MpcM2QC/vVMr6IDa5Ogtm7yy4m6Wg1xcb0DH87c5Kka8UO70y', '(231) 313-1313', 0, 'Family physicians', 0, '2021-02-08 10:09:42');

-- --------------------------------------------------------

--
-- Структура таблицы `nurses`
--

CREATE TABLE `nurses` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `specialist` varchar(255) NOT NULL,
  `workingStatus` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nurses`
--

INSERT INTO `nurses` (`id`, `image`, `name`, `email`, `password`, `phone`, `gender`, `specialist`, `workingStatus`, `created`) VALUES
(1, '../dist/img/avatar.png', 'Popov A.V.', 'popovav067@gmail.com', 'Vm0xMFlWbFdWWGhVYmxKWFltdHdVRlpzV21GWFJscHlWV3RLVUZWVU1Eaz0=', '03218878961', 1, 'Therapist', 0, '2018-05-01 13:07:24'),
(2, '../dist/img/avatar5.png', 'Popov A.M.', 'popovmv067@gmail.com', 'Vm0xMFlWbFdWWGhVYmxKWFltdHdVRlpzV21GWFJscHlWV3RLVUZWVU1Eaz0=', '03218878961', 1, 'Cardiologist', 1, '2018-05-01 13:07:24'),
(3, '../dist/img/avatar4.png', 'Sidorov A.V.', 'sidorov067@gmail.com', 'Vm0xMFlWbFdWWGhVYmxKWFltdHdVRlpzV21GWFJscHlWV3RLVUZWVU1Eaz0=', '03218878961', 1, 'Rheumatologist', 0, '2018-05-01 13:07:24'),
(4, '../dist/img/avatar2.png', 'Kazlova A.V.', 'kozlova067@gmail.com', 'Vm0xMFlWbFdWWGhVYmxKWFltdHdVRlpzV21GWFJscHlWV3RLVUZWVU1Eaz0=', '03218878961', 0, 'Traumatologist', 1, '2018-05-01 13:07:24'),
(5, '../dist/img/avatar4.png', 'Smirnov L.H.', 'sidorov067@gmail.com', 'Vm0xMFlWbFdWWGhVYmxKWFltdHdVRlpzV21GWFJscHlWV3RLVUZWVU1Eaz0=', '03218878961', 1, 'Rheumatologist', 0, '2018-05-01 13:07:24');

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `disease_severity` tinyint(1) NOT NULL,
  `health_condition` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `patients`
--

INSERT INTO `patients` (`id`, `image`, `name`, `phone`, `gender`, `disease_severity`, `health_condition`, `created`) VALUES
(1, '../dist/img/patients/avatar.png', 'Fergus J.K.', '9988596666', 1, 3, 'OK', '2018-06-26 13:12:18'),
(2, '../dist/img/patients/avatar2.png', 'Crispin V.K.', '6662813', 1, 1, 'poor health', '2018-06-26 13:12:18'),
(3, '../dist/img/patients/avatar3.png', 'Ellis J.J.', '9121913611', 0, 3, 'OK', '2018-06-26 13:12:18'),
(4, '../dist/img/patients/avatar3.png\r\n', 'Piers O.P.', '11196666', 1, 1, 'poor health', '2018-06-26 13:12:18'),
(5, '../dist/img/patients/avatar5.png\r\n', 'Conall  V.V.', '94456596326', 1, 3, 'OK', '2018-06-26 13:12:18'),
(6, '../dist/img/patients/avatar.png\r\n', 'Kenzie  Q.K.', '9983129', 1, 2, ' satisfactory condition', '2018-06-26 13:12:18'),
(7, '../dist/img/patients/avatar2.png\r\n', 'Gladys G.K.', '31432456', 0, 3, 'OK', '2018-06-26 13:12:18'),
(8, '../dist/img/patients/avatar.png\r\n', 'Fer J.K.', '765757573', 1, 2, ' satisfactory condition', '2018-06-26 13:12:18'),
(9, '../dist/img/patients/avatar5.png\r\n', 'Myrtle P.K.', '1913408', 0, 1, 'poor health', '2018-06-26 13:12:18'),
(10, '../dist/img/patients/avatar2.png\r\n', 'Fergus J.K.', '23894462', 1, 2, ' satisfactory condition', '2018-06-26 13:12:18'),
(11, '../dist/img/patients/avatar4.png\r\n', 'Frideswide O.O.', '1234513', 0, 2, ' satisfactory condition', '2018-06-26 13:12:18'),
(12, '../dist/img/patients/avatar5.png\r\n', 'Euan E.E.', '1356779000', 1, 1, 'poor health', '2018-06-26 13:12:18'),
(13, '../dist/img/patients/avatar.png\r\n', 'Lachlan L.K.', '990001123', 1, 3, 'OK', '2018-06-26 13:12:18'),
(14, '../dist/img/patients/avatar5.png\r\n', 'Euan E.V.', '1356779000', 1, 1, 'poor health', '2018-06-26 13:12:18'),
(15, '../dist/img/patients/avatar.png\r\n', 'Lachlan L.Q.', '990001123', 1, 3, 'OK', '2018-06-26 13:12:18');

-- --------------------------------------------------------

--
-- Структура таблицы `patients-doctor`
--

CREATE TABLE `patients-doctor` (
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `patients-doctor`
--

INSERT INTO `patients-doctor` (`doctor_id`, `patient_id`) VALUES
(1, 5),
(2, 10),
(2, 13),
(3, 6),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(5, 6),
(5, 7),
(5, 10),
(5, 13),
(6, 7),
(37, 9),
(37, 15),
(100, 11),
(100, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `patients-nurse`
--

CREATE TABLE `patients-nurse` (
  `nurse_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `patients-nurse`
--

INSERT INTO `patients-nurse` (`nurse_id`, `patient_id`) VALUES
(1, 9),
(2, 3),
(2, 8),
(3, 1),
(3, 5),
(3, 6),
(3, 13),
(4, 4),
(4, 9),
(4, 12),
(5, 7),
(5, 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patients-doctor`
--
ALTER TABLE `patients-doctor`
  ADD PRIMARY KEY (`doctor_id`,`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Индексы таблицы `patients-nurse`
--
ALTER TABLE `patients-nurse`
  ADD PRIMARY KEY (`nurse_id`,`patient_id`),
  ADD KEY `nurse_id` (`nurse_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT для таблицы `nurses`
--
ALTER TABLE `nurses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `patients-doctor`
--
ALTER TABLE `patients-doctor`
  ADD CONSTRAINT `patients-doctor_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patients-doctor_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `patients-nurse`
--
ALTER TABLE `patients-nurse`
  ADD CONSTRAINT `patients-nurse_1` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patients-nurse_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
