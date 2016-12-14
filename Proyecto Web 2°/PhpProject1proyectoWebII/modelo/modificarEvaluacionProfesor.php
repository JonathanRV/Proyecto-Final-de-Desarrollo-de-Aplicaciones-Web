
<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        
        $idEval = $_REQUEST["idevaluacion"];
        $nombreNuevo = $_REQUEST["nombre"];
        $porcentajeNuevo = $_REQUEST["porcentaje"];
                
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "update evaluaciones set nombre = '$nombreNuevo', porcentaje = '$porcentajeNuevo' "
                . "where idevaluacion = '$idEval'";
        
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
    }