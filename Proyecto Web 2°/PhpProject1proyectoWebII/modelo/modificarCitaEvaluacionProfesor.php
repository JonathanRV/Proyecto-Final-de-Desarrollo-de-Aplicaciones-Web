
<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        
        $idEval = $_REQUEST["idevaluacion"];
        $hora_inicio = $_REQUEST["horaIni"];
        $hora_fin = $_REQUEST["horaFin"];
        $fecha = $_REQUEST["fecha"];
                
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "update citasrevision set fecha = '$fecha', hora_inicio = '$hora_inicio', hora_fin = '$hora_fin'"
                . "where idevaluacion = '$idEval'";
        
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
    }
