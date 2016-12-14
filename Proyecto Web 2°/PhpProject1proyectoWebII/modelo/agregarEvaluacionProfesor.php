<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        
        $idGrupo = $_REQUEST["idgrupo"];
        $nombreNuevo = $_REQUEST["nombre"];
        $porcentajeNuevo = $_REQUEST["porcentaje"];
                
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "insert into evaluaciones (idgrupo, nombre, porcentaje) "
                . "values('$idGrupo', '$nombreNuevo', '$porcentajeNuevo');";
        
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
    }