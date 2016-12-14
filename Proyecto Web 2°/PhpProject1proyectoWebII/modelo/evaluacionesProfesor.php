<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        
        $numGrupo = $_REQUEST["numgrupo"];
        $codigo = $_REQUEST["codigo"];
                
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "select grupos.idgrupo, evaluaciones.idevaluacion, evaluaciones.nombre, evaluaciones.porcentaje
            from grupos, evaluaciones where grupos.numgrupo = '$numGrupo' and grupos.codigo = '$codigo' 
            and grupos.idgrupo = evaluaciones.idgrupo";
        
        $result = pg_query($conn, $query) or die("Error durante la consulta de cursos de un profesor.");
        $rawdata = array();
        $i=0;
        while ($registro = pg_fetch_array($result)){

                $rawdata[$i] = $registro;
               // echo json_encode($registro);
                $i++;

        }
        print json_encode($rawdata);
    }