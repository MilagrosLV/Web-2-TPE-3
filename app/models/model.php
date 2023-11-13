<?php
    class Model {
        protected $db;

        function __construct() {
            $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        }

        private function deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables) == 0) {
                // Si no hay crearlas
                $sql =<<<END

                --
                -- Estructura de tabla para la tabla `sugerencias`
                --
                
                CREATE TABLE `sugerencias` (
                  `id` int(11) NOT NULL,
                  `titulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                  `descripción` text COLLATE utf8_unicode_ci DEFAULT NULL,
                  `genero` int(12) NOT NULL,
                  `prioridad` int(12) NOT NULL,
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
                --
                -- Volcado de datos para la tabla `sugerencias`
                --
                
                INSERT INTO `sugerencias` (`id`, `titulo`, `genero`, `descripción`, `prioridad`) VALUES
                (12, 'fvgbhnjmk,.', 1, 'xdfghjklñ{', 1),
                (13, 'vbnm,', 2, 'vbnm,.<-', 1),
                (14, 'cvbnm,.', 3, 'cvbnm,.-', 1),
                (15, 'cvbnm,.', 1, 'cvbnm,.-', 2),
                (16, 'vbnm,.-', 1, 'vbnm,.-', 3),
                (17, ' fghjklñ<', 2, 'oiuyt', 2, 1),
                (18, '345678', 2, '98765', 3),
                (19, '3456789', 3, 'sdfghjklñ', 3),
                (20, 'jnhbgvcx', 3, '09876', 2),
                (21, 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 'bbbbbbbbbbbbb', 2);
                --
                -- Índices para tablas volcadas
                --
                
                --
                -- Indices de la tabla `sugerencias`
                --
                ALTER TABLE `sugerencias`
                  ADD PRIMARY KEY (`id`);
                
                --
                -- AUTO_INCREMENT de las tablas volcadas
                --
                
                --
                -- AUTO_INCREMENT de la tabla `sugerencias`
                --
                ALTER TABLE `sugerencias`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
                COMMIT;
                
                END;
                $this->db->query($sql);
            }
            
        }
    }