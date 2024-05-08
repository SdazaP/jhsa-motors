<?php
        // Incluir el archivo de conexión a la base de datos
        include("../model/bd.php");

        // Definir el número de resultados por página
        $resultados_por_pagina = 4;

        // Obtener el número total de resultados
        $sql_total = "SELECT COUNT(id) AS total FROM carros";
        $resultado_total = $conexion->query($sql_total);
        $total_resultados = $resultado_total->fetch(PDO::FETCH_ASSOC)["total"];

        // Calcular el número total de páginas
        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

        // Obtener el número de página actual
        $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

        // Calcular el índice de inicio para la consulta
        $indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

        // Obtener los resultados para la página actual
        $sql = "SELECT * FROM carros LIMIT $indice_inicio, $resultados_por_pagina";
        $resultado = $conexion->query($sql);

        function obtenerMarcaPorId($marcaId, $conexion)
        {
            $sql = "SELECT nombre FROM marca WHERE id = :marcaId";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':marcaId', $marcaId, PDO::PARAM_INT);
            $stmt->execute();
            $marca = $stmt->fetch(PDO::FETCH_ASSOC);
            return $marca['nombre'];
        }
?>