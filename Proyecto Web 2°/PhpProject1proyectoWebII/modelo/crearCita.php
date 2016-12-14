<?php
    session_start();
    
    $idEvaluacion = $_REQUEST["idCita"];
    $usuario = $_SESSION["nombreUsuario"];
    
    $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
    //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
    
    $query = "insert into citasrevision_estudiantes (cedula, idcita) values ('$usuario', '$idEvaluacion')";
    pg_query($conn, $query) or die("Error durante la consulta de cursos de un profesor");
    