<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        $usuario = $_SESSION["nombreUsuario"];
        
        $idGrupo = $_REQUEST["idgrupo"];
        
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "select * from gruposmatriculas, matriculas, personas, estudiantes 
            where gruposmatriculas.idgrupos = '$idGrupo' and gruposmatriculas.idmatricula = matriculas.idmatricula
	and matriculas.cedula = personas.cedula and personas.cedula = estudiantes.cedula";
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
        
        print json_encode(pg_fetch_all($result));
    }