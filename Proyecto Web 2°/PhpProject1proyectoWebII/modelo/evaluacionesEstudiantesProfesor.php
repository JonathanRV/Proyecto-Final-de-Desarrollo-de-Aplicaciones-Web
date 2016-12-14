<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        
        $cedula = $_REQUEST["cedula"];
        $idGrupo = $_REQUEST["idgrupo"];
                
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "
            (select p.cedula,e.idevaluacion, e.porcentaje, e.nombre, 0 as nota 
            from personas p inner join matriculas m
            on p.cedula = m.cedula
            inner join gruposmatriculas gm
            on m.idmatricula = gm.idmatricula
            inner join grupos g
            on gm.idgrupos = g.idgrupo
            inner join evaluaciones e
            on g.idgrupo = e.idgrupo
            where g.idgrupo = '$idGrupo' and p.cedula= '$cedula' )
            except
            (select p.cedula ,e.idevaluacion, e.porcentaje, e.nombre,0 as nota 
            from personas p inner join evaluaciones_estudiantes ee
            on p.cedula = ee.cedula
            inner join evaluaciones e
            on ee.idevaluacion = e. idevaluacion inner join grupos on grupos.idgrupo=e.idgrupo
            where p.cedula='$cedula'  and  grupos.idgrupo= '$idGrupo')

            union
            select p.cedula, e.idevaluacion, e.porcentaje, e.nombre, ee.nota 
            from personas p inner join evaluaciones_estudiantes ee
            on p.cedula = ee.cedula
            inner join evaluaciones e
            on ee.idevaluacion = e. idevaluacion 
            inner join grupos on grupos.idgrupo=e.idgrupo
            where p.cedula= '$cedula'  and  grupos.idgrupo= '$idGrupo' order by idevaluacion Asc
            ";
        
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
        print json_encode(pg_fetch_all($result));
    }