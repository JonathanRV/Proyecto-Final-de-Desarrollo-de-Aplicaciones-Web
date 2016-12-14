
<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        
        $idEval = $_REQUEST["idevaluacion"];
        $nota = $_REQUEST["nota"];
        $cedula = $_REQUEST["cedula"];
                
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "update evaluaciones_estudiantes set nota = '$nota' "
                . "where idevaluacion = '$idEval' and cedula = '$cedula'";
        
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
    }