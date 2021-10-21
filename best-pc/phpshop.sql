-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 27 2020 г., 20:16
-- Версия сервера: 5.6.41
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phpshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(13, 'Комп\'ютери', 1, 1),
(14, 'Ноутбуки', 2, 1),
(15, 'Монітори', 3, 1),
(16, 'Відеокарти', 4, 1),
(17, 'Процесори', 5, 1),
(18, 'Оперативна пам\'ять', 6, 1),
(19, 'Програмне забезпечення', 7, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(46, 'Artline Gaming X77 v23', 13, 1, 32999, 1, 'Artline', 'Intel Core i7-8700 (3.2 - 4.6 ГГц) / RAM 32 ГБ / HDD 2 ТБ + SSD 250 ГБ / nVidia GeForce GTX1060, 6 ГБ / без ОД / LAN / Wi-Fi / без ОС', 1, 0, 1),
(47, 'Dell Alienware Aurora R7', 13, 2, 73999, 1, 'Dell', 'Intel Core i7-8700 (3.2 - 4.6 ГГц) / Alienware Liquid Cooling / Intel Z370 / RAM 32 ГБ / HDD 2 TБ + SSD 256 ГБ / nVidia GeForce GTX 1080, 8 ГБ / DVD ± RW / LAN Killer Networks e2500 / Wi- Fi / Bluetooth / Windows 10 Home / клавіатура + миша', 0, 1, 1),
(48, 'Apple iMac Pro 27', 13, 3, 138599, 1, 'Apple', 'Екран 27 \"IPS (5120 x 2880) LED / Xeon W-2140B (3,2 ГГц (TurboBoost 4,2 ГГц)) / RAM 8 ГБ / HDD 1ТБ / AMD Radeon Pro Vega 56 8Gb / DDR4 / без ОД / LAN / Wi-Fi / Bluetooth / кардрідер / веб-камера / macOS Sierra / 9,7 кг / темно-сірий / клавіатура + миша', 0, 0, 1),
(49, 'Apple MacBook A1534 12', 14, 4, 30899, 1, 'Apple', 'Екран 12 \"IPS Retina (2304x1440) LED, глянцевий / Intel Core M3 (1.2 - 3.0 ГГц) / RAM 8 ГБ / SSD 256 ГБ / Intel HD Graphics 615 / без ОД / Wi-Fi 802.11ac / Bluetooth 4.2 / веб-камера / macOS Sierra / 0.92 кг / сірий космос', 0, 0, 1),
(50, 'Apple MacBook Air 13', 14, 5, 34599, 1, 'Apple', 'Екран 13.3 \"IPS (2560x1600) Retina, глянсовий / Intel Core i5-8210Y (1.6 - 3.6 ГГц) / RAM 8 ГБ / SSD 128 ГБ / Intel UHD Graphics 617 / без ОД / Wi-Fi / Bluetooth / веб-камера / macOS Mojave / 1.25 кг / сріблястий', 0, 0, 1),
(51, 'Acer Predator Triton 500', 14, 6, 80999, 1, 'Acer', 'Екран 15.6 \"IPS (1920x1080) Full HD 144 Гц, матовий / Intel Core i5-8300H (2.3 - 4.0 ГГц) / RAM 16 ГБ / SSD 256 ГБ / nVidia GeForce RTX 2080 144 Гц, 8 ГБ / без ОД / LAN / Wi -Fi / Bluetooth / веб-камера / Windows 10 Home 64bit / 2 кг / чорний', 0, 1, 1),
(52, 'Asus ROG Strix Scar II', 14, 7, 82999, 1, 'Asus', 'Екран 17.3 \"IPS (1920x1080) Full HD 144 Гц, матовий / Intel Core i7-8750H (2.2 - 4.1 ГГц) / RAM 32 ГБ / SSD 512 ГБ / nVidia GeForce RTX 2070 144 Гц, 8 ГБ / без ОД / LAN / Wi -Fi / Bluetooth / веб-камера / без ОС / 2.9 кг / темно-сірий', 0, 0, 1),
(53, 'Dell XPS 13 9380', 14, 8, 46599, 1, 'Dell', 'Екран 13.3 \"(1920x1080) Full HD, глянсовий з покриттям антивідблиску / Intel Core i5-8265U (1.6 - 3.9 ГГц) / RAM 8 ГБ / SSD 256 ГБ / Intel UHD 620 / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 10 Home 64bit / 1.23 кг / сріблястий', 1, 0, 1),
(54, 'MSI GT75 Titan 8RG', 14, 9, 167999, 1, 'MSI', 'Екран 17.3 \"IPS (3840x2160) UHD 4K, матовий / Intel Core i9-8950HK (2.9 - 4.8 ГГц) / RAM 64 ГБ / HDD 1 ТБ + SSD 512 ГБ / nVidia GeForce GTX 1080, 8 ГБ / без ОД / LAN / Wi -Fi / Bluetooth / веб-камера / Windows 10 Home / 4.56 кг / чорний', 1, 1, 1),
(55, 'Lenovo ThinkPad X1 Extreme', 14, 10, 94599, 1, 'Lenovo', 'Екран 15.6 \"IPS (3840x2160) Ultra HD 4K, Multi-touch, глянсовий з покриттям антивідблиску / Intel Core i7-8750H (2.2 - 4.1 ГГц) / RAM 32 ГБ / SSD 512 ГБ / nVidia GeForce GTX 1050 Ti, 4 ГБ / без ОД / Mini RJ45 / Wi-Fi / Bluetooth / веб-камера / Windows 10 Pro 64bit / 1.8 кг / чорний', 0, 1, 1),
(56, 'Asus ROG Swift XG35VQ', 15, 11, 25825, 1, 'Asus', 'Діагональ дисплея: \"35\"\r\n\r\nМаксимальна роздільна здатність дисплея: 3440x1440\r\n\r\nТип матриці: VA\r\n\r\nЧас реакції матриці: 4 мс\r\n\r\nІнтерфейси: DisplayPort, USB, HDMI х 2\r\n\r\nЯскравість дисплея: 300 кд / м²\r\n\r\nКонтрастність дисплея: 1000: 1\r\n\r\nОсобливості: Екран (Pivot), USB-концентратор, Регулювання по висоті, \"Безрамковий\" (Сinema screen), Вигнутий екран, Flicker-Free\r\n\r\nКраїна реєстрації бренду: Тайвань', 0, 0, 1),
(57, 'PNY PCI-Ex NVIDIA Quadro RTX5000 16GB GDDR6 (256bit)', 16, 12, 76825, 1, 'NVIDIA ', 'Графічний чип: Quadro RTX 5000\r\nОбсяг пам\'яті: 16 ГБ\r\nРозрядність шини пам\'яті: 256 біт\r\nТип пам\'яті: GDDR6\r\nТип системи охолодження: Активна\r\nКраїна реєстрації бренду: Тайвань', 0, 0, 1),
(58, 'Intel Core i9-9900KF 3.6GHz/8GT/s/16MB', 17, 13, 16550, 1, 'Intel', 'Сімейство процесора: Intel Core i9/\r\nТип роз\'єму: Socket 1151/\r\nПокоління процесора Intel: Coffee Lake (дев\'ятий)\r\nКількість ядер: 8/\r\nІнтегрована графіка: Немає/\r\nВнутрішня тактова частота: 3600 МГц/\r\nОбсяг кеш пам\'яті 3 рівня: 16 МБ/\r\nКраїна реєстрації бренду: США', 1, 0, 1),
(59, 'Samsung DDR3-1600 16GB PC3-12800', 18, 14, 2875, 1, 'Samsung', 'PC3-12800 ECC Registered (M393B2G70BH0-YK0)', 0, 0, 1),
(60, 'Windows 10 Professional 32/64- (FQC-10071)', 19, 15, 5900, 1, 'Microsoft', 'Розрядність: 32- і 64-розрядні', 1, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
(49, 'Igor', '380988488403', '11724', 5, '2020-03-26 12:29:44', '{\"60\":1,\"59\":1}', 1),
(51, 'Igor', '380988488403', 'Монітор, відеокарта і ноут)', 5, '2020-03-27 13:28:02', '{\"55\":1,\"56\":1,\"57\":1}', 1),
(55, 'Віктор Сташків', '380988488403', 'Win10, intel_i9', 4, '2020-03-27 14:28:01', '{\"60\":1,\"59\":1,\"58\":1}', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'Андрій Кавка', 'andriykavka@mail.com', '111111', ''),
(4, 'Віктор Сташків', 'stashkiv77@gmail.com', '23092010', 'admin'),
(5, 'Igor', 'igorchek@gamail.com', '88888888', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
