<?php
    session_start();
    if (isset( $_SESSION["nombreUsuario"]))
    {
        $usuario = $_SESSION["nombreUsuario"];
        $idGrupo = $_REQUEST["idGrupo"];
        $codigoGrupo = $_REQUEST["codigoGrupo"];
        $numGrupo = $_REQUEST["numGrupo"];
    
        $conn = pg_connect("host=localhost port=5432 dbname=SegundoProyecto user=postgres password=12345");
        //$conn = pg_connect("host=172.24.28.21 port=5433 dbname=SegundoProyecto user=usrSegundoProyecto password=12345");
        
        $query = "select * from evaluaciones, evaluaciones_estudiantes, estudiantes, grupos where 
                estudiantes.cedula = '$usuario' and estudiantes.cedula = evaluaciones_estudiantes.cedula
            and evaluaciones_estudiantes.idevaluacion = evaluaciones.idevaluacion and grupos.idgrupo = '$idGrupo' 
            and grupos.idgrupo = evaluaciones.idgrupo";
        
        $query1 = "select * from cursos, grupos, evaluaciones where cursos.codigo = '$codigoGrupo' and cursos.codigo = grupos.codigo and grupos.numgrupo = '$numGrupo'
            and grupos.idgrupo = evaluaciones.idgrupo";
        
        $result = pg_query($conn,$query) or die ("<strong>Error durante la consulta.</strong>");
        $result1 = pg_query($conn,$query1) or die ("<strong>Error durante la consulta.</strong>");
        
        class notas1{
            var $porcentaje;

            function __construct($porcentaje){
                $this->porcentaje = $porcentaje;
            }
        }
        class notas2{
            var $notasNoEvaluadas;

            function __construct($notaNoEvaluadas){
                $this->notaNoEvaluadas = $notaNoEvaluadas;
            }
        }
        class total{
            var $notas1;
            var $notas2;

            function __construct($notas1,$notas2){
                $this->notas1 = $notas1;
                $this->notas2 = $notas2;
            }
        }
        $datos = new notas1(pg_fetch_all($result));
        $datos1 = new notas2(pg_fetch_all($result1));
        $fin = new total($datos,$datos1);
        print_r(json_encode($fin)); 
    }