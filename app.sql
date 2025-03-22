CREATE TABLE `programadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tecnologias` (
  `id` int(11) NOT NULL,
  `tecnologia` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tecnologias` (`id`, `tecnologia`, `status`) VALUES
(1, 'C', 1),
(2, 'C#', 1),
(3, 'C++', 1),
(4, 'CSS', 1),
(5, 'GO', 1),
(6, 'HTML', 1),
(7, 'JAVA', 1),
(8, 'JAVASCRIPT', 1),
(9, 'JQUERY', 1),
(10, 'NODEJS', 1),
(11, 'PERL', 1),
(12, 'PHP', 1),
(13, 'PYTHON', 1),
(14, 'R', 1),
(15, 'SQL', 1);


CREATE TABLE `tecnologias_programador` (
  `id` int(11) NOT NULL,
  `programador_id` int(11) NOT NULL,
  `tecnologia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tecnologias_programador` (`id`, `programador_id`, `tecnologia_id`) VALUES
(450, 53, 1),
(451, 53, 7),
(452, 53, 12);

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuarios` (`id`, `email`, `username`, `password`, `creat_at`, `status`) VALUES
(5, 'raulparedes.developer@gmail.com', 'raul', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2025-03-21 19:15:42', 0);

ALTER TABLE `programadores`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tecnologias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tecnologias_programador`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `programadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

ALTER TABLE `tecnologias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `tecnologias_programador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
