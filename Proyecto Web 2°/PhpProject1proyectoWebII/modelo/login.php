<?php
    session_start();
    $objDatos = json_decode(file_get_contents("php://input"));

    $usuario=$objDatos->usuario;
    $clave=$objDatos->clave;
    $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
    //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
    
    $query = "Select * from usuarios where cedula='$usuario' and contraseña='$clave'";
    $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");

    $_SESSION["nombreUsuario"]= $usuario;
    
    
    class datosUsuario{
        var $nombre;
        var $apellido1;
        var $apellido2;
        var $tipo;
   
        function __construct($nombre,$apellido1,$apellido2,$tipo){
            $this->nombre = $nombre;
            $this->apellido1 = $apellido1;
            $this->apellido2 = $apellido2;
            $this->tipo = $tipo;
        }
    }
    if (!$row = pg_fetch_array($result)){
      header("Location: ../vista/index.html" );
    }
    else{
        $query1 = "Select * from personas where cedula='$row[0]'";
        $result1 = pg_query($conn,$query1) or die ("<strong>Error durante la consulta.</strong>");
        $row1 = pg_fetch_array($result1);
        $datos = new datosUsuario($row1[1], $row1[2], $row1[3], $row[2]);
        
        print_r(json_encode($datos)); 
    }
?>