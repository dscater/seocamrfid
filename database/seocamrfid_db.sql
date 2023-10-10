-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-10-2023 a las 22:14:15
-- Versión del servidor: 8.0.30
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seocamrfid_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `habilitado` int DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `email`, `fono`, `cel`, `habilitado`, `fecha_registro`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'JUAN', 'PERES', '', '123', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', 'JUAN@GMAIL.COM', '21314568', '78945612', 1, '2021-08-04', 2, '2021-08-04 20:15:50', '2023-07-10 16:37:44'),
(2, 'MARIO', 'CASTRO', '', '1234', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314568', '78945612', 1, '2021-08-04', 3, '2021-08-04 20:16:06', '2023-07-10 16:37:50'),
(3, 'MARIA', 'MAMANI', '', '123456', 'SC', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314568', '78945612', 0, '2021-08-04', 4, '2021-08-04 20:16:20', '2023-07-10 16:38:00'),
(4, 'SANTIAGO', 'CONDORI', 'MAMANI', '5555', 'CB', 'LOS OLIVOS', 'SANTIAGO@GMAIL.COM', '2222222', '77777777', 1, '2023-07-10', 6, '2023-07-10 16:38:47', '2023-07-10 16:38:47'),
(5, 'DANIEL', 'SANDOVAL', '', '6666', 'CB', 'LOS OLIVOS', 'DANIEL@GMAIL.COM', '2222222', '77777777', 0, '2023-07-10', 7, '2023-07-10 16:39:32', '2023-07-10 16:39:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `herramientas`
--

INSERT INTO `herramientas` (`id`, `nombre`, `rfid`, `descripcion`, `estado`, `foto`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'HERRAMIENTA 1', '111', '', 'INGRESO', '11689114439.jpg', '2021-08-04', '2021-08-04 20:18:43', '2023-07-11 22:27:19'),
(2, 'HERRAMIENTA 2', '222', '', 'INGRESO', NULL, '2021-08-04', '2021-08-04 20:23:24', '2023-07-13 15:16:30'),
(3, 'HERRAMIENTA #3', '3333', 'DESC', 'INGRESO', '31689114466.png', '2023-07-11', '2023-07-11 22:27:38', '2023-07-11 22:27:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_salidas`
--

CREATE TABLE `ingreso_salidas` (
  `id` bigint UNSIGNED NOT NULL,
  `obra_id` bigint UNSIGNED NOT NULL,
  `mo_id` bigint UNSIGNED NOT NULL,
  `cantidad` double(8,2) NOT NULL,
  `tipo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingreso_salidas`
--

INSERT INTO `ingreso_salidas` (`id`, `obra_id`, `mo_id`, `cantidad`, `tipo`, `fecha_registro`, `estado`, `created_at`, `updated_at`) VALUES
(17, 1, 11, 10.00, 'INGRESO', '2023-07-12', 1, '2023-07-12 21:48:07', '2023-07-12 21:48:07'),
(18, 1, 12, 20.00, 'INGRESO', '2023-07-12', 1, '2023-07-12 21:48:19', '2023-07-12 21:48:19'),
(19, 1, 11, 10.00, 'SALIDA', '2023-07-12', 1, '2023-07-13 03:50:16', '2023-07-13 03:50:16'),
(20, 2, 13, 30.00, 'INGRESO', '2023-07-20', 1, '2023-07-20 16:04:40', '2023-07-20 16:04:40'),
(21, 2, 13, 30.00, 'SALIDA', '2023-07-20', 1, '2023-07-20 16:06:07', '2023-07-20 16:06:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

CREATE TABLE `materials` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_minimo` double(8,2) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materials`
--

INSERT INTO `materials` (`id`, `nombre`, `stock_minimo`, `descripcion`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'MATERIAL 1', 10.00, '', '2021-08-04', '2021-08-04 20:16:42', '2021-08-04 20:16:42'),
(2, 'MATERIAL 2', 5.00, '', '2021-08-04', '2021-08-04 20:16:47', '2021-08-04 20:16:47'),
(3, 'MATERIAL 3', 20.00, '', '2021-08-04', '2021-08-04 20:16:51', '2021-08-04 20:16:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_obras`
--

CREATE TABLE `material_obras` (
  `id` bigint UNSIGNED NOT NULL,
  `material_id` bigint UNSIGNED NOT NULL,
  `stock_minimo` double(8,2) NOT NULL,
  `stock_actual` double(8,2) NOT NULL,
  `estado_stock` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `obra_id` bigint UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `material_obras`
--

INSERT INTO `material_obras` (`id`, `material_id`, `stock_minimo`, `stock_actual`, `estado_stock`, `obra_id`, `fecha_registro`, `estado`, `created_at`, `updated_at`) VALUES
(11, 1, 10.00, 0.00, 'BAJO', 1, '2023-07-12', 1, '2023-07-12 21:48:07', '2023-07-13 03:50:16'),
(12, 2, 5.00, 20.00, 'NORMAL', 1, '2023-07-12', 1, '2023-07-12 21:48:19', '2023-07-12 21:48:19'),
(13, 1, 10.00, 0.00, 'BAJO', 2, '2023-07-20', 1, '2023-07-20 16:04:40', '2023-07-20 16:06:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2020_11_11_164550_create_razon_socials_table', 1),
(12, '2020_11_11_164632_create_datos_usuarios_table', 1),
(13, '2021_07_30_135411_create_obras_table', 1),
(14, '2021_07_30_135412_create_personals_table', 1),
(15, '2021_07_30_140558_create_materials_table', 1),
(16, '2021_07_30_140559_create_material_obras_table', 1),
(17, '2021_07_30_141108_create_herramientas_table', 1),
(18, '2021_07_30_141214_create_monitoreo_herramientas_table', 1),
(19, '2021_08_03_111005_create_ingreso_salidas_table', 2),
(20, '2021_08_04_143829_create_notificacions_table', 3),
(21, '2021_08_04_143923_create_notificacion_users_table', 4),
(22, '2023_07_10_124554_create_solicitud_obras_table', 5),
(23, '2023_07_10_142252_create_solicitud_materials_table', 5),
(24, '2023_07_10_142302_create_solicitud_herramientas_table', 5),
(25, '2023_07_10_142310_create_solicitud_personals_table', 5),
(26, '2023_07_10_142311_create_obra_herramientas_table', 5),
(27, '2023_07_10_142956_create_obra_personals_table', 5),
(29, '2023_07_10_143453_create_solicitud_notas_table', 6),
(30, '2023_07_11_141822_create_nota_obras_table', 6),
(31, '2023_07_12_194226_create_obra_herramienta_usos_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitoreo_herramientas`
--

CREATE TABLE `monitoreo_herramientas` (
  `id` bigint UNSIGNED NOT NULL,
  `herramienta_id` bigint UNSIGNED NOT NULL,
  `accion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `monitoreo_herramientas`
--

INSERT INTO `monitoreo_herramientas` (`id`, `herramienta_id`, `accion`, `fecha_registro`, `hora`, `created_at`, `updated_at`) VALUES
(1, 1, 'INGRESO', '2021-08-04', '08:00:00', '2021-08-04 20:18:43', '2021-08-04 20:18:43'),
(2, 2, 'INGRESO', '2021-08-04', '08:00:00', '2021-08-04 20:23:24', '2021-08-04 20:23:24'),
(3, 1, 'SALIDA', '2021-08-04', '12:00:00', '2021-08-04 20:24:09', '2021-08-04 20:24:09'),
(4, 2, 'SALIDA', '2021-08-04', '12:00:00', '2021-08-04 20:24:18', '2021-08-04 20:24:18'),
(5, 1, 'INGRESO', '2021-08-04', '18:00:00', '2021-08-04 20:24:22', '2021-08-04 20:24:22'),
(6, 2, 'INGRESO', '2021-08-17', '16:00:00', '2021-08-17 19:51:32', '2021-08-17 19:51:32'),
(7, 3, 'INGRESO', '2023-07-11', '13:00:00', '2023-07-11 22:27:38', '2023-07-11 22:27:38'),
(8, 2, 'SALIDA', '2023-07-12', '21:15:00', '2023-07-13 01:15:36', '2023-07-13 01:15:36'),
(10, 2, 'INGRESO', '2023-07-13', '11:16:00', '2023-07-13 15:16:30', '2023-07-13 15:16:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_obras`
--

CREATE TABLE `nota_obras` (
  `id` bigint UNSIGNED NOT NULL,
  `obra_id` bigint UNSIGNED NOT NULL,
  `nota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nota_obras`
--

INSERT INTO `nota_obras` (`id`, `obra_id`, `nota`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(2, 1, 'NOTA #1 MODIFICADO', '2023-07-11', '2023-07-11 18:42:10', '2023-07-11 18:44:49'),
(3, 1, 'NOTA #2', '2023-07-11', '2023-07-11 18:44:41', '2023-07-11 18:44:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacions`
--

CREATE TABLE `notificacions` (
  `id` bigint UNSIGNED NOT NULL,
  `registro_id` bigint UNSIGNED NOT NULL,
  `tipo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `accion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notificacions`
--

INSERT INTO `notificacions` (`id`, `registro_id`, `tipo`, `accion`, `mensaje`, `fecha`, `hora`, `created_at`, `updated_at`) VALUES
(1, 1, 'HERRAMIENTA', 'INGRESO', 'INGRESO DE LA HERRAMIENTA HERRAMIENTA 1', '2021-08-04', '16:18:25', '2021-08-04 20:18:25', '2021-08-04 20:18:25'),
(2, 1, 'HERRAMIENTA', 'INGRESO', 'INGRESO DE LA HERRAMIENTA HERRAMIENTA 1', '2021-08-04', '16:18:43', '2021-08-04 20:18:43', '2021-08-04 20:18:43'),
(7, 2, 'HERRAMIENTA', 'INGRESO', 'INGRESO DE LA HERRAMIENTA HERRAMIENTA 2', '2021-08-04', '16:23:24', '2021-08-04 20:23:24', '2021-08-04 20:23:24'),
(9, 3, 'HERRAMIENTA', 'SALIDA', 'SALIDA DE LA HERRAMIENTA HERRAMIENTA 1', '2021-08-04', '16:24:09', '2021-08-04 20:24:09', '2021-08-04 20:24:09'),
(10, 4, 'HERRAMIENTA', 'SALIDA', 'SALIDA DE LA HERRAMIENTA HERRAMIENTA 2', '2021-08-04', '16:24:18', '2021-08-04 20:24:18', '2021-08-04 20:24:18'),
(11, 5, 'HERRAMIENTA', 'INGRESO', 'INGRESO DE LA HERRAMIENTA HERRAMIENTA 1', '2021-08-04', '16:24:22', '2021-08-04 20:24:22', '2021-08-04 20:24:22'),
(13, 6, 'HERRAMIENTA', 'INGRESO', 'INGRESO DE LA HERRAMIENTA HERRAMIENTA 2', '2021-08-17', '15:51:33', '2021-08-17 19:51:33', '2021-08-17 19:51:33'),
(21, 2, 'SOLICITUD', 'NUEVO', 'SE REALZÓ UNA SOLICITUD PARA LA OBRA: OBRA 1', '2023-07-11', '18:06:42', '2023-07-11 22:06:42', '2023-07-11 22:06:42'),
(45, 1, 'PERSONAL', 'INGRESO', 'SE REGISTRO EL INGRESO DEL PERSONAL PEDRO MAMANI  EN LA OBRA OBRA 1', '2023-07-12', '17:47:47', '2023-07-12 21:47:47', '2023-07-12 21:47:47'),
(46, 2, 'HERRAMIENTA OBRA', 'INGRESO', 'SE REGISTRO EL INGRESO DE LA HERRAMIENTA  EN LA OBRA OBRA 1', '2023-07-12', '17:47:55', '2023-07-12 21:47:55', '2023-07-12 21:47:55'),
(47, 17, 'MATERIAL', 'INGRESO', 'INGRESO DE 10 MATERIAL 1 EN LA OBRA OBRA 1', '2023-07-12', '17:48:07', '2023-07-12 21:48:07', '2023-07-12 21:48:07'),
(48, 18, 'MATERIAL', 'INGRESO', 'INGRESO DE 20 MATERIAL 2 EN LA OBRA OBRA 1', '2023-07-12', '17:48:19', '2023-07-12 21:48:19', '2023-07-12 21:48:19'),
(49, 2, 'HERRAMIENTA OBRA', 'SALIDA', 'SE REGISTRO LA SALIDA DE LA HERRAMIENTA  EN LA OBRA OBRA 1', '2023-07-12', '17:56:33', '2023-07-12 21:56:33', '2023-07-12 21:56:33'),
(50, 2, 'HERRAMIENTA OBRA', 'INGRESO', 'SE REGISTRO EL INGRESO DE LA HERRAMIENTA  EN LA OBRA OBRA 1', '2023-07-12', '18:06:20', '2023-07-12 22:06:20', '2023-07-12 22:06:20'),
(51, 8, 'HERRAMIENTA', 'SALIDA', 'SALIDA DE LA HERRAMIENTA HERRAMIENTA 2', '2023-07-12', '21:15:36', '2023-07-13 01:15:36', '2023-07-13 01:15:36'),
(52, 19, 'MATERIAL', 'SALIDA', 'SALIDA DE 10 MATERIAL 1 EN LA OBRA OBRA 1', '2023-07-12', '23:50:16', '2023-07-13 03:50:16', '2023-07-13 03:50:16'),
(53, 3, 'SOLICITUD', 'NUEVO', 'SE REALZÓ UNA SOLICITUD PARA LA OBRA: COPIAR OBRA 1', '2023-07-13', '11:00:02', '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(55, 10, 'HERRAMIENTA', 'INGRESO', 'INGRESO DE LA HERRAMIENTA HERRAMIENTA 2', '2023-07-13', '11:16:30', '2023-07-13 15:16:30', '2023-07-13 15:16:30'),
(56, 4, 'SOLICITUD', 'NUEVO', 'SE REALZÓ UNA SOLICITUD PARA LA OBRA: OBRA 2', '2023-07-20', '11:59:08', '2023-07-20 15:59:08', '2023-07-20 15:59:08'),
(57, 20, 'MATERIAL', 'INGRESO', 'INGRESO DE 30 MATERIAL 1 EN LA OBRA OBRA 2', '2023-07-20', '12:04:40', '2023-07-20 16:04:40', '2023-07-20 16:04:40'),
(58, 21, 'MATERIAL', 'SALIDA', 'SALIDA DE 30 MATERIAL 1 EN LA OBRA OBRA 2', '2023-07-20', '12:06:07', '2023-07-20 16:06:07', '2023-07-20 16:06:07'),
(59, 1, 'HERRAMIENTA OBRA', 'INGRESO', 'SE REGISTRO EL INGRESO DE LA HERRAMIENTA  EN LA OBRA OBRA 2', '2023-07-20', '12:30:00', '2023-07-20 16:30:00', '2023-07-20 16:30:00'),
(60, 1, 'PERSONAL', 'INGRESO', 'SE REGISTRO EL INGRESO DEL PERSONAL PEDRO MAMANI  EN LA OBRA OBRA 2', '2023-07-20', '12:30:11', '2023-07-20 16:30:11', '2023-07-20 16:30:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_users`
--

CREATE TABLE `notificacion_users` (
  `id` bigint UNSIGNED NOT NULL,
  `notificacion_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `visto` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notificacion_users`
--

INSERT INTO `notificacion_users` (`id`, `notificacion_id`, `user_id`, `visto`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2021-08-04 20:18:43', '2021-08-04 20:19:00'),
(2, 2, 2, 0, '2021-08-04 20:18:43', '2021-08-04 20:18:43'),
(3, 2, 4, 0, '2021-08-04 20:18:43', '2021-08-04 20:18:43'),
(20, 7, 1, 1, '2021-08-04 20:23:24', '2021-08-04 20:23:30'),
(21, 7, 2, 0, '2021-08-04 20:23:24', '2021-08-04 20:23:24'),
(22, 7, 4, 0, '2021-08-04 20:23:24', '2021-08-04 20:23:24'),
(27, 9, 1, 1, '2021-08-04 20:24:09', '2023-07-11 16:42:51'),
(28, 9, 2, 0, '2021-08-04 20:24:09', '2021-08-04 20:24:09'),
(29, 9, 4, 0, '2021-08-04 20:24:09', '2021-08-04 20:24:09'),
(30, 10, 1, 1, '2021-08-04 20:24:18', '2023-07-11 16:42:51'),
(31, 10, 2, 0, '2021-08-04 20:24:18', '2021-08-04 20:24:18'),
(32, 10, 4, 0, '2021-08-04 20:24:18', '2021-08-04 20:24:18'),
(33, 11, 1, 1, '2021-08-04 20:24:22', '2023-07-11 16:42:51'),
(34, 11, 2, 0, '2021-08-04 20:24:22', '2021-08-04 20:24:22'),
(35, 11, 4, 0, '2021-08-04 20:24:22', '2021-08-04 20:24:22'),
(40, 13, 1, 1, '2021-08-17 19:51:33', '2023-07-11 16:42:51'),
(41, 13, 2, 0, '2021-08-17 19:51:33', '2021-08-17 19:51:33'),
(42, 13, 4, 0, '2021-08-17 19:51:33', '2021-08-17 19:51:33'),
(67, 21, 1, 0, '2023-07-11 22:06:42', '2023-07-11 22:06:42'),
(68, 21, 2, 0, '2023-07-11 22:06:42', '2023-07-11 22:06:42'),
(69, 21, 4, 0, '2023-07-11 22:06:42', '2023-07-11 22:06:42'),
(70, 21, 7, 0, '2023-07-11 22:06:42', '2023-07-11 22:06:42'),
(71, 45, 1, 0, '2023-07-12 21:47:47', '2023-07-12 21:47:47'),
(72, 45, 2, 0, '2023-07-12 21:47:47', '2023-07-12 21:47:47'),
(73, 45, 4, 0, '2023-07-12 21:47:47', '2023-07-12 21:47:47'),
(74, 45, 7, 0, '2023-07-12 21:47:47', '2023-07-12 21:47:47'),
(75, 46, 1, 0, '2023-07-12 21:47:55', '2023-07-12 21:47:55'),
(76, 46, 2, 0, '2023-07-12 21:47:55', '2023-07-12 21:47:55'),
(77, 46, 4, 0, '2023-07-12 21:47:55', '2023-07-12 21:47:55'),
(78, 46, 7, 0, '2023-07-12 21:47:55', '2023-07-12 21:47:55'),
(79, 47, 1, 0, '2023-07-12 21:48:07', '2023-07-12 21:48:07'),
(80, 47, 2, 0, '2023-07-12 21:48:07', '2023-07-12 21:48:07'),
(81, 47, 4, 0, '2023-07-12 21:48:07', '2023-07-12 21:48:07'),
(82, 47, 7, 0, '2023-07-12 21:48:07', '2023-07-12 21:48:07'),
(83, 48, 1, 0, '2023-07-12 21:48:19', '2023-07-12 21:48:19'),
(84, 48, 2, 0, '2023-07-12 21:48:19', '2023-07-12 21:48:19'),
(85, 48, 4, 0, '2023-07-12 21:48:19', '2023-07-12 21:48:19'),
(86, 48, 7, 0, '2023-07-12 21:48:19', '2023-07-12 21:48:19'),
(87, 49, 1, 0, '2023-07-12 21:56:33', '2023-07-12 21:56:33'),
(88, 49, 2, 0, '2023-07-12 21:56:33', '2023-07-12 21:56:33'),
(89, 49, 4, 0, '2023-07-12 21:56:33', '2023-07-12 21:56:33'),
(90, 49, 7, 0, '2023-07-12 21:56:33', '2023-07-12 21:56:33'),
(91, 50, 1, 0, '2023-07-12 22:06:20', '2023-07-12 22:06:20'),
(92, 50, 2, 0, '2023-07-12 22:06:20', '2023-07-12 22:06:20'),
(93, 50, 4, 0, '2023-07-12 22:06:20', '2023-07-12 22:06:20'),
(94, 50, 7, 0, '2023-07-12 22:06:20', '2023-07-12 22:06:20'),
(95, 51, 1, 0, '2023-07-13 01:15:36', '2023-07-13 01:15:36'),
(96, 51, 2, 0, '2023-07-13 01:15:36', '2023-07-13 01:15:36'),
(97, 51, 4, 0, '2023-07-13 01:15:36', '2023-07-13 01:15:36'),
(98, 51, 7, 0, '2023-07-13 01:15:36', '2023-07-13 01:15:36'),
(99, 52, 1, 0, '2023-07-13 03:50:16', '2023-07-13 03:50:16'),
(100, 52, 2, 0, '2023-07-13 03:50:16', '2023-07-13 03:50:16'),
(101, 52, 4, 0, '2023-07-13 03:50:16', '2023-07-13 03:50:16'),
(102, 52, 7, 0, '2023-07-13 03:50:16', '2023-07-13 03:50:16'),
(103, 53, 1, 1, '2023-07-13 15:00:02', '2023-07-13 15:01:54'),
(104, 53, 2, 0, '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(105, 53, 4, 0, '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(106, 53, 7, 0, '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(111, 55, 1, 0, '2023-07-13 15:16:30', '2023-07-13 15:16:30'),
(112, 55, 2, 0, '2023-07-13 15:16:30', '2023-07-13 15:16:30'),
(113, 55, 4, 0, '2023-07-13 15:16:30', '2023-07-13 15:16:30'),
(114, 55, 7, 0, '2023-07-13 15:16:30', '2023-07-13 15:16:30'),
(115, 56, 1, 0, '2023-07-20 15:59:08', '2023-07-20 15:59:08'),
(116, 56, 2, 0, '2023-07-20 15:59:08', '2023-07-20 15:59:08'),
(117, 56, 4, 0, '2023-07-20 15:59:08', '2023-07-20 15:59:08'),
(118, 56, 7, 0, '2023-07-20 15:59:08', '2023-07-20 15:59:08'),
(119, 57, 1, 0, '2023-07-20 16:04:40', '2023-07-20 16:04:40'),
(120, 57, 2, 0, '2023-07-20 16:04:40', '2023-07-20 16:04:40'),
(121, 57, 4, 0, '2023-07-20 16:04:40', '2023-07-20 16:04:40'),
(122, 57, 7, 0, '2023-07-20 16:04:40', '2023-07-20 16:04:40'),
(123, 58, 1, 0, '2023-07-20 16:06:07', '2023-07-20 16:06:07'),
(124, 58, 2, 0, '2023-07-20 16:06:07', '2023-07-20 16:06:07'),
(125, 58, 4, 0, '2023-07-20 16:06:07', '2023-07-20 16:06:07'),
(126, 58, 7, 0, '2023-07-20 16:06:07', '2023-07-20 16:06:07'),
(127, 59, 1, 0, '2023-07-20 16:30:00', '2023-07-20 16:30:00'),
(128, 59, 2, 0, '2023-07-20 16:30:00', '2023-07-20 16:30:00'),
(129, 59, 4, 0, '2023-07-20 16:30:00', '2023-07-20 16:30:00'),
(130, 59, 7, 0, '2023-07-20 16:30:00', '2023-07-20 16:30:00'),
(131, 60, 1, 0, '2023-07-20 16:30:11', '2023-07-20 16:30:11'),
(132, 60, 2, 0, '2023-07-20 16:30:11', '2023-07-20 16:30:11'),
(133, 60, 4, 0, '2023-07-20 16:30:11', '2023-07-20 16:30:11'),
(134, 60, 7, 0, '2023-07-20 16:30:11', '2023-07-20 16:30:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jefe_id` bigint UNSIGNED DEFAULT NULL,
  `auxiliar_id` bigint UNSIGNED DEFAULT NULL,
  `fecha_obra` date DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_jefe` int NOT NULL DEFAULT '0',
  `check_aux` int NOT NULL DEFAULT '0',
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'POR INICIAR',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id`, `nombre`, `jefe_id`, `auxiliar_id`, `fecha_obra`, `descripcion`, `check_jefe`, `check_aux`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'OBRA 1', 3, 2, '2023-07-10', 'PRUEBA ASIGNACION FECHA, JEFE DE OBRA Y AUXILIAR', 1, 0, 'EN PROCONCESO', '2021-08-04 20:16:28', '2023-07-11 22:16:21'),
(2, 'OBRA 2', 3, 2, '2023-07-21', 'PRUEBA #2 ASIGNACION POR MODIFICACION', 0, 0, 'POR INICIAR', '2021-08-04 20:16:31', '2023-07-11 22:54:49'),
(3, 'OBRA 3', 3, 2, '2023-07-31', '', 0, 0, 'POR INICIAR', '2021-08-04 20:16:31', '2023-07-10 19:30:10'),
(4, 'OBRA #4', 6, 2, '2023-07-15', 'NUEVA OBRA', 0, 0, 'POR INICIAR', '2023-07-10 19:30:31', '2023-07-10 19:31:38'),
(5, 'COPIA OBRA 1', 3, 2, '2023-07-10', 'PRUEBA ASIGNACION FECHA, JEFE DE OBRA Y AUXILIAR', 0, 0, 'POR INICIAR', '2023-07-13 15:00:02', '2023-07-13 15:00:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_herramientas`
--

CREATE TABLE `obra_herramientas` (
  `id` bigint UNSIGNED NOT NULL,
  `obra_id` bigint UNSIGNED NOT NULL,
  `herramienta_id` bigint UNSIGNED NOT NULL,
  `solicitud_herramienta_id` bigint UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `obra_herramientas`
--

INSERT INTO `obra_herramientas` (`id`, `obra_id`, `herramienta_id`, `solicitud_herramienta_id`, `fecha_registro`, `fecha_fin`, `estado`, `created_at`, `updated_at`) VALUES
(8, 1, 2, 4, '2023-07-12', NULL, 1, '2023-07-12 22:06:20', '2023-07-12 22:06:20'),
(9, 2, 1, 5, '2023-07-20', NULL, 1, '2023-07-20 16:30:00', '2023-07-20 16:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_herramienta_usos`
--

CREATE TABLE `obra_herramienta_usos` (
  `id` bigint UNSIGNED NOT NULL,
  `obra_id` bigint UNSIGNED NOT NULL,
  `obra_herramienta_id` bigint UNSIGNED NOT NULL,
  `herramienta_id` bigint UNSIGNED NOT NULL,
  `total_almacen` double NOT NULL,
  `total_uso` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `obra_herramienta_usos`
--

INSERT INTO `obra_herramienta_usos` (`id`, `obra_id`, `obra_herramienta_id`, `herramienta_id`, `total_almacen`, `total_uso`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 2, 0, 14, '2023-07-13 01:15:36', '2023-07-13 15:16:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_personals`
--

CREATE TABLE `obra_personals` (
  `id` bigint UNSIGNED NOT NULL,
  `obra_id` bigint UNSIGNED NOT NULL,
  `personal_id` bigint UNSIGNED NOT NULL,
  `solicitud_personal_id` bigint UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `obra_personals`
--

INSERT INTO `obra_personals` (`id`, `obra_id`, `personal_id`, `solicitud_personal_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 5, '2023-07-12', '2023-07-12 21:47:47', '2023-07-12 21:47:47'),
(7, 2, 1, 7, '2023-07-20', '2023-07-20 16:30:11', '2023-07-20 16:30:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personals`
--

CREATE TABLE `personals` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `familiar_referencia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_familiar` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel_familiar` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `habilitado` int DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personals`
--

INSERT INTO `personals` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `cel`, `domicilio`, `familiar_referencia`, `fono_familiar`, `cel_familiar`, `foto`, `cargo`, `habilitado`, `fecha_registro`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'PEDRO', 'MAMANI', '', '4566', 'LP', '78945612', 'ZONA LOS OLIVOS CALLE 3 #3232', '', '', '', 'user_default.png', 'CARGO #1', 1, '2021-08-04', 1, '2021-08-04 20:25:07', '2023-07-10 16:29:57'),
(2, 'JUAN', 'PERES', '', '2222', 'LP', '', 'LOS OLIVOS', '', '', '', 'user_default.png', 'CARGO #1', 1, '2023-07-10', 1, '2023-07-10 16:25:23', '2023-07-10 16:30:51'),
(3, 'CARLOS', 'GONZALES', 'MARTINEZ', '3333', 'CB', '', 'LOS OLIVOS', '', '', '', 'user_default.png', 'CARGO #2', 1, '2023-07-10', 1, '2023-07-10 16:30:36', '2023-07-10 16:30:36'),
(4, 'SANDRO', 'MAMANI', 'MAMANI', '4444', 'CB', '', 'LOS OLIVOS', '', '', '', 'user_default.png', 'CARGO #3', 0, '2023-07-10', 1, '2023-07-10 16:31:19', '2023-07-10 16:31:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razon_socials`
--

CREATE TABLE `razon_socials` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_aut` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `casilla` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actividad_economica` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `razon_socials`
--

INSERT INTO `razon_socials` (`id`, `nombre`, `alias`, `ciudad`, `dir`, `nit`, `nro_aut`, `fono`, `cel`, `casilla`, `correo`, `web`, `logo`, `actividad_economica`, `created_at`, `updated_at`) VALUES
(1, 'CONSTRUCTORA', 'EP', 'LA PAZ', 'ZONACENTRAL CALLE 3 #3232', '0', '0', '2665245', '76522458', '', '', '', 'logo1635955305.jpg', 'ACTIVIDAD ECONOMICA', '2021-07-30 18:15:44', '2021-11-03 16:01:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_herramientas`
--

CREATE TABLE `solicitud_herramientas` (
  `id` bigint UNSIGNED NOT NULL,
  `solicitud_obra_id` bigint UNSIGNED NOT NULL,
  `herramienta_id` bigint UNSIGNED NOT NULL,
  `dias_uso` int NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `ingreso` int NOT NULL,
  `aprobado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_herramientas`
--

INSERT INTO `solicitud_herramientas` (`id`, `solicitud_obra_id`, `herramienta_id`, `dias_uso`, `fecha_asignacion`, `fecha_finalizacion`, `ingreso`, `aprobado`, `created_at`, `updated_at`) VALUES
(4, 2, 2, 10, '2023-07-12', '2023-07-22', 0, 1, '2023-07-11 22:06:42', '2023-07-12 21:42:33'),
(5, 4, 1, 10, '2023-07-20', '2023-07-30', 0, 1, '2023-07-20 15:59:08', '2023-07-20 15:59:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_materials`
--

CREATE TABLE `solicitud_materials` (
  `id` bigint UNSIGNED NOT NULL,
  `solicitud_obra_id` bigint UNSIGNED NOT NULL,
  `material_id` bigint UNSIGNED NOT NULL,
  `cantidad` double(24,2) NOT NULL,
  `cantidad_usada` double(24,2) NOT NULL,
  `aprobado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_materials`
--

INSERT INTO `solicitud_materials` (`id`, `solicitud_obra_id`, `material_id`, `cantidad`, `cantidad_usada`, `aprobado`, `created_at`, `updated_at`) VALUES
(5, 2, 1, 10.00, 10.00, 1, '2023-07-11 22:06:42', '2023-07-12 21:48:07'),
(6, 2, 2, 20.00, 20.00, 1, '2023-07-12 15:45:56', '2023-07-12 21:48:19'),
(7, 3, 1, 10.00, 0.00, 0, '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(8, 3, 2, 20.00, 0.00, 0, '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(9, 4, 1, 30.00, 30.00, 1, '2023-07-20 15:59:08', '2023-07-20 16:04:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_notas`
--

CREATE TABLE `solicitud_notas` (
  `id` bigint UNSIGNED NOT NULL,
  `solicitud_obra_id` bigint UNSIGNED NOT NULL,
  `nota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_obras`
--

CREATE TABLE `solicitud_obras` (
  `id` bigint UNSIGNED NOT NULL,
  `obra_id` bigint UNSIGNED NOT NULL,
  `aprobado` int NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_obras`
--

INSERT INTO `solicitud_obras` (`id`, `obra_id`, `aprobado`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2023-07-11', '2023-07-11 22:06:42', '2023-07-12 21:42:33'),
(3, 5, 0, '2023-07-13', '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(4, 2, 1, '2023-07-20', '2023-07-20 15:59:08', '2023-07-20 15:59:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_personals`
--

CREATE TABLE `solicitud_personals` (
  `id` bigint UNSIGNED NOT NULL,
  `solicitud_obra_id` bigint UNSIGNED NOT NULL,
  `personal_id` bigint UNSIGNED NOT NULL,
  `ingreso` int NOT NULL,
  `aprobado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_personals`
--

INSERT INTO `solicitud_personals` (`id`, `solicitud_obra_id`, `personal_id`, `ingreso`, `aprobado`, `created_at`, `updated_at`) VALUES
(5, 2, 1, 0, 1, '2023-07-11 22:06:42', '2023-07-12 21:42:33'),
(6, 3, 1, 0, 0, '2023-07-13 15:00:02', '2023-07-13 15:00:02'),
(7, 4, 1, 0, 1, '2023-07-20 15:59:08', '2023-07-20 15:59:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('ADMINISTRADOR','AUXILIAR','JEFE DE OBRA','CONTROL') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_usuario` bigint NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `tipo`, `foto`, `nro_usuario`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$zEpzzEvEXn12O02EosucCuNnUgri46IX7MQRYMAJdGII9xQtkDzNa', 'ADMINISTRADOR', 'user_default.png', 0, 1, '2021-07-30 18:15:44', '2021-07-30 18:15:44'),
(2, '20001', '$2y$10$glhOhNPiroA8QhTRlkeFseMYY4RHeughUW7wJh/rfPxKzX6OfkZPK', 'AUXILIAR', 'JUAN1628108150.jpg', 20001, 1, '2021-08-04 20:15:50', '2021-08-04 20:15:50'),
(3, '30001', '$2y$10$cNIfFcoQy03PXL66pZ8E4.hU6qGuylh2JkzocOJ1wZqn9fhZkkXcu', 'JEFE DE OBRA', 'MARIO1628108166.jpg', 30001, 1, '2021-08-04 20:16:06', '2021-08-04 20:16:06'),
(4, '10001', '$2y$10$RAh98dLa.MVEAEAcIki.tegdGyKvvNIFk4Qnxp.RzzsUfmizmjTzS', 'ADMINISTRADOR', 'MARIA1628108180.jpg', 10001, 1, '2021-08-04 20:16:20', '2021-08-04 20:16:20'),
(5, 'CONTROL1', '$2y$10$uAvlS7Fgfb34ZO8HrzcUF.AioEgrroEp1GQwQVyPLKYe89JCmkjSO', 'CONTROL', 'user_default.png', 0, 1, '2021-08-04 20:24:03', '2021-08-04 20:24:03'),
(6, '30002', '$2y$10$Ns7UQbPqCYGxq2W0uS.x/uGwO0nzrJEmqcGPKe1jb8sH0QWmeYatS', 'JEFE DE OBRA', 'SANTIAGO1689007127.jpg', 30002, 1, '2023-07-10 16:38:47', '2023-07-10 16:38:47'),
(7, '20002', '$2y$10$3Qk2l3pxxAlqTzpFprEspObUKsbLd4CiXGJAXuMb26Cmvi0IYgRdy', 'AUXILIAR', 'DANIEL1689007172.jpg', 20002, 1, '2023-07-10 16:39:32', '2023-07-10 16:39:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_usuarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingreso_salidas`
--
ALTER TABLE `ingreso_salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingreso_salidas_mo_id_foreign` (`mo_id`);

--
-- Indices de la tabla `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `material_obras`
--
ALTER TABLE `material_obras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_obras_material_id_foreign` (`material_id`),
  ADD KEY `material_obras_obra_id_foreign` (`obra_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `monitoreo_herramientas`
--
ALTER TABLE `monitoreo_herramientas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_obras`
--
ALTER TABLE `nota_obras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_obras_obra_id_foreign` (`obra_id`);

--
-- Indices de la tabla `notificacions`
--
ALTER TABLE `notificacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificacion_users`
--
ALTER TABLE `notificacion_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notificacion_users_notificacion_id_foreign` (`notificacion_id`),
  ADD KEY `notificacion_users_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obra_herramientas`
--
ALTER TABLE `obra_herramientas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obra_herramientas_obra_id_foreign` (`obra_id`);

--
-- Indices de la tabla `obra_herramienta_usos`
--
ALTER TABLE `obra_herramienta_usos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obra_personals`
--
ALTER TABLE `obra_personals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obra_personals_obra_id_foreign` (`obra_id`),
  ADD KEY `obra_personals_personal_id_foreign` (`personal_id`);

--
-- Indices de la tabla `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_herramientas`
--
ALTER TABLE `solicitud_herramientas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_herramientas_solicitud_obra_id_foreign` (`solicitud_obra_id`),
  ADD KEY `solicitud_herramientas_herramienta_id_foreign` (`herramienta_id`);

--
-- Indices de la tabla `solicitud_materials`
--
ALTER TABLE `solicitud_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_materials_solicitud_obra_id_foreign` (`solicitud_obra_id`),
  ADD KEY `solicitud_materials_material_id_foreign` (`material_id`);

--
-- Indices de la tabla `solicitud_notas`
--
ALTER TABLE `solicitud_notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_notas_solicitud_obra_id_foreign` (`solicitud_obra_id`);

--
-- Indices de la tabla `solicitud_obras`
--
ALTER TABLE `solicitud_obras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_personals`
--
ALTER TABLE `solicitud_personals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_personals_solicitud_obra_id_foreign` (`solicitud_obra_id`),
  ADD KEY `solicitud_personals_personal_id_foreign` (`personal_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingreso_salidas`
--
ALTER TABLE `ingreso_salidas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `material_obras`
--
ALTER TABLE `material_obras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `monitoreo_herramientas`
--
ALTER TABLE `monitoreo_herramientas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `nota_obras`
--
ALTER TABLE `nota_obras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notificacions`
--
ALTER TABLE `notificacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `notificacion_users`
--
ALTER TABLE `notificacion_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `obra_herramientas`
--
ALTER TABLE `obra_herramientas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `obra_herramienta_usos`
--
ALTER TABLE `obra_herramienta_usos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `obra_personals`
--
ALTER TABLE `obra_personals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `personals`
--
ALTER TABLE `personals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitud_herramientas`
--
ALTER TABLE `solicitud_herramientas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicitud_materials`
--
ALTER TABLE `solicitud_materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `solicitud_notas`
--
ALTER TABLE `solicitud_notas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_obras`
--
ALTER TABLE `solicitud_obras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud_personals`
--
ALTER TABLE `solicitud_personals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD CONSTRAINT `datos_usuarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `ingreso_salidas`
--
ALTER TABLE `ingreso_salidas`
  ADD CONSTRAINT `ingreso_salidas_mo_id_foreign` FOREIGN KEY (`mo_id`) REFERENCES `material_obras` (`id`);

--
-- Filtros para la tabla `material_obras`
--
ALTER TABLE `material_obras`
  ADD CONSTRAINT `material_obras_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  ADD CONSTRAINT `material_obras_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`);

--
-- Filtros para la tabla `nota_obras`
--
ALTER TABLE `nota_obras`
  ADD CONSTRAINT `nota_obras_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`);

--
-- Filtros para la tabla `notificacion_users`
--
ALTER TABLE `notificacion_users`
  ADD CONSTRAINT `notificacion_users_notificacion_id_foreign` FOREIGN KEY (`notificacion_id`) REFERENCES `notificacions` (`id`),
  ADD CONSTRAINT `notificacion_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `obra_herramientas`
--
ALTER TABLE `obra_herramientas`
  ADD CONSTRAINT `obra_herramientas_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`);

--
-- Filtros para la tabla `obra_personals`
--
ALTER TABLE `obra_personals`
  ADD CONSTRAINT `obra_personals_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `obra_personals_personal_id_foreign` FOREIGN KEY (`personal_id`) REFERENCES `personals` (`id`);

--
-- Filtros para la tabla `solicitud_herramientas`
--
ALTER TABLE `solicitud_herramientas`
  ADD CONSTRAINT `solicitud_herramientas_herramienta_id_foreign` FOREIGN KEY (`herramienta_id`) REFERENCES `herramientas` (`id`),
  ADD CONSTRAINT `solicitud_herramientas_solicitud_obra_id_foreign` FOREIGN KEY (`solicitud_obra_id`) REFERENCES `solicitud_obras` (`id`);

--
-- Filtros para la tabla `solicitud_materials`
--
ALTER TABLE `solicitud_materials`
  ADD CONSTRAINT `solicitud_materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  ADD CONSTRAINT `solicitud_materials_solicitud_obra_id_foreign` FOREIGN KEY (`solicitud_obra_id`) REFERENCES `solicitud_obras` (`id`);

--
-- Filtros para la tabla `solicitud_notas`
--
ALTER TABLE `solicitud_notas`
  ADD CONSTRAINT `solicitud_notas_solicitud_obra_id_foreign` FOREIGN KEY (`solicitud_obra_id`) REFERENCES `solicitud_obras` (`id`);

--
-- Filtros para la tabla `solicitud_personals`
--
ALTER TABLE `solicitud_personals`
  ADD CONSTRAINT `solicitud_personals_personal_id_foreign` FOREIGN KEY (`personal_id`) REFERENCES `personals` (`id`),
  ADD CONSTRAINT `solicitud_personals_solicitud_obra_id_foreign` FOREIGN KEY (`solicitud_obra_id`) REFERENCES `solicitud_obras` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
