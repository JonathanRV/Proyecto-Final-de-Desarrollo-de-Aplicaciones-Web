<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        $idEval = $_REQUEST["idevaluacion"];
        $horaInicio = $_REQUEST["horaIni"];
        $horaFin = $_REQUEST["horaFin"];
        $fecha = $_REQUEST["fecha"];
    
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "insert into citasrevision (idevaluacion, fecha, hora_inicio, hora_fin) "
                . "values('$idEval', '$fecha', '$horaInicio', '$horaFin');";
        
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
    }