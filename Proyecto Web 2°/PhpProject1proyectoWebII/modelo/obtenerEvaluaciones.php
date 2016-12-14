<?php
    session_start();

    
    $idGrupo = $_REQUEST["idgrupo"];
    $usuario = $_SESSION["nombreUsuario"];
    
    $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
    //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
    
    $query = "(select p.cedula,e.idevaluacion, e.nombre, e.porcentaje, 0 as nota 
                from personas p inner join matriculas m
                on p.cedula = m.cedula
                inner join gruposmatriculas gm
                on m.idmatricula = gm.idmatricula
                inner join grupos g
                on gm.idgrupos = g.idgrupo
                inner join evaluaciones e
                on g.idgrupo = e.idgrupo
                where g.idgrupo = '$idGrupo' and p.cedula='$usuario' )
                except
                (select p.cedula ,e.idevaluacion, e.nombre, e.porcentaje, 0 as nota 
                from personas p inner join evaluaciones_estudiantes ee
                on p.cedula = ee.cedula
                inner join evaluaciones e
                on ee.idevaluacion = e. idevaluacion inner join grupos on grupos.idgrupo=e.idgrupo
                where p.cedula='$usuario'  and  grupos.idgrupo='$idGrupo')

                union
                select p.cedula, e.idevaluacion, e.nombre, e.porcentaje, ee.nota 
                from personas p inner join evaluaciones_estudiantes ee
                on p.cedula = ee.cedula
                inner join evaluaciones e
                on ee.idevaluacion = e. idevaluacion 
                inner join grupos on grupos.idgrupo=e.idgrupo
                where p.cedula='$usuario'  and  grupos.idgrupo='$idGrupo' order by idevaluacion Asc";
        
       
    
    $result = pg_query($conn, $query) or die("Error durante la consulta de cursos de un profesor");
    $rawdata = array();
    $i=0;
    while ($registro = pg_fetch_array($result)){

            $rawdata[$i] = $registro;
           // echo json_encode($registro);
            $i++;

    }
    echo json_encode($rawdata);
    
 
