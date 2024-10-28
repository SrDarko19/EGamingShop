-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 11:37 PM
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
-- Database: `tienda_online2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token_password` varchar(40) DEFAULT NULL,
  `password_request` tinyint(4) NOT NULL DEFAULT 0,
  `activo` tinyint(4) NOT NULL,
  `fecha_alta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `password`, `nombre`, `email`, `token_password`, `password_request`, `activo`, `fecha_alta`) VALUES
(1, 'admin', '$2y$10$yDkdvFh4ypfOe7oyX8qSQOXw0sVK.0JjJ84p3aHDyH/aqjYfYRNwq', 'Administrador', 'salinas@gmail.com', NULL, 0, 1, '2024-06-06 15:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activo`) VALUES
(1, 'Sandbox', 1),
(2, 'Deportes', 0),
(3, 'Souls', 0),
(4, 'Accion', 1),
(5, 'Aventura', 1),
(6, 'Deportes', 0),
(7, 'Carreras', 0),
(8, 'survival', 1),
(9, 'Estrategia', 1),
(10, 'Terror', 1),
(11, 'Simulador', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `dui` varchar(9) NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modica` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `email`, `telefono`, `dui`, `estatus`, `fecha_alta`, `fecha_modica`, `fecha_baja`) VALUES
(1, 'Alex', 'Salinas', 'salinas221133@gmail.com', '70103691', '123123', 1, '2024-06-11 00:08:29', NULL, NULL),
(2, 'Jose', 'Roberto', 'jovel221133@gmail.com', '70103691', '123', 1, '2024-06-12 19:02:43', NULL, NULL),
(3, 'Alex', 'Salinas', 'salinasjovel221133@gmail.com', '70103691', '2211', 1, '2024-06-12 20:27:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `medio_pago` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`, `medio_pago`) VALUES
(1, '9J258308X51873154', '2024-06-01 23:39:44', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 109.28, NULL),
(2, '74W43515435529442', '2024-06-02 01:12:21', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 112.30, NULL),
(3, '9DL205501C7169442', '2024-06-02 01:13:51', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 112.30, NULL),
(4, '47045572A6164142B', '2024-06-02 01:16:18', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 112.30, NULL),
(5, '2AL05500HD692321K', '2024-06-02 01:19:17', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 112.30, NULL),
(6, '99110083G4874942K', '2024-06-02 02:08:48', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 59.30, NULL),
(7, '9PJ80714SW043235X', '2024-06-02 02:15:02', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 54.30, NULL),
(8, '7DF9630193515113F', '2024-06-02 02:22:03', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 6.30, NULL),
(9, '6WY62640U90227847', '2024-06-02 02:27:43', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 54.30, NULL),
(10, '33T32820KG755910G', '2024-06-02 02:36:41', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 6.30, NULL),
(11, '1XY24943WD4508120', '2024-06-02 05:21:00', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 5.00, NULL),
(12, '25K29740ES9359807', '2024-06-03 02:40:01', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 54.30, NULL),
(13, '3MS385533E9425430', '2024-06-03 02:42:08', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 6.30, NULL),
(14, '962897985N272781T', '2024-06-03 02:52:53', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 5.99, NULL),
(15, '9LH53275GU3738545', '2024-06-03 03:03:47', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 22.99, NULL),
(16, '1LT61318DE017225T', '2024-06-03 03:04:36', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 22.99, NULL),
(17, '9P974833LH0705911', '2024-06-05 05:44:09', 'COMPLETED', 'sb-436yqh30975971@personal.example.com', 'K7MGBLMSPKYAQ', 6.30, NULL),
(18, '20E141175J8959413', '2024-06-06 05:36:34', 'COMPLETED', 'salinas221133@gmail.com', '1', 6.30, NULL),
(19, '2N138995WU8160336', '2024-06-06 05:39:13', 'COMPLETED', 'salinas221133@gmail.com', '1', 59.30, NULL),
(20, '64E35777P0621912N', '2024-06-06 05:41:33', 'COMPLETED', 'luissalinasgamer221133@gmail.com', '17', 53.00, NULL),
(21, '1JU65212Y06267200', '2024-06-06 09:03:40', 'COMPLETED', 'luissalinasgamer221133@gmail.com', '17', 120.27, NULL),
(22, '0T236979RP9157822', '2024-06-06 09:04:26', 'COMPLETED', 'luissalinasgamer221133@gmail.com', '17', 6.30, NULL),
(23, '9X196054KG766972Y', '2024-06-06 11:40:15', 'COMPLETED', 'luissalinasgamer221133@gmail.com', '17', 59.30, NULL),
(24, '56K38285JV545715H', '2024-06-07 21:34:20', 'COMPLETED', 'luissalinasgamer221133@gmail.com', '17', 4.90, NULL),
(25, '1JN431303C885494A', '2024-06-11 08:10:42', 'COMPLETED', 'salinas221133@gmail.com', '1', 44.10, NULL),
(26, '5LB60916B60880611', '2024-06-11 08:11:39', 'COMPLETED', 'salinas221133@gmail.com', '1', 6.30, NULL),
(27, '3UU93579NR8661223', '2024-06-11 08:12:12', 'COMPLETED', 'salinas221133@gmail.com', '1', 17.50, NULL),
(28, '6GS48070CT1663054', '2024-06-12 04:16:25', 'COMPLETED', 'salinas221133@gmail.com', '1', 11.20, NULL),
(29, '62015728XN1854228', '2024-10-26 03:59:09', 'COMPLETED', 'salinas221133@gmail.com', '1', 18.00, NULL),
(30, '122992482L8147218', '2024-10-28 18:30:38', 'COMPLETED', 'salinas221133@gmail.com', '1', 18.00, NULL),
(31, '6BJ57972JD953322N', '2024-10-28 23:34:57', 'COMPLETED', 'salinas221133@gmail.com', '1', 20.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `valor`) VALUES
(1, 'tienda_nombre', 'Mi Tienda EGaming'),
(2, 'correo_email', 'egamingshopsv@gmail.com'),
(3, 'correo_smtp', 'smtp.gmail.com'),
(4, 'correo_password', 'aW2Rp052E1HN+HUF4nCKeA==:Sb388VAWDUqvW7yT2eA2oUkoIfBNgT53gOSqIwnhkfc='),
(5, 'correo_puerto', '465');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'Dark Souls III', 6.30, 1),
(2, 1, 2, 'God of War: Ragnarök', 48.00, 1),
(3, 1, 8, 'ELDEN RING', 31.99, 1),
(4, 1, 7, 'Cyberpunk 2077', 22.99, 1),
(5, 2, 1, 'Dark Souls III', 6.30, 1),
(6, 2, 2, 'God of War: Ragnarök', 48.00, 2),
(7, 2, 3, 'Undertale', 5.00, 2),
(8, 3, 1, 'Dark Souls III', 6.30, 1),
(9, 3, 2, 'God of War: Ragnarök', 48.00, 2),
(10, 3, 3, 'Undertale', 5.00, 2),
(11, 4, 1, 'Dark Souls III', 6.30, 1),
(12, 4, 2, 'God of War: Ragnarök', 48.00, 2),
(13, 4, 3, 'Undertale', 5.00, 2),
(14, 5, 1, 'Dark Souls III', 6.30, 1),
(15, 5, 2, 'God of War: Ragnarök', 48.00, 2),
(16, 5, 3, 'Undertale', 5.00, 2),
(17, 6, 1, 'Dark Souls III', 6.30, 1),
(18, 6, 2, 'God of War: Ragnarök', 48.00, 1),
(19, 6, 3, 'Undertale', 5.00, 1),
(20, 7, 1, 'Dark Souls III', 6.30, 1),
(21, 7, 2, 'God of War: Ragnarök', 48.00, 1),
(22, 8, 1, 'Dark Souls III', 6.30, 1),
(23, 9, 1, 'Dark Souls III', 6.30, 1),
(24, 9, 2, 'God of War: Ragnarök', 48.00, 1),
(25, 10, 1, 'Dark Souls III', 6.30, 1),
(26, 11, 3, 'Undertale', 5.00, 1),
(27, 12, 1, 'Dark Souls III', 6.30, 1),
(28, 12, 2, 'God of War: Ragnarök', 48.00, 1),
(29, 13, 1, 'Dark Souls III', 6.30, 1),
(30, 14, 4, 'Fallout: New Vegas', 5.99, 1),
(31, 15, 7, 'Cyberpunk 2077', 22.99, 1),
(32, 16, 7, 'Cyberpunk 2077', 22.99, 1),
(33, 17, 1, 'Dark Souls III', 6.30, 1),
(34, 18, 1, 'Dark Souls III', 6.30, 1),
(35, 19, 2, 'God of War: Ragnarök', 48.00, 1),
(36, 19, 1, 'Dark Souls III', 6.30, 1),
(37, 19, 3, 'Undertale', 5.00, 1),
(38, 20, 2, 'God of War: Ragnarök', 48.00, 1),
(39, 20, 3, 'Undertale', 5.00, 1),
(40, 21, 1, 'Dark Souls III', 6.30, 1),
(41, 21, 2, 'God of War: Ragnarök', 48.00, 1),
(42, 21, 3, 'Undertale', 5.00, 1),
(43, 21, 8, 'ELDEN RING', 31.99, 1),
(44, 21, 7, 'Cyberpunk 2077', 22.99, 1),
(45, 21, 4, 'Fallout: New Vegas', 5.99, 1),
(46, 22, 1, 'Dark Souls III', 6.30, 1),
(47, 23, 1, 'Dark Souls III', 6.30, 1),
(48, 23, 2, 'God of War: Ragnarök', 48.00, 1),
(49, 23, 3, 'Undertale', 5.00, 1),
(50, 24, 9, 'Terraria', 4.90, 1),
(51, 25, 9, 'Terraria', 4.90, 9),
(52, 26, 1, 'Dark Souls III', 6.30, 1),
(53, 27, 1, 'Dark Souls III', 6.30, 2),
(54, 28, 1, 'Dark Souls III', 6.30, 1),
(55, 28, 9, 'Terraria', 4.90, 1),
(56, 29, 18, 'Asterix & Obelix XXL: Romastered', 18.00, 1),
(57, 30, 18, 'Asterix & Obelix XXL: Romastered', 18.00, 1),
(58, 31, 26, ' Degrees of Separation', 20.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `genero` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `Llave` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `genero`, `precio`, `descuento`, `stock`, `id_categoria`, `activo`, `Llave`) VALUES
(2, 'God of War: Ragnarök', '<p>Kratos y Atreus deben viajar a cada uno de los Nueve Reinos en busca de respuestas mientras las fuerzas asgardianas se preparan para la batalla profetizada que supondrá el fin del mundo. Por el camino, explorarán paisajes míticos increíbles y se enfrentarán a temibles enemigos, como monstruos y dioses nórdicos.</p>', '', 60.00, 20, 0, 5, 0, ''),
(3, 'Undertale', '<p>\"Hace tiempo, dos razas gobernaron la Tierra: Monstruos y Humanos. Un dia, una guerra se desato entre las dos razas. Tras una larga batalla, los humanos fueron victoriosos. Sellaron a los monstruos bajo tierra con un hechizo mágico.\" Undertale cuenta la historia de Frisk, un niño (de género indefinido) que escala el Monte Ebott, un lugar del que se cuenta que quienes lo escalan, nunca vuelven, y como este cae accidentalmente en el, llegando al Underground, lugar en el que habitan los monstruos, ahora Frisk debera atravesar el lugar buscando una manera de salir, descubriendo la historia de los monstruos y conociéndolos, haciéndose amigos de ellos y terminando la guerra ente humanos y monstruos y ayudando a los monstruos a escapar del Underground. El juego contiene 3 finales, un final o ruta neutral, una ruta pacifista verdadera y una ruta genocida.</p>', '', 5.00, 0, 10, 5, 0, ''),
(4, 'Fallout: New Vegas', '<p>El juego mete al jugador en la piel de un mensajero,9​ perteneciente a la empresa Mojave Express. Su misión: transportar un paquete al enigmático Sr. House, líder de New Vegas. Durante su viaje, es asaltado por un grupo de mercenarios liderados por un misterioso personaje, el cual, le roba el contenido del paquete: un chip de platino con forma de ficha de póker. Tiroteado mortalmente y enterrado el mensajero es rescatado milagrosamente por un robot llamado Víctor, que lo traslada hasta la casa del Dr. Mitchell, en Goodsprings, donde este logra curarle sus graves heridas. Una vez recuperado, el mismo doctor le entrega su viejo Pip-Boy 3000 y un antiguo mono de trabajo del refugio 21 para que pueda iniciar la persecución de los que casi acabaron con su vida. A lo largo de la aventura, el jugador, descubrirá que Robert House, magnate de antes de la guerra, logró proteger a Las Vegas de 77 cabezas nucleares durante la \"Gran Guerra\", y por ello considera a Nueva Vegas como \"su\" ciudad, dirigiendo su imperio desde el misterioso casino Lucky 38, donde ningún humano ha entrado desde 2077. El Mensajero también descubriría las tensiones entre diversas facciones del Yermo, incluyendo a la República de Nueva California, la Hermandad del Acero, los Seguidores del Apocalipsis (Una facción neutral, que busca ofrecer auxilio a los más necesitados) y la Legión del César entre otras.</p>', '', 5.99, 0, 0, 4, 0, ''),
(5, 'Cyberpunk 2077', '<p>En el juego el jugador será arrojado a este oscuro futuro. La metrópolis de Night City es un lugar creado para contarnos la historia de un individuo que creció en sus calles y que trata de levantarse y encontrar un modo de sobrevivir entre las mafias locales y las megacorporaciones, en una ciudad de suciedad y decadencia. Drogas, violencia, pobreza y exclusión no han desaparecido en el año 2077 y la gente ha seguido estando como lo era hace siglos, egoísta, de mente cerrada y débil. Pero no sólo los fantasmas del pasado preocupan a la humanidad, sino que nuevos problemas han aparecido. Los psicópatas se acumulan, y las calles están llenas de adictos a una nueva forma de entretenimiento: el Braindance, una forma barata de experimentar las emociones y el estímulo de otras personas que viven una vida más emocionante.</p>', '', 22.99, 0, 10, 4, 0, ''),
(6, 'ELDEN RING', '<p>Álzate, Sinluz, y que la gracia te guíe para abrazar el poder del Círculo de Elden y encumbrarte como señor del Círculo en las Tierras Intermedias. En las Tierras Intermedias gobernadas por la Reina Márika, la Eterna, el Círculo de Elden, origen del Árbol Áureo, ha sido destruido. Los descendientes de Márika, todos semidioses, reclamaron los fragmentos del Círculo de Elden conocidos como Grandes Runas. Fue entonces cuando la demencial corrupción de su renovada fuerza provocó una guerra: la Devastación. Una guerra que supuso el abandono de la Voluntad Mayor. Y ahora, la gracia que nos guía recaerá sobre el Sinluz desdeñado por la gracia del oro y exiliado de las Tierras Intermedias. Tú que has muerto, pero vives, con tu gracia tiempo ha perdida, recorre la senda hacia las Tierras Intermedias más allá del neblinoso mar para postrarte ante el Círculo de Elden.</p>', '', 31.99, 0, 0, 3, 0, ''),
(9, 'Terraria', '<p>¡Cava, lucha, explora, construye! Con este juego de aventuras repleto de acción nada es imposible. ¡Pack de Cuatro también disponible!</p>', '', 5.00, 2, 999, 8, 0, ''),
(16, 'Grand Theft Auto V', '<p>Grand Theft Auto V for PC offers players the option to explore the award-winning world of Los Santos and Blaine County in resolutions of up to 4k and beyond, as well as the chance to experience the game running at 60 frames per second.</p>', '', 30.00, 10, 10, 1, 0, ''),
(17, 'Forza Horizon 5', '<p>Explore the vibrant open world landscapes of Mexico with limitless, fun driving action in the world’s greatest cars. Blast off into Forza Horizon 5: Hot Wheels or Conquer the Sierra Nueva in the ultimate Horizon Rally Adventure experience. Requires Forza Horizon 5 game, expansion sold separately</p>', '', 32.00, 50, 190, 7, 0, ''),
(18, 'Asterix & Obelix XXL: Romastered', '<p>Nos situamos 50 años antes de Jesucristo. Toda la Galia está ocupada por los romanos… ¿Toda? ¡No! Una pequeña aldea poblada por irreductibles galos resiste, todavía y como siempre, al invasor. Y la vida no es fácil para las guarniciones de legionarios romanos de campamentos atrincherados de Babaorum, Aquarium, Laudanum y Petibonum.<br><br>La paz reina en la pequeña aldea de Armórica, donde los aldeanos atienden sus ocupaciones habituales. Nuestros dos héroes, Astérix y Obélix, cazan jabalíes; el herrero y el pescadero discuten y el jefe de la aldea, encaramado a su escudo, se pasea por la plaza de la aldea.<br><br>Pero, un buen día, volviendo de una jornada de caza, Astérix y Obélix encuentran su aldea en llamas, saqueada por los romanos. Astérix y Obélix parten al rescate de los aldeanos, acompañados por su fiel Ideafix. En su periplo, recorrerán Normandía, Grecia, Helvecia, Egipto y, por último, Roma, con el fin de salvar a los aldeanos de las garras del emperador César...<br><br>¡Redescubre la primera aventura XXL de tus galos favoritos en esta versión totalmente romasterizada!<br><br>Alterna entre Astérix y Obélix, y recorre diferentes regiones del mundo, como Grecia o Egipto, para liberar a Karabella, Falbalá, Panorámix y los demás galos de la aldea.<br><br>¡Lucha contra todos los romanos, piratas o vikingos que se atrevan a cruzarse en tu camino! Con ayuda de la poción mágica, no habrá nada que pueda detenerte.<br><br>La guinda sobre el jabalí es que hay 4&nbsp;NUEVOS MODOS DE JUEGO:<br>- Modo Retro: Podrás volver a los gráficos del juego original en todo momento. ¡Para los nostálgicos del año 50 a. C.!<br><br>- Modo Recorridos: Recupera todas las monedas desperdigadas dentro del tiempo establecido. Salta, gira, corre... Y no olvides activar el modo Retro de vez en cuando, ya que algunas monedas están escondidas a conciencia.<br><br>- Modo Contrarreloj: ¡Cruza la línea de meta lo más rápido posible! Como dicen los druidas: «Muérdago que no vuela, acaba en la cazuela». Por si no ha quedado claro... ¡¡Corre!! Atención: Encontrarás obstáculos en tu camino.<br><br>- Modo Extremo: ¡Romanos más fuertes y numerosos para aumentar la dificultad al máximo! ¿Estarás a la altura de este modo, digno de los más grandes guerreros galos?</p><p>&nbsp;</p><p><strong>Para mayores de 10 años</strong></p>', '', 20.00, 10, 1, 5, 1, 'YZQMP-29AIX-CEF6C'),
(19, 'Paleon', '<p>Tu máquina del tiempo está rota. Y parece que estás atrapado en el pasado. ¡Intenta crear tu propia civilización y regresa a casa!<br><strong>Características clave:</strong><br>Guía tu asentamiento desde la edad de piedra hasta las edades tardías.</p><p><br>Cazar, fabricar herramientas útiles, criar animales, plantar cultivos.</p><p><br>Organizar la producción de los repuestos necesarios para la construcción de una nueva máquina del tiempo.<br>Comercio con caravanas</p><p><strong>Para mayores de 10 años</strong></p>', '', 6.00, 0, 1, 1, 1, '9Q4V5-R5DL9-WZT77'),
(20, 'Flashback', '<p>Música para la memoria clonada, un álbum tributo al flashback<br>Escuche música para Cloned Memory, un álbum tributo al flashback</p><p><strong>Acerca de este juego</strong><br>2142. Tras huir de una nave espacial pero despojado de todo recuerdo, el joven científico Conrad B. Hart despierta en Titán, una luna colonizada del planeta Saturno. Sus enemigos y secuestradores le pisan los talones. Debe encontrar un camino de regreso a la Tierra, defendiéndose de los peligros que encuentra y desentrañando un insidioso complot extraterrestre que amenaza al planeta...</p><p>¡En su 25º aniversario, redescubre este clásico, constantemente clasificado entre los 100 mejores juegos de todos los tiempos! Fue uno de los primeros juegos en utilizar tecnología de captura de movimiento para animaciones más realistas, con fondos completamente dibujados a mano y una apasionante historia de ciencia ficción.</p><p><strong>Además del juego original de 1993, esta versión incluye un modo Moderno, con:</strong></p><p>- Filtros gráficos post-FX,<br>- Sonido y música completamente remasterizados,<br>- Una nueva función \"Rebobinar\", variable según el nivel de dificultad<br>- Tutoriales para aquellos que necesitan un impulso.</p><p><strong>Para mayores de 10 años</strong></p>', '', 10.00, 0, 1, 4, 1, 'CLT9T-WTQ9Y-FB6ZT'),
(21, 'I am not a Monster First Contact', '<h2>About This Game</h2><p>A thrilling sci-fi story.<br><br>The Albatross spaceship has been taken over by unknown alien lizards. But no monster can escape the unwavering hand of Captain Laser!<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/826600/extras/GIF_1.gif?t=1729766370\" width=\"600\" height=\"338\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/826600/extras/features_eng.png?t=1729766370\" width=\"600\" height=\"64\"><br><br>&nbsp;</p><ul><li>Over 30 different missions<br>&nbsp;</li><li>8 unique heroes<br>&nbsp;</li><li>Control multiple heroes at the same time<br>&nbsp;</li><li>Save passengers and discover the secret of the monsters\' sudden appearance</li></ul><p><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/826600/extras/characters_eng.png?t=1729766370\" width=\"600\" height=\"618\"></p><p><strong>Juego para mayores de 18 años</strong></p>', '', 8.00, 75, 1, 9, 1, 'IRF06-72Q25-L8FMD'),
(22, 'Onde', '<h2>Acerca sobre este juego</h2><p>Sumérgete en un mundo lleno de sonidos. Deja que las melodías etéreas te lleven con fluidez a través de paisajes abstractos.</p><p>Aprende a crear y seguir caminos efímeros de sonido y luz. Siga a sus caprichosos compañeros a través de un mundo delicado que cambia desde líneas claras hasta remolinos de color, desde explosiones de notas cristalinas hasta relajantes esferas sonoras. Sintoniza los paisajes sonoros que te rodean y siente cómo el mundo cobra vida con maravillas.</p><p>Confía en el ciclo, resuena con el flujo y asciende a lo que aún está por llegar.</p><p>&nbsp;</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1676910/extras/ONDE-Steam-GIF01.gif?t=1728902524\" width=\"616\" height=\"213\"></p><p><strong>Características clave</strong></p><p>Plataformas de rompecabezas fluidas e intuitivas: crea caminos efímeros a lo largo de ondas de sonido y luz para seguir tu vocación<br>Paisajes sonoros etéreos y adaptables: emite sonidos relajantes mientras navegas por entornos melódicos<br>Experiencia meditativa: el movimiento orgánico, la jugabilidad fluida y los sonidos relajantes crean un viaje similar al Zen.<br>Un mundo lleno de maravillas: desde el océano más profundo hasta las profundidades del espacio, explora múltiples áreas a lo largo de tu camino, cada una con imágenes y mecánicas de rompecabezas únicas.<br>Elegante obra de arte abstracta: un mundo sereno que cambia de líneas claras a remolinos de color durante este viaje de la vida.</p><p>&nbsp;</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1676910/extras/ONDE-Steam-GIF06.gif?t=1728902524\" width=\"616\" height=\"213\"></p><p><strong>Historia</strong></p><p>En lo profundo de la quietud de las cuevas subterráneas talladas en rocas y cristal, alejadas del mundo, hay un caparazón vacío. Sin embargo, la vida encuentra su camino a través de la oscuridad y, al llenar el caparazón, genera una luz. Con la luz llega un sonido y las ondas de esta comunión se propagan en todas direcciones.</p><p>Un nuevo ser parte y sigue su ejemplo para descubrir un mundo de maravillas y presenciar la vida que se desarrolla en su camino.</p><p>¿Atravesará la pequeña criatura los espacios oscuros para descubrir que es la oscuridad la que hace que la luz realmente brille?</p><p>&nbsp;</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1676910/extras/ONDE-Steam-GIF03.gif?t=1728902524\" width=\"616\" height=\"213\"></p><p><strong>Para todas las edades</strong></p>', '', 8.00, 75, 1, 5, 1, 'Y42C6-AETDC-XXQT0'),
(23, 'ENCODYA', '<h2>Acerca de este juego</h2><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1137450/extras/Savetheworld_Banner_Encodya.jpg?t=1728899266\" width=\"616\" height=\"80\"></p><p><strong>La edición Save the World incluye ENCODYA</strong>, la banda sonora oficial de ENCODYA, un libro de arte diseñado con mucho cariño, fondos de pantalla y un vídeo sobre cómo se hizo. Además, Assemble Entertainment dona el 10% de los ingresos de esta edición a la organización benéfica infantil Plan International. Esta es la mejor opción para todos aquellos que quieran apoyar aún más el trabajo del desarrollador de ENCODYA y hacer algo bueno al mismo tiempo.</p><p>&nbsp;</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1137450/extras/ENCODYA_banner_steamdesc.png?t=1728899266\" width=\"616\" height=\"154\"></p><p>Neo Berlín 2062. Tina, una niña huérfana de nueve años, vive con SAM-53, su gran y torpe robot guardián, en un refugio improvisado en la azotea de Neo-Berlín, una oscura megalópolis controlada por corporaciones. Tina es una niña de la jungla urbana que ha aprendido a vivir sola, hurgando en los contenedores de basura de la ciudad y ganándose la vida a duras penas con las sobras. Su divertido robot está siempre con ella, programado para protegerla pase lo que pase.</p><p>&nbsp;</p><p>Un día, la pequeña descubre que su padre le dejó una misión importante: ¡terminar su plan para salvar al mundo de la oscuridad! Tina y SAM se embarcan en una increíble aventura a través de diferentes realidades llenas de extrañas criaturas robóticas y grotescos seres humanos. A través de acertijos y diálogos emocionantes, descubrirán el verdadero significado de estar vivo.</p><p>&nbsp;</p><p><strong>Para mayores de 10 años</strong></p>', '', 1.00, 0, 1, 5, 1, '0HLPW-BYYIT-CGZTR'),
(24, 'Terror At Oakheart', '<h2>Acerca de este juego</h2><p>Las famosas películas de terror de los años 80 y 90 sirven como fuente de inspiración para Terror at Oakheart. La comunidad de Oakheart ha sido aterrorizada por Teddy, un asesino en serie enmascarado. A medida que aumenta el número de cadáveres, descubres que aquí sucede algo más que un hombre enmascarado matando a adolescentes indefensos.</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/2530430/extras/SteamDesciptionBanner_1.png?t=1729065824\" width=\"616\" height=\"200\"></p><p>El juego de desplazamiento lateral basado en píxeles Terror At Oakheart tiene como objetivo replicar la experiencia de ver una película de terror de los 80. Jugarás con una variedad de personajes a lo largo del juego, y todos ellos morirán horriblemente a manos de Teddy, un asesino en serie psicótico que está bajo el dominio de una bestia lovecraftiana. Te moverás a través de una serie de escenarios en la ciudad de Oakheart, como la casa de Teddy, la estación de policía cercana, una estación de guardabosques, áreas de campamento y más.</p><p>¡Descubre la verdad y lucha por sobrevivir en este exclusivo juego de terror basado en píxeles lleno de sangre espantosa y sustos espantosos!</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/2530430/extras/SteamDesciptionBanner_3.png?t=1729065824\" width=\"616\" height=\"200\"></p><p><strong>Juega como un elenco de personajes que se enfrentan a Teddy. ¿Quién sobrevivirá y quién morirá de las formas más horribles?</strong></p><h2>Descripción del contenido para adultos</h2><p>Los desarrolladores describen el contenido así:</p><p>El juego contiene escenas que no son adecuadas para un público más joven, p. Atmósfera de terror/miedo, así como escenas sangrientas y sangrientas en estilo fantasía/pixel art.</p><p><strong>Para mayores de 18 años</strong></p>', '', 5.00, 30, 1, 10, 1, 'Z3T3Q-P6Z39-EGAY9'),
(25, 'Alfred Hitchcock - Vertigo', '<h2>Acerca de este juego</h2><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1449320/extras/vertigo_GIF_01.gif?t=1722241980\" width=\"600\" height=\"194\"><br><br>Ed Miller, un escritor, salió ileso de su accidente automovilístico en Brody Canyon, California.<br>Aunque no se encontró a nadie dentro de los restos del coche, Ed insiste en que viajaba con su esposa y su hija. Traumatizado por el suceso, comienza a sufrir un severo vértigo. Al iniciar la terapia, intentará descubrir qué sucedió realmente ese trágico día.</p><p>Prepárate para una investigación de lo más inquietante dentro de la mente humana: la verdad a veces es peor que la locura.<br><strong>Características:</strong><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1449320/extras/vertigo_GIF_02.gif?t=1722241980\" width=\"600\" height=\"194\"><br><br>&nbsp;</p><p>Una historia original sobre la obsesión, la manipulación y la locura, inspirada en la obra maestra de Alfred Hitchcock, Vértigo.<br>Vive una poderosa experiencia narrativa rindiendo homenaje a las técnicas visuales y narrativas del género thriller.<br>Investiga a través de la visión de tres personajes: cada uno tiene una historia diferente que contar.</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1449320/extras/vertigo_GIF_03.gif?t=1722241980\" width=\"600\" height=\"194\"><br>&nbsp;</p><ul><li><strong>Explora varias líneas de tiempo para cotejar los eventos y separar la realidad de los recuerdos engañosos.</strong><br><strong>Desarrollado por el galardonado estudio de juegos de aventuras Pendulo Studios.</strong></li></ul><h2>Descripción del contenido para adultos</h2><p>Los desarrolladores describen el contenido así:</p><p>Incluye contenido para adultos: descripción de crímenes, suicidio, drogas.</p><p><strong>Para mayores de 18 años</strong></p>', '', 20.00, 0, 1, 5, 1, 'JQMN4-BN702-0RNZP'),
(26, ' Degrees of Separation', '<h2>Acerca de este juego</h2><p>&nbsp;</p><p><br><br>Degrees of Separation es un juego de aventuras y rompecabezas en 2D que requiere que los jugadores aprovechen los elementos del calor y el frío para tener éxito. Dos almas contrastantes, Ember y Rime, están separadas por una fuerza enigmática y deben usar sus respectivos poderes para progresar a través de un espectacular mundo de fantasía y aventuras. Los jugadores asumen los roles de Ember y Rime en el modo para un jugador y en el modo multijugador cooperativo para resolver los obstáculos ambientales del juego, aprovechando sus habilidades únicas para atravesar hermosos entornos llenos de rompecabezas. Los dos aprenderán a apoyarse el uno en el otro, y sus fuerzas individuales trabajarán para acercarlos... o separarlos.&nbsp;</p><p><strong>Para mayores de 10 años</strong></p>', '', 20.00, 0, 1, 5, 1, '2HLBT-ID5KZ-KE4BH'),
(27, 'The Wanderer Frankenstein’s Creature', '<h2>Acerca de este juego</h2><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/966670/extras/A_fresh_look_at_the_myth_of_Frankenstein.png?t=1727788287\" width=\"616\" height=\"132\"></p><p><br>Juega como la Criatura, un vagabundo sin memoria ni pasado, un espíritu virgen en un cuerpo completamente fabricado. Para forjar el destino de este ser artificial que ignora tanto el Bien como el Mal, tendrás que explorar el vasto mundo y experimentar alegría y tristeza.<br>El mito fundacional del Dr. Frankenstein se revela una vez más en todo su esplendor a través de los ojos inocentes de su criatura. A mil kilómetros de las historias de terror, aquí hay un paseo sensible en la piel de un ícono del pop.<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/966670/extras/festum_gif.gif?t=1727788287\" width=\"616\" height=\"347\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/966670/extras/A_breathtaking_artistic_direction.png?t=1727788287\" width=\"616\" height=\"132\"><br>Imbuido de un oscuro romanticismo, el universo del juego extrae su asombrosa belleza de las pinturas del siglo XIX. A través de paisajes en evolución, la frontera entre realidad y ficción se desvanece y la novela cobra vida. Potente y original, la banda sonora resalta los sentimientos de pasión por los viajes de la Criatura.<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/966670/extras/The_Wanderer_Drink_GIF.gif?t=1727788287\" width=\"616\" height=\"347\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/966670/extras/Explore_your_emotions_and_write_your_story.png?t=1727788287\" width=\"616\" height=\"132\"><br>Una elección tras otra, siente el camino hacia tu destino. Frente a los humanos, ya no podrás escapar a la cuestión de tus orígenes. ¿Quién te dio la vida? Esta búsqueda introspectiva te llevará a una aventura por toda Europa. Amargas o placenteras, tus experiencias te acercarán a la verdad. ¿Estarás preparado para afrontarlo?</p><p>The Wanderer: Frankenstein\'s Creature is the new video game from La Belle Games, co-produced and published by ARTE, the European television and digital cultural channel.</p><p><strong>Para mayores de 10 años</strong></p>', '', 15.00, 25, 1, 5, 1, '7GYC2-7TQJZ-L96CQ'),
(28, 'The Hive', '<h2>Acerca de este juego</h2><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/325730/extras/SteamCrab03a.gif?t=1685111651\" width=\"616\" height=\"348\"></p><h2>Game setting</h2><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/325730/extras/divider.png?t=1685111651\" width=\"596\" height=\"10\"><br><br>The Hive es un juego de rol de estrategia en tiempo real para un jugador en el que asumes el control de la mente de la colmena insectoide y exploras el vasto inframundo en tu viaje a la superficie.</p><p>El énfasis del juego está en la exploración, el descubrimiento y la narración de historias a través del estilo de juego RTS.<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/325730/extras/waterfall01a.gif?t=1685111651\" width=\"600\" height=\"220\"></p><h2>Features</h2><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/325730/extras/divider.png?t=1685111651\" width=\"596\" height=\"10\"></p><ul><li>Asume el control como la mente de Insectoid Hive. Explora un hermoso, vasto y arruinado inframundo plagado de peligros y civilizaciones perdidas.</li><li>Construye tu propio nido subterráneo y fuerzas para derrotar a enormes criaturas antiguas.</li><li>Derrota enemigos y disuelve su ADN para desbloquear nuevas unidades y habilidades.</li><li>Equipa a tus criaturas con reliquias extraídas de las ruinas de civilizaciones perdidas hace mucho tiempo.<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/325730/extras/puzzlebox.gif?t=1685111651\" width=\"600\" height=\"220\"><br><br>&nbsp;</li><li>Experimenta una historia épica que se extiende por el vasto inframundo de New Eden.</li><li>Crea estrategias para alcanzar la victoria en 10 niveles diferentes y aproximadamente entre 10 y 12 horas de juego.</li><li>La calmante serenidad de los manantiales en flor, el calor agresivo de los volcanes y las ruinas que guardan la historia de una historia triste conforman el mundo de Hive.</li></ul><p><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/325730/extras/fish01a.gif?t=1685111651\" width=\"600\" height=\"220\"></p><p><strong>para mayores de 10 años</strong></p>', '', 15.00, 25, 1, 9, 1, '94PXN-9XT2B-VW7HH'),
(29, 'Cats in Time', '<h2>Acerca de este juego</h2><p>¡Hola exploradores!<br>Mi nombre es Profesor Tim Edger, soy el inventor de la máquina del tiempo y un ávido amante de los gatos. Lamentablemente tengo un problema y tal vez TÚ puedas ayudarme.<br>Verás, mis amados gatos están desaparecidos. Mientras jugaban en el laboratorio, activaron mi máquina del tiempo y ⚡ZAP ⚡, ¡ahora están perdidos en el espacio y el tiempo! Tienes que viajar desde el antiguo Egipto hasta las calles de la Nueva York de finales del siglo XX e incluso más allá del presente, hasta el futuro Tokio.<br>¡Tu objetivo es encontrar todos los gatos! Por favor tenga cuidado; Estos gatos son muy buenos escondiéndose.<br>&nbsp;</p><ul><li><h2>NIVELES 3D HERMOSAMENTE DISEÑADOS</h2><p>Escápese a 30 ubicaciones distintivas ambientadas en siete épocas diferentes.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1599880/extras/rotation2.gif?t=1724666519\" width=\"600\" height=\"200\"><br>&nbsp;</p></li><li><h2>ROMPECABEZAS TÁCTILES</h2><p>Resuelve asombrosos acertijos y acertijos para salvar a todos los gatos atrapados.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1599880/extras/catsSteampage_2.gif?t=1724666519\" width=\"600\" height=\"200\"><br>&nbsp;</p></li><li><h2>GATOS LINDO</h2><p>Salva a casi 300 gatos escondidos en los lugares más insólitos.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1599880/extras/catsSteampage_4.gif?t=1724666519\" width=\"600\" height=\"200\"><br>&nbsp;</p></li><li><h2>VERSIÓN ÚLTIMA</h2><p>¡La versión Steam también es la versión definitiva del juego y presenta nuevos niveles, gráficos 3D más detallados, nuevos controles, soporte de pantalla panorámica, contenido adicional y algunas sorpresas!<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1599880/extras/underwater1.gif?t=1724666519\" width=\"599\" height=\"199\"><br>&nbsp;</p></li><li><h2>BANDA SONORA RELAJANTE</h2></li><li>Escuche los sonidos relajantes de la época mientras explora.</li><li><p>¡Tómate tu tiempo (je) y disfruta del viaje!<br>Profesor Tim E.</p><p><strong>Para mayores de 10 años</strong></p></li></ul>', '', 1.00, 0, 1, 9, 1, 'NYRC6-YKZXD-DYLN5'),
(30, 'Grand Mountain Adventure Wonderlands', '<h2>Acerca de este juego</h2><p>Grand Mountain Adventure: Wonderlands te permite explorar libremente y a tu ritmo estaciones de esquí enteras y las montañas circundantes. Desbloquea remontes y llega a nuevas áreas compitiendo en desafíos, o disfruta del paisaje mientras encuentras tu propio camino hacia las montañas. ¿Te apetece divertirte con tus amigos? Continúa y juega en modo multijugador local hasta 4 jugadores. ¡La elección es tuya!</p><h2>Exploración:</h2><p>Ponte los esquís o la tabla y explora 12 enormes estaciones de esquí de mundo abierto. Descubra áreas rurales polvorientas, bosques profundos con vida silvestre, laderas concurridas, acantilados escarpados, picos altos y acogedores pueblos de montaña.<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1247360/extras/welcome.gif?t=1721222041\" width=\"600\" height=\"194\"></p><h2>Desafíos:</h2><p>Compite en Super G, Slopestyle, Big Air y muchas otras disciplinas. Busca desafíos ocultos y pruebas secretas fuera de las pistas. ¡Colecciona pases de esquí desde el principio, los coleccionables del juego!<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1247360/extras/Challenge.gif?t=1721222041\" width=\"600\" height=\"194\"></p><h2>Multijugador:</h2><p>Juega en modo multijugador local para hasta 4 jugadores. Corred hasta la meta, derribaos unos a otros con bolas de nieve o navegad juntos por las montañas.<br>Siéntete libre de explorar la montaña juntos.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1247360/extras/multi.gif?t=1721222041\" width=\"600\" height=\"194\"></p><h2>Modo ZEN:</h2><p>ZEN MODE se trata de tener un momento de tranquilidad y regeneración para ti mismo. ¡Se eliminan todos los desafíos, coleccionables de pruebas e incluso NPC!<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1247360/extras/zen.gif?t=1721222041\" width=\"600\" height=\"194\"></p><p><strong>Para todas las edades</strong></p>', '', 15.00, 25, 1, 5, 1, 'VZTPI-3ICYC-DF0M2'),
(31, ' NEXT JUMP: Shmup Tactics', '<h2>Acerca de este juego</h2><p><strong>NEXT JUMP </strong>es una carta de amor a shmup [Shoot \'em up o space shooters], leída de una manera ligeramente diferente: ¡en batallas por turnos!<br>Tu misión, nuestra misión, es simple:<br>Los dragones huyen con todo nuestro suministro de Elixir. ¡Detenlos!<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/624690/extras/Features.png?t=1729207985\" width=\"632\" height=\"95\"><br>&nbsp;</p><ul><li>Es un SHMUP de tácticas: ¡tómate tu tiempo y planifica tus movimientos!</li><li>Un excelente juego de pausa para el café: por turnos con una jugabilidad rápida. ¡No hay que esperar mucho, estos turnos pasan rápido!</li><li>No solo está inspirado en los clásicos Shmups y Bullet Hells, sino que también está influenciado por juegos tácticos como Final Fantasy Tactics, Jeanne d\'Arc y Roguelikes como FTL y Crypt of the NecroDancer.</li><li>¡Cada Sector es una Junta! ¡Cada “JUMP” representa un nuevo tablero de combate generado procedimentalmente, que simula situaciones de combate que solo se ven en SHMUP!</li><li>Elige entre 7 barcos jugables, todos inspirados en armas clásicas: balista, daga, martillo, bastón, espada, escudo y uno secreto.</li><li>¡Equipa y mejora tu nave con diferentes armas y accesorios que cambian la dinámica del combate!</li><li>Tu misión: ¡SALTA! ¡Persigue a los dragones y evita que se escapen con todo lo que es más sagrado para los Bastardos saltando de sector en sector, enfrentándote a hordas de enemigos en batallas por turnos!</li><li>Sé piloto de la Federación de Bastardos: Un grupo formado por Elfos, Humanos, Enanos y Orcos que solían vivir en paz, compartiendo su amor por todas las Bebidas.</li><li>Como los juegos clásicos del pasado, tiene un MANUAL completo, ¡accesible dentro del juego!</li></ul><p>&nbsp;</p><p><strong>Para todas las edades</strong></p>', '', 1.00, 50, 1, 4, 1, 'I6VKF-FCEXL-0YX53'),
(32, 'Toki', '<h2>Acerca de este juego</h2><p><strong>¡El regreso del mono loco!</strong><br><br>¡Toki emprende una nueva aventura! ¡El juego de acción y plataformas de culto lanzado originalmente para máquinas recreativas en 1989 está de regreso con una nueva versión supersimia, con gráficos completamente nuevos dibujados a mano y música reorquestada!</p><p>El guerrero Toki vivía pacíficamente en la jungla con su amada Miho. ¡Apareciendo de la nada, el aterrador hechicero vudú Vookimedlo y el atroz demonio Bashtar secuestran a Miho y convierten al pobre Toki en un chimpancé! Desafortunadamente para su amada, se ha convertido en un simio peludo y letárgico...<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1058320/extras/TOKI_anim01.png?t=1654849414\" width=\"625\" height=\"205\"><br><br><strong>Redescubre Toki 30 años después:</strong><br><br>¡Jugando como Toki, explora entornos exuberantes invadidos por criaturas repugnantes!<br>El Laberinto, el Lago Neptuno, la Cueva del Fuego, el Palacio de Hielo, la Selva de las Tinieblas y el Palacio Dorado están infestados de lacayos de Vookimedlo. ¡Salvar a Miho no será fácil! Estos seres despreciables y aterradores tienen nombres amigables como Boloragog, Rambacha, Mogulvar, Zorzamoth y Bashtar... ¡Y si el aspecto de Toki sirve de algo, no será un paseo por el parque!</p><p>Tendrás que aprovecharlo al máximo para tener éxito. ¡Afortunadamente, Toki puede caminar, saltar, nadar, trepar y escupir! Así es, utiliza su saliva con gran efecto para deshacerse de sus enemigos...<br><br><strong>Asciende a la dificultad legendaria de la Edad de Oro de los videojuegos:</strong><br><br>\"Inserta moneda\"... ¿Recuerdas haber gastado todo el bolsillo que tanto te costó ganar en las máquinas recreativas para completar tus juegos favoritos? Ahora puedes disfrutar del mismo juego desafiante sin tener que gastar mucho dinero. ¡Pon tu nombre en la parte superior de la tabla de puntuación más alta!<br>Los jugadores novatos también pueden disfrutar del juego con un nuevo modo más fácil.<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1058320/extras/Toki_anim02.png?t=1654849414\" width=\"625\" height=\"205\"><br><br><strong>Un remake magistralmente realizado:</strong><br><br>El juego ha sido rediseñado íntegramente a mano por Philippe Dessoly, ilustrador de conocidos dibujos animados manga, como Captain Harlock y UFO Robot Grendizer, cómics y videojuegos. También trabajó en la versión Amiga de Toki en 1991 y en el juego Mr. Nutz en 1992. Sus dibujos han mejorado aún más la apariencia simiesca de Toki.</p><p>La música ha sido completamente reorquestada por el compositor Raphaël Gesqua, proporcionando una banda sonora retro y moderna para la aventura de Toki. Este galardonado compositor ha creado la música de más de cien videojuegos.</p><p>En el aspecto técnico, el desarrollador Pierre Adane ha trabajado incansablemente para dar vida a esta emocionante experiencia. También trabajó en Mr. Nutz (1992) y creó el juego de tenis Top Spin (2003).<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1058320/extras/toki_anim03.png?t=1654849414\" width=\"625\" height=\"205\"></p><p>&nbsp;</p><p><strong>Para mayores de 15 años</strong></p>', '', 20.00, 50, 1, 5, 1, '6M38Z-L7M69-WW5I4'),
(33, ' Just Ignore Them', '<p>Una noche puede parecer toda una vida de dolor, sufrimiento y horror para un niño... ¿Tienes lo necesario para sobrevivir esa noche? Juega como un niño de 8 años atormentado por monstruos en su casa. Tus elecciones marcan su futuro, cuyas vidas pueden salvarse o terminarse.</p><p><strong>para mayores de 15 años</strong></p>', '', 1.00, 75, 1, 10, 1, 'A78MM-GF93Z-8C944'),
(34, 'Tabletop Playground', '<h2>Acerca de este juego</h2><p>Experimente los juegos de mesa digitales como nunca antes con física realista y controles satisfactorios. Recrea y modifica juegos clásicos o crea los tuyos propios y compártelos con el mundo a través de mod.io, perfectamente integrado a través de tu cuenta de Steam. Puedes explorar y descargar las modificaciones disponibles desde el juego, u obtener una modificación que aún no tienes antes de unirte a un juego con solo presionar un botón.<br>Utilice herramientas especializadas para jugar juegos complejos y especializados con hasta 16 jugadores en PC y realidad virtual. Prepárate para la experiencia de juego de mesa definitiva con Tabletop Playground.</p><h2>Multijugador de 16 jugadores</h2><p><br>Juega solo o con hasta 16 jugadores simultáneamente en línea, con juego multiplataforma entre tiendas de PC planificado. Guarde y reanude juegos en cualquier momento y descubra una selección interminable de juegos para jugar con amigos o extraños en todo el mundo.</p><h2>Controles modernos y satisfactorios</h2><p><br>Con una física poderosa y controles ágiles y receptivos, cada movimiento y acción es tan satisfactorio como lo es en la vida real. Ya sea a través de una pantalla o de realidad virtual con y sin controladores de movimiento, experimente un juego más receptivo y fluido que nunca.</p><h2>Editor de juegos potente y accesible</h2><p><br>Ajusta las reglas y disfruta de tus favoritos de mesa exactamente como quieras, o convierte rápidamente tus propias ideas en juegos originales. El potente y fácil de usar editor del juego, junto con las secuencias de comandos JavaScript para permitir reglas y acciones complejas, significa que solo estás limitado por tu creatividad. Comparte tus juegos con el mundo a través de mod.io en el juego, lo que permite compatibilidad multiplataforma y mod de tienda para tus creaciones.</p><h2>Herramientas especializadas para juegos especializados</h2><p><br>Creado desde cero teniendo en cuenta una mayor funcionalidad para juegos de guerra y juegos especializados. Utilice herramientas especializadas para crear formaciones, medir distancias/ángulos, acceder al historial de movimientos/tiradas de dados y utilizar unidades de medida personalizadas. ¡Los juegos de guerra digitales nunca volverán a ser los mismos!</p><h2>Gráficos realistas y más personalización</h2><p><br>Mediante el uso de Unreal Engine 4, experimente las mejores sesiones de juego inmersivas que puede tener jugando juegos de mesa en línea. Personaliza tu espacio de juego con hermosas y acogedoras ubicaciones en 3D y piérdete en las detalladas piezas del juego y los gráficos realistas.</p><p><strong>Para mayores de 10 años</strong></p>', '', 2.00, 0, 1, 9, 1, 'YKF8C-Q8BBC-TALXX'),
(35, 'Call of Juarez', '<h2>Acerca de este juego</h2><p>Tenga en cuenta que a partir de octubre de 2024, las funciones en línea de este juego ya no serán compatibles.</p><p>Call of Juarez es un juego FPS de aventuras épicas con temática occidental. El jugador asume alternativamente los roles de dos personajes distintos y antagónicos: un fugitivo furtivo Billy y su cazador, el reverendo Ray. Aparte del aspecto altamente interesante, emocional y psicológico del vínculo entre los dos personajes, el jugador experimentará una variedad de jugabilidad con muchas diferencias mientras interpreta a un personaje en particular.</p><p>&nbsp;</p><p>El juego presenta trepidantes duelos con revólver utilizando armas de fuego históricamente precisas, paseos a caballo, combates a caballo y acciones sigilosas en lugares memorables ambientados después de las películas del Oeste. El juego emergente basado en una simulación precisa no solo de cuerpos rígidos y muñecos de trapo sino también de líquidos, gases, fuego y humo hace que el juego sea innovador y no lineal.</p><p>&nbsp;</p><p>Enfoque muy serio del tema del Lejano Oeste y reconstrucción detallada del personaje y las imágenes de esa época.<br>El uso de la física y la simulación innovadora de fuego, líquidos, polvo, humo y gases para construir un juego emergente.<br>Gráficos de última generación que utilizan las características de las tarjetas gráficas de última tecnología de las tarjetas actuales.<br>Jugar con 2 personajes distintos con diferentes habilidades y jugabilidad diferente.<br>Paseos a caballo y tiro con silla de montar, duelos de pistoleros.<br>Usar el látigo para luchar, mover objetos y mover al personaje del jugador.<br>Armas legendarias de la era Gold Fever y modo akimbo completo para un enfoque práctico.<br>Una historia emocionante llena de giros y vueltas en este apasionante género occidental.</p><p><strong>Para mayores de 15 años</strong></p>', '', 3.00, 0, 1, 4, 1, '0VRWP-C4JBC-3J900'),
(36, ' XIII - Classic', '<h2>Acerca de este juego</h2><p>El presidente de los Estados Unidos de América ha sido asesinado y usted es el principal sospechoso del mundo. El FBI, la CIA y una banda de asesinos están intentando cazarte. Afectado por amnesia, no recuerdas nada, ni siquiera quién eres. Estás solo y no hay nadie en quien puedas confiar. Todo lo que tienes es una llave de caja fuerte, un tatuaje misterioso y una pistola. Limpia tu nombre, resuelve el misterio y atrapa al verdadero asesino antes de que vuelva a atacar.</p><p>- Emocionante historia de espionaje y acción trepidante.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1170760/extras/Assomer.gif?t=1592398257\" width=\"600\" height=\"400\"><br>- Actuación de voz de primer nivel realizada por actores como David Duchovny y Adam West.</p><p>- Los gráficos sombreados en celdas y la narración tipo cómic dan vida a la experiencia del aclamado cómic en tu computadora\".<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1170760/extras/Chute_2.gif?t=1592398257\" width=\"600\" height=\"400\"></p><h2>Descripción del contenido para adultos</h2><p>Los desarrolladores describen el contenido así:</p><p>Este juego es una historia de FPS basada en una conspiración en la que interpretas a un fugitivo. El jugador tendrá que matar a la gente en su camino con armas de fuego o acero frío. Hay sangre, gritos y una cámara asesina que hace zoom cuando disparas a la cabeza de un enemigo.</p><p>&nbsp;</p><p>&nbsp; &nbsp;<strong>Para mayores de 10 años</strong></p>', '', 10.00, 5, 1, 8, 1, 'G6402-XFPTQ-V00WY'),
(37, 'Agatha Christie - The ABC Murders', '<p><strong>Agatha Christie - The ABC Murders</strong></p><h2>Tu arma es tu conocimiento. ¡Tu ingenio se pondrá a prueba!</h2><p><br>The ABC Murders es un juego de aventuras e investigación adaptado de la novela clásica de Agatha Christie. El jugador encarna al famoso Hércules Poirot en un juego de aventuras en perspectiva en tercera persona lleno de misterios. Una vez más, el detective privado se encontrará contra un misterioso oponente que se hace llamar \"ABC\".</p><h2>¡Tu inteligencia nunca habrá sido tan desafiada!</h2><p>Tendrás que explorar muchas escenas del crimen en varias ciudades ubicadas en hermosos alrededores en todo el Reino Unido. ¡No dejes piedra sin remover cuando se trata de interrogatorios y acertijos mortales!<br>¡Observa, cuestiona y explora todo lo posible para hacer las deducciones más inteligentes y comprender los planes del asesino!</p><h2><strong>CARACTERÍSTICAS PRINCIPALES:</strong></h2><ul><li>Exámenes: El jugador puede recopilar información examinando a los sospechosos y prestando atención a lo que dicen, cómo lo dicen y cómo se sienten.</li><li>Rompecabezas: el jugador tendrá que resolver acertijos para obtener más pistas.</li><li>Deducciones cerebrales: Dependiendo de las pistas recopiladas, el jugador podrá hacer deducciones y descubrir más sobre el asesino.</li><li>Línea de tiempo: a medida que el jugador saca conclusiones y avanza en la historia, puede usar la línea de tiempo de Poirot. Esto significa que Hércules Poirot puede construir una línea de tiempo con todos los eventos relevantes revelados durante la investigación.</li></ul><p><strong>Para mayores de 10 años</strong></p>', '', 15.00, 30, 1, 5, 1, 'H7R27-ZXFEH-KJB89'),
(38, 'The Wild Eight', '<h2>Acerca de este juego</h2><p>El misterioso accidente aéreo fue sólo el comienzo. Ocho supervivientes están varados en medio de la implacable y helada naturaleza de Alaska. No dejes que te consuma. Descubra la verdad. Sobrevive y vive para contar la historia de The Wild Eight.</p><p>En The Wild Eight, mantente siempre en movimiento: es tu única forma de sobrevivir y descubrir qué pasó con este misterioso lugar. Es un juego desafiante y divertido diseñado tanto para el modo multijugador de trabajo en equipo como para una experiencia inmersiva para un solo jugador.</p><ul><li><h2>Explora y sobrevive</h2><p>Embárcate en una aventura en la despiadada naturaleza ártica y descubre la verdad detrás de un misterioso accidente aéreo que dejó morir a sus pasajeros supervivientes.</p></li><li><h2>Cooperar</h2><p>Únete a otros jugadores en línea (hasta 8 jugadores en un grupo) o comienza el peligroso viaje por tu cuenta.<br>&nbsp;</p></li><li><h2>Cazar o ser cazado</h2><p>Reúne recursos, crea y mejora tu equipo en el campamento, escapa de las tormentas de nieve y lucha contra las bestias mortales que acechan en el bosque.<br>&nbsp;</p></li><li><h2>Botín</h2><p>Encuentra anomalías sobrenaturales, laboratorios extraños e instalaciones abandonadas, llenas de botines útiles y cosas que no pertenecen a este mundo.</p><p><strong>Para mayores de 10 años</strong></p></li></ul>', '', 10.00, 0, 1, 8, 1, '9CLLE-T9KLP-XICYC'),
(39, 'Police Stories', '<h2>Acerca de este juego</h2><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/539470/extras/ezgif-3-8e8f2aa67bd4.gif?t=1729094214\" width=\"600\" height=\"245\"></p><p>Inspirado en SWAT 4 y los valientes programas de televisión policiales, Police Stories es una nueva versión de los shooters de arriba hacia abajo con énfasis en tácticas que te obligan a tomar decisiones en fracciones de segundo. Neutraliza a criminales, rescata a civiles y desactiva bombas en el modo para un jugador o en el cooperativo en línea. Y recuerda: ¡disparar primero no es una opción!</p><p>&nbsp;</p><p>Implacable y tensa, cada misión cuenta la historia de dos agentes policiales, John Rimes y Rick Jones, llenos de infiltraciones en escondites de pandillas, rescate de rehenes, arrestos y otras situaciones que ponen en peligro la vida.</p><p>&nbsp;</p><p><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/539470/extras/smallcutscenes.gif?t=1729094214\" width=\"612\" height=\"150\"></p><p>El Sistema de Rendición le permite detener a los sospechosos sin recurrir a la violencia. Dispara un tiro de advertencia cerca de ellos o enfréntalos en un combate cuerpo a cuerpo: esas son solo algunas de las formas en que puedes someterlos.</p><p><br>Da órdenes a tu compañero policía Rick Jones. Asegúrate de usarlo sabiamente y, quién sabe, él podría salvarte la vida a cambio.</p><p><br>Criminales, rehenes y pruebas colocados aleatoriamente hacen que cada nivel sea único. La ubicación cambia cada vez que reinicias, lo que genera nuevas situaciones y oportunidades interesantes.</p><p><br>Como agente del orden, tendrás acceso a equipos policiales de última generación, como cámaras debajo de las puertas, cargas explosivas en las puertas y muchos otros.</p><p><br>Varios tipos de infractores de la ley, desde pequeños delincuentes hasta bandas bien organizadas y terroristas. Cada tipo tiene no sólo armas únicas, sino también diferentes comportamientos y habilidades de disparo.<br>Jugabilidad táctica compleja: intenta que no te descubran, no desperdicies balas, revisa periódicamente tu entorno y asegúrate de acabar con los delincuentes en silencio.</p><p><br>Todas tus acciones se puntúan en tiempo real. Jugar agresivamente no te dará un resultado lo suficientemente alto como para comenzar la siguiente misión, ¡así que tenlo en cuenta!<br>Cooperativa. ¡Completad la misión juntos para obtener mejores puntuaciones y más diversión!</p><p>&nbsp;</p><p>&nbsp;</p><h2>Descripción del contenido para adultos</h2><p>Los desarrolladores describen el contenido así:</p><p>Incluye violencia y sangre de dibujos animados.</p><p><strong>Para mayores de 15 años</strong></p>', '', 7.00, 0, 1, 4, 1, '5X9XK-BX5BG-3L39I');
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `genero`, `precio`, `descuento`, `stock`, `id_categoria`, `activo`, `Llave`) VALUES
(40, 'Arcade Paradise', '<h2>Acerca de este juego</h2><p><br><br>Bienvenido a Arcade Paradise, la aventura arcade retro impulsada por los años 90. En lugar de ganarse la vida lavando trapos, decides convertir la lavandería familiar en la sala de juegos definitiva. ¡Juega, obtén ganancias y compra nuevas máquinas arcade, con más de 35 para elegir, para construir tu propio Arcade Paradise!<br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Header_1.gif?t=1725377980\" width=\"600\" height=\"80\"><br>¡Toma el negocio de la lavandería, compuesto por tareas aburridas, desde lavar ropa hasta tirar la basura, y conviértelo en una sala de juegos en auge con los juegos más geniales de la ciudad que te hacen ganar todo el dinero!<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Banner_1.gif?t=1725377980\" width=\"600\" height=\"200\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Header_2.gif?t=1725377980\" width=\"600\" height=\"80\"><br>¡Más de 35 juegos arcade, cada uno completamente realizado con su propia jugabilidad, historias, misiones y puntuaciones altas para establecer! Inspirado en 3 décadas de juegos, desde los primeros juegos vectoriales hasta la era de 32 bits.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Banner_2.gif?t=1725377980\" width=\"600\" height=\"200\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Header_3.gif?t=1725377980\" width=\"600\" height=\"80\"><br>Inserta una segunda moneda y juega contra un amigo en varios juegos arcade cooperativos y competitivos con hasta 4 jugadores localmente.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Banner_3.gif?t=1725377980\" width=\"600\" height=\"200\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Header_4.gif?t=1725377980\" width=\"600\" height=\"80\"><br>Ponte a prueba en cada juego, establece tus puntuaciones más altas, haz que tu juego de arcade favorito sea más popular y sube a las tablas de clasificación en línea.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Banner_4.gif?t=1725377980\" width=\"600\" height=\"200\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Header_5.gif?t=1725377980\" width=\"600\" height=\"80\"><br>Desde los juegos individuales hasta la elección de qué canción poner en la máquina de discos inspirada en algunos de los grandes discos de principios de los 90, la banda sonora captura el corazón de una época pasada.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Banner_5.gif?t=1725377980\" width=\"600\" height=\"200\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Header_6.gif?t=1725377980\" width=\"600\" height=\"80\"><br>Hola años 90. Si pudieras oler este juego, olería a recuerdos. Todo, desde la apariencia de las salas de juegos hasta el uso de la última PC conectada a la alucinante conexión de acceso telefónico, todo ha sido recreado con puro amor.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Banner_6.gif?t=1725377980\" width=\"600\" height=\"200\"><br><br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Header_7.gif?t=1725377980\" width=\"600\" height=\"80\"><br>Doug Cockle (famoso por su voz en las series Victor Vran y The Witcher) interpreta el papel del padre reprensivo de Ashley. Al estar demasiado ocupado en la Riviera para ver King Wash por sí mismo, recibirá muchas llamadas telefónicas de Gerald compartiendo sus sabios consejos y recordatorios constantes para arreglar el inodoro.<br><img src=\"https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1388870/extras/AP_Steam_Banner_7.gif?t=1725377980\" width=\"600\" height=\"200\"></p><p><strong>Para toda la edades</strong></p>', '', 6.00, 0, 1, 11, 1, 'PQGDD-CE9WY-7TCVJ'),
(41, 'Cook, Serve, Delicious! 3?!', '<h2>Acerca de este juego</h2><p>¡Sal a la carretera en esta enorme secuela de Cook, Serve, Delicious! serie mientras viajas por los Estados Unidos para participar en el Campeonato Iron Cook Foodtruck con tu confiable equipo de robots Whisk and Cleaver.</p><p>Ambientada en la América de 2042, radicalmente cambiada y devastada por la guerra, juega a través de una nueva campaña basada en una historia en la que cocinarás cientos de alimentos, incluidos muchos nuevos en la serie, a lo largo de cientos de niveles en una nueva estructura de juego que ha sido completamente renovada. Rediseñado para ofrecer acción trepidante, ¡o tómatelo con calma con el nuevo modo Chill que se puede activar o desactivar en cualquier momento!<br>&nbsp;</p><ul><li>Juega la campaña para un solo jugador o con un amigo en modo cooperativo local (con la posibilidad de cambiar sobre la marcha).</li><li>¡Actualiza tu camión de comida con docenas de módulos que afectan el juego!</li><li>¡Amplía tu catálogo de alimentos con más de doscientos alimentos!</li><li>¡Decora tu camión de comida con docenas de baratijas que abarcan todo Estados Unidos!</li><li>Toneladas de funciones de accesibilidad que te permiten jugar de la forma más cómoda que desees, incluidas configuraciones de movimiento, configuraciones de parpadeo/estroboscópico, funciones de audio y para daltónicos, y muchas más.</li><li>¡Más de cien horas de juego que abarcan más de 380 niveles!</li><li>Una increíble banda sonora original del galardonado compositor Jonathan Geer.</li></ul><p><strong>&nbsp; &nbsp; Para mayores de 10 años</strong></p>', '', 20.00, 25, 1, 11, 1, '64IC3-VVYXB-FWP9I');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `activacion` int(11) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(40) DEFAULT NULL,
  `password_request` int(11) NOT NULL DEFAULT 0,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `activacion`, `token`, `token_password`, `password_request`, `id_cliente`) VALUES
(1, 'darko', '$2y$10$LXqe94oS4f9ufvPzGM4odeLFvFUSqoxiGWJ3fe1KkiYtQjqgFklU.', 1, '', NULL, 0, 1),
(2, 'mrdarko', '$2y$10$POYl7e39jTlzk3qO7w2pB.MMda3ZtYoTKgjWU7PY5HHDb5BTrB3cK', 0, '1ff41205e02dfe21cca2e0110a3db119', NULL, 0, 2),
(3, 'darkoo', '$2y$10$R73T0kh4nlazX8l5yp.Tke7PaD4v8mHkhp9uyfUbOqY3WiLdROP7.', 1, '', NULL, 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
