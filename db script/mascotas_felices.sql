-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3360
-- Tiempo de generación: 28-09-2022 a las 07:39:42
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mascotas_felices`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliacion`
--

CREATE TABLE `afiliacion` (
  `id_afiliacion` int(11) NOT NULL,
  `fecha_afiliacion` date NOT NULL,
  `id_mascota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Sano'),
(4, 'Enfermo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas_clientes`
--

CREATE TABLE `mascotas_clientes` (
  `id_mascota` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `tipo_mascota` int(11) NOT NULL,
  `nombre_mascota` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mascotas_clientes`
--

INSERT INTO `mascotas_clientes` (`id_mascota`, `id_propietario`, `tipo_mascota`, `nombre_mascota`, `color`, `estado`) VALUES
(3, 1, 2, 'Zeus', 'Negro', 3),
(4, 10, 3, 'Paco', 'Rojo', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_medicamentos` int(11) NOT NULL,
  `medicamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id_medicamentos`, `medicamento`) VALUES
(2, 'ACETAMINOFEN 500mg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascota`
--

CREATE TABLE `tipo_mascota` (
  `id_tipo_masc` int(11) NOT NULL,
  `tipo_masc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_mascota`
--

INSERT INTO `tipo_mascota` (`id_tipo_masc`, `tipo_masc`) VALUES
(1, 'Perro'),
(2, 'Gato'),
(3, 'Ave'),
(4, 'Conejo'),
(5, 'Hamster'),
(6, 'Tortugas'),
(7, 'Pez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'Admin'),
(2, 'Cliente'),
(3, 'Veterinario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `numero_tar` varchar(20) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `direccion`, `email`, `tipo_usuario`, `numero_tar`, `estado`, `password`, `telefono`) VALUES
(1, 'admin', 'sheesh', 'admin', 'admin@admin.com', 1, '12345', 1, '123456789', '12345'),
(9, 'Kobe', 'Brochero', 'cra 16', 'kbbrochero@gmail.com', 3, '123456', 1, '123456789', '3005966555'),
(10, 'Isaac', 'Pacheco', 'cra 15', 'isaac@gmail.com', 2, '1237654', 1, '1234', '3214345363'),
(11, 'Pepito Perez', '', '', 'example@example.com', 2, '143458943', 1, '123456', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_visitas` int(11) NOT NULL,
  `fecha_visita` datetime NOT NULL,
  `id_veterinario` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `temperatura` double NOT NULL,
  `frecuencia_car` int(11) NOT NULL,
  `recomendaciones` varchar(100) NOT NULL,
  `costo_visita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visitas`, `fecha_visita`, `id_veterinario`, `id_mascota`, `estado`, `temperatura`, `frecuencia_car`, `recomendaciones`, `costo_visita`) VALUES
(1, '2022-09-23 00:00:00', 9, 3, 4, 36, 70, 'Darle los medicamentos recetados', 50000),
(2, '2022-09-26 00:00:00', 9, 4, 4, 37, 70, 'Tomar las medicinas recetadas', 50000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas_medicinas`
--

CREATE TABLE `visitas_medicinas` (
  `id_recibo` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `id_medicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitas_medicinas`
--

INSERT INTO `visitas_medicinas` (`id_recibo`, `id_visita`, `id_medicina`) VALUES
(1, 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD PRIMARY KEY (`id_afiliacion`),
  ADD KEY `fk_afiliaciones_mascotas_idx` (`id_mascota`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `mascotas_clientes`
--
ALTER TABLE `mascotas_clientes`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `fk_mascotasclientes_usuarios_idx` (`id_propietario`),
  ADD KEY `fk_mascotasclientes_tipomascota_idx` (`tipo_mascota`),
  ADD KEY `fk_mascotasclientes_estados` (`estado`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_medicamentos`);

--
-- Indices de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  ADD PRIMARY KEY (`id_tipo_masc`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuarios_tipousuarios_idx` (`tipo_usuario`),
  ADD KEY `fk_usuarios_estados_idx` (`estado`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_visitas`),
  ADD KEY `fk_visitas_usuarios_idx` (`id_veterinario`),
  ADD KEY `fk_visitas_mascotasclientes_idx` (`id_mascota`),
  ADD KEY `fk_visitas_estados_idx` (`estado`);

--
-- Indices de la tabla `visitas_medicinas`
--
ALTER TABLE `visitas_medicinas`
  ADD PRIMARY KEY (`id_recibo`),
  ADD KEY `fk_visitas_idx` (`id_visita`),
  ADD KEY `fk_medicamentos_idx` (`id_medicina`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  MODIFY `id_afiliacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mascotas_clientes`
--
ALTER TABLE `mascotas_clientes`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id_medicamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  MODIFY `id_tipo_masc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `visitas_medicinas`
--
ALTER TABLE `visitas_medicinas`
  MODIFY `id_recibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD CONSTRAINT `fk_afiliaciones_mascotas` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas_clientes` (`id_mascota`);

--
-- Filtros para la tabla `mascotas_clientes`
--
ALTER TABLE `mascotas_clientes`
  ADD CONSTRAINT `fk_mascotasclientes_estados` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estado`),
  ADD CONSTRAINT `fk_mascotasclientes_tipomascota` FOREIGN KEY (`tipo_mascota`) REFERENCES `tipo_mascota` (`id_tipo_masc`),
  ADD CONSTRAINT `fk_mascotasclientes_usuarios` FOREIGN KEY (`id_propietario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_estados` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estado`),
  ADD CONSTRAINT `fk_usuarios_tipousuarios` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `fk_visitas_estados` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estado`),
  ADD CONSTRAINT `fk_visitas_mascotasclientes` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas_clientes` (`id_mascota`),
  ADD CONSTRAINT `fk_visitas_usuarios` FOREIGN KEY (`id_veterinario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `visitas_medicinas`
--
ALTER TABLE `visitas_medicinas`
  ADD CONSTRAINT `fk_medicamentos` FOREIGN KEY (`id_medicina`) REFERENCES `medicamentos` (`id_medicamentos`),
  ADD CONSTRAINT `fk_visitas` FOREIGN KEY (`id_visita`) REFERENCES `visitas` (`id_visitas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
