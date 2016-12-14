<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        $usuario = $_SESSION["nombreUsuario"];
    
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "select grupos.idgrupo, cursos.nombre, grupos.numgrupo, cursos.codigo from matriculas, gruposmatriculas, grupos, cursos
                    where matriculas.cedula = '$usuario' and matriculas.idmatricula = gruposmatriculas.idmatricula and gruposmatriculas.idestado = 1
                    and gruposmatriculas.idgrupos = grupos.idgrupo and grupos.codigo = cursos.codigo";
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
        
        print json_encode(pg_fetch_all($result));

    }