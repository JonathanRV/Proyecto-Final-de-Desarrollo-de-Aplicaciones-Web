<?php
    session_start();
    
    $idEvaluacion = $_REQUEST["idEvaluacion"];
    
    $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
    //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
    
    $query = "(select citasrevision.idevaluacion, citasrevision.idcita, citasrevision.hora_inicio, citasrevision.hora_fin, citasrevision.fecha 
        from citasrevision where idevaluacion = '$idEvaluacion')
        except
        (select citasrevision.idevaluacion, citasrevision.idcita, citasrevision.hora_inicio, citasrevision.hora_fin, citasrevision.fecha  
        from citasrevision, citasrevision_estudiantes
        where citasrevision.idevaluacion = '$idEvaluacion' and citasrevision_estudiantes.idcita = citasrevision.idcita)";
    
    $result = pg_query($conn, $query) or die("Error durante la consulta de cursos de un profesor");
    $rawdata = array();
    $i=0;
    while ($registro = pg_fetch_array($result)){
            $rawdata[$i] = $registro;
            $i++;
    }
    echo json_encode($rawdata);
    
