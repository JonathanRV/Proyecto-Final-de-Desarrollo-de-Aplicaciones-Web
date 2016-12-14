<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
     
        $idEval = $_REQUEST["idevaluacion"];
        $idcita = $_REQUEST["idcita"];
        $usuario = $_SESSION["nombreUsuario"];
        
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "select * from citasrevision, citasrevision_estudiantes, personas where 
            citasrevision.idevaluacion = '$idEval' and citasrevision_estudiantes.idcita = '$idcita' and
citasrevision.idcita = citasrevision_estudiantes.idcita and citasrevision_estudiantes.cedula = personas.cedula";
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
        
        $rawdata = array();
        $i=0;
        while ($registro = pg_fetch_array($result)){

                $rawdata[$i] = $registro;
               // echo json_encode($registro);
                $i++;

        }
        print json_encode($rawdata);
    }