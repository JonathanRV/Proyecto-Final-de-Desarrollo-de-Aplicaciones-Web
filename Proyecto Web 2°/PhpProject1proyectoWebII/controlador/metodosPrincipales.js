angular.module('myApp', []).controller('userCtrl', function($scope, $http) 
{
    $scope.login = true;
    $scope.estudiante = false;
    $scope.profesor = false;
    $scope.cursosProfesor = '';
    $scope.idEval = 0;
    $scope.numGrupo = 0;
    $scope.codigoCurso = '';
    $scope.idgrupo = 0;
    $scope.totalPorcentaje = 0;
    $scope.cedulaEstudianteNota = 0;
    $scope.nombreEvaluacionEstudiante = '';
    $scope.citasEvaluacionProfesor = ''; 
    $scope.citaEstudianteEvaluacionProfesor = '';
    $scope.cursos = '';
    
    $scope.inicioProfesor = function (){
        
            $scope.login = false;
            $scope.estudiante = false;
            $scope.usuarioProfesor = true;
            $scope.profesorCursos = true;
            $scope.profesorEstudiantes = false;
            $scope.profesorEvaluaciones = false;
            $scope.profesorCitasEvaluaciones = false;
            $scope.profesorEstudianteEvaluaciones = false;
    }
    
    $scope.inicioEstudiante = function (){
        
            $scope.login = false;
            $scope.cursosEstudiante = true;
            $scope.notas = false;
            $scope.citas = false;
            $scope.noHayDatos = false;
            $scope.hayDatos = false;
            
    }
    
    $scope.salirProfesor = function (){
            
            $scope.inputUsuario = "";
            $scope.inputClave = "";
            $scope.login = true;
            $scope.estudiante = false;
            $scope.usuarioProfesor = false;
            $scope.profesorCursos = false;
            $scope.profesorEstudiantes = false;
            $scope.profesorEvaluaciones = false;
            $scope.profesorCitasEvaluaciones = false;
            $scope.profesorEstudianteEvaluaciones = false;
            
    }
    
    $scope.salirEstudiante = function (){
        
            $scope.inputUsuario = "";
            $scope.inputClave = "";
            $scope.login = true;
            $scope.usuarioEstudiante = false;
            $scope.estudiante = false;
            
    }
    
    $scope.ingresar = function() 
    {
        var conAjax = $http.post("../modelo/login.php", {usuario: $scope.inputUsuario, clave: $scope.inputClave});
        conAjax.success(function(respuesta){
            if(respuesta.tipo === "E"){
                $scope.login = false;
                $scope.estudiante = true;
                $scope.cursosEstudiante = true;
                $scope.usuarioEstudiante = true;
                $scope.profesorCursos = false;
                $scope.nombreUsuario = respuesta.nombre +' '+ respuesta.apellido1 +' '+ respuesta.apellido2;
                $http.get("../modelo/obtenerCursos.php")
    .               success(function(response) {$scope.cursos = response});
            }
            else{
                if(respuesta.tipo === "P"){
                    $scope.login = false;
                    $scope.estudiante = false;
                    $scope.usuarioProfesor = true;
                    $scope.profesorCursos = true;
                    $scope.profesorEstudiantes = false;
                    $scope.nombreProfesor = respuesta.nombre +' '+ respuesta.apellido1 +' '+ respuesta.apellido2;
                    $http.get("../modelo/cursosProfesor.php")
                    .success(function(response) {$scope.cursosProfesor = response});
                }
                else{
                        $scope.inputUsuario = "";
                        $scope.inputClave = "";
                        $scope.login = true;
                        $scope.estudiante = false;
                        $scope.profesor = false;
                        $scope.usuarioProfesor = false;
                    }
                }
            
        });
    };    
    
    $scope.mostrarEvaluaciones = function(numgrupo, codigo, idGrupo){
            
            $scope.evaluacionesProfesor = '';
            $scope.numGrupo = numgrupo;
            $scope.codigoCurso = codigo;
            $scope.idgrupo = idGrupo;
            
            $http.get("../modelo/evaluacionesProfesor.php?numgrupo="+numgrupo+"&codigo="+codigo)
            .success(function(response) {$scope.evaluacionesProfesor = response});
            
            $scope.login = false;
            $scope.estudiante = false;
            $scope.usuarioProfesor = true;
            $scope.profesorCursos = false;
            $scope.profesorEvaluaciones = true;
            $scope.profesorCitasEvaluaciones = false;
            $scope.profesorEstudiantes = false;
    };
    
    $scope.mostrarEstudiantesCurso = function(idGrupo){
            
            $scope.estudiantesProfesor = '';
            $scope.idgrupo = idGrupo;
            
            $http.get("../modelo/estudiantesCursoProfesor.php?idgrupo="+idGrupo)
            .success(function(response) {$scope.estudiantesProfesor = response});
            
            $scope.login = false;
            $scope.estudiante = false;
            $scope.usuarioProfesor = true;
            $scope.profesorCursos = false;
            $scope.profesorEvaluaciones = false;
            $scope.profesorCitasEvaluaciones = false;
            $scope.profesorEstudiantes = true;
    };
    
    $scope.mostrarEvaluacionesEstudiante = function (cedula){
            
            $scope.cedulaEstudianteNota = cedula;
            $scope.evaluacionesProfesor = '';
            
            $http.get("../modelo/evaluacionesEstudiantesProfesor.php?cedula="+cedula+"&idgrupo="+$scope.idgrupo)
            .success(function(response) {$scope.evaluacionesEstudianteProfesor = response});
            
            $scope.login = false;
            $scope.estudiante = false;
            $scope.usuarioProfesor = true;
            $scope.profesorCursos = false;
            $scope.profesorEvaluaciones = false;
            $scope.profesorEstudiantes = false;
            $scope.profesorCitasEvaluaciones = false;
            $scope.profesorEstudianteEvaluaciones = true;
    };
    
    $scope.mostrarCitasProfesor = function (idevaluacion){
            
            $scope.idEval = idevaluacion;
            
            $http.get("../modelo/citasEvaluacionProfesor.php?idevaluacion="+$scope.idEval)
            .success(function(response) {$scope.citasEvaluacionProfesor = response});
    
            $scope.login = false;
            $scope.estudiante = false;
            $scope.usuarioProfesor = true;
            $scope.profesorCursos = false;
            $scope.profesorEvaluaciones = false;
            $scope.profesorEstudiantes = false;
            $scope.profesorEstudianteEvaluaciones = false;
            $scope.profesorCitasEvaluaciones = true;
        
    };
    
    $scope.mostrarEstudianteCitaProfesor = function (id){
        
            $http.get("../modelo/citaEstudianteEvaluacionProfesor.php?idevaluacion="+$scope.idEval
                    +"&idcita="+id)
            .success(function(response) {
            
            if(response.length === 0){
                $scope.estudianteCitaProfesorError = true;
                $scope.estudianteCitaProfesor = false;
                $scope.nombreEstudianteCitaProfesor = "";
                $scope.apellido1EstudianteCitaProfesor = "";
                $scope.apellido2EstudianteCitaProfesor = "";
            }
            else{
                $scope.citaEstudianteEvaluacionProfesor = response;
                $scope.nombreEstudianteCitaProfesor = $scope.citaEstudianteEvaluacionProfesor[0].nombre;
                $scope.apellido1EstudianteCitaProfesor = $scope.citaEstudianteEvaluacionProfesor[0].apellido1;
                $scope.apellido2EstudianteCitaProfesor = $scope.citaEstudianteEvaluacionProfesor[0].apellido2;
                $scope.horaInicioCitaProfesor = $scope.citaEstudianteEvaluacionProfesor[0].hora_inicio;
                $scope.horaFinCitaProfesor = $scope.citaEstudianteEvaluacionProfesor[0].hora_fin;
                $scope.fechaCitaProfesor = $scope.citaEstudianteEvaluacionProfesor[0].fecha;
                $scope.estudianteCitaProfesorError = false;
                $scope.estudianteCitaProfesor = true;
            }
            });
    };
    
    $scope.obtenerIdEval = function (id, nombre, porcentaje, idGrupo){
        
        $scope.idEval = id;
        $scope.nombreEdit = nombre;
        $scope.porcentajeEdit = porcentaje;
        $scope.idgrupo = idGrupo;
    };
    
    
    $scope.obtenerIdEvalEditarNota = function (id, nota, nombre){
        
        $scope.idEval = id;
        $scope.notaEstudianteEditar = nota;
        $scope.nombreEvaluacionEstudiante = nombre;
    };
    
    $scope.obtenerIdEvalAgregarNota = function (id, nombre){
        
        $scope.idEval = id;
        $scope.nombreEvaluacionEstudiante = nombre;
    };
    
    $scope.guardar = function (){
                
        $http.get("../modelo/agregarEvaluacionProfesor.php?idgrupo="+$scope.idgrupo+"&nombre="+$scope.nombreNuevo+
                "&porcentaje="+$scope.porcentajeNuevo)
        .success(function(response) {
            $scope.mostrarEvaluaciones($scope.numGrupo, $scope.codigoCurso, $scope.idgrupo);
        });
    };
    
    $scope.guargarCambios = function(){
        
        $http.get("../modelo/modificarEvaluacionProfesor.php?idevaluacion="+$scope.idEval+
                "&nombre="+$scope.nombreEdit+"&porcentaje="+$scope.porcentajeEdit)
        .success(function(response) {
            $scope.mostrarEvaluaciones($scope.numGrupo, $scope.codigoCurso, $scope.idgrupo);
        });
    };
    
    $scope.guargarNotaEstudiante = function(){
        
        $http.get("../modelo/agregarNotaEstudiante.php?idevaluacion="+$scope.idEval+
                "&nota="+$scope.notaEstudianteAgregar+"&cedula="+$scope.cedulaEstudianteNota)
        .success(function(response) {
            $scope.mostrarEvaluacionesEstudiante($scope.cedulaEstudianteNota);
        });
    };
    
    $scope.guargarCambiosNotaEstudiante = function(){
        
        $http.get("../modelo/modificarNotaEstudiante.php?idevaluacion="+$scope.idEval+
                "&nota="+$scope.notaEstudianteEditar+"&cedula="+$scope.cedulaEstudianteNota)
        .success(function(response) {
            $scope.mostrarEvaluacionesEstudiante($scope.cedulaEstudianteNota);
        });
    };
    
    
    $scope.obtenerIdEvalCitaEditar = function (id, horaIni, horaFin, fecha){
        
        $scope.idEval = id;
        $scope.horaInicioEditar = horaIni;
        $scope.horaFinEditar = horaFin;
        $scope.fechaCitaEditar = fecha;
    };
    
    
    $scope.guargarCitaEidtarProfesor = function(){
        
        $http.get("../modelo/modificarCitaEvaluacionProfesor.php?idevaluacion="+$scope.idEval+
                "&fecha="+$scope.fechaCitaEditar+"&horaIni="+$scope.horaInicioEditar
                +"&horaFin="+$scope.horaFinEditar)
        .success(function(response) {$scope.mostrarCitasProfesor($scope.idEval);});
    };
    
    $scope.guargarCitaProfesor = function(){
        
        console.log($scope.idEval);
        console.log($scope.fechaCitaNuevo);
        console.log($scope.horaInicioNuevo);
        console.log($scope.horaFinNuevo);
        $http.get("../modelo/agregarCitaEvaluacionProfesor.php?idevaluacion="+$scope.idEval+
                "&fecha="+$scope.fechaCitaNuevo+"&horaIni="+$scope.horaInicioNuevo
                +"&horaFin="+$scope.horaFinNuevo)
        .success(function(response) {$scope.mostrarCitasProfesor($scope.idEval);
            console.log(response.length)});
    };
    
    
    $scope.$watch('porcentajeEdit',function() {$scope.validarEdit();});
    $scope.$watch('porcentajeNuevo',function() {$scope.validarNueva();});
    
    $scope.$watch('notaEstudianteEditar',function() {$scope.validarNotaEditar();});
    $scope.$watch('notaEstudianteAgregar',function() {$scope.validarNotaAgregar();});
    
    $scope.validarNotaAgregar = function (){
        if (parseInt($scope.notaEstudianteAgregar) > parseInt(100)) 
        {
           $scope.errorNotaAgregar = true;
        }
        else{
            
            $scope.errorNotaAgregar = false;
        }        
    };
    
    $scope.validarNotaEditar = function (){
        if(parseInt($scope.notaEstudianteEditar) > parseInt(100)){
            $scope.errorNotaEditar = true;
        }
        else{
            $scope.errorNotaEditar = false;
        }
    };
    
    $scope.validarEdit = function (){
        
        var total = 0;
        var porcenEdit = 0;
        
        for(i in $scope.evaluacionesProfesor){
            total += parseInt($scope.evaluacionesProfesor[i].porcentaje);
            if($scope.idEval == $scope.evaluacionesProfesor[i].idevaluacion){
                porcenEdit = parseInt($scope.evaluacionesProfesor[i].porcentaje);
            }
        }
        $scope.totalPorcentaje = total;
        var totalGuardar = (total-porcenEdit);
        var x = (totalGuardar + parseInt($scope.porcentajeEdit));
        
        if (parseInt(x) > parseInt(100)) 
        {
           $scope.errorEditar = true;
        }
        else if (parseInt(x) <= parseInt(100)){
            $scope.errorEditar = false;
        }
    };
    $scope.validarNueva = function (){
        
        var total = 0;
        
        for(i in $scope.evaluacionesProfesor){
            total += parseInt($scope.evaluacionesProfesor[i].porcentaje);
        }
        $scope.totalPorcentaje = total;
        
        var x = (total + parseInt($scope.porcentajeNuevo));
        
        if (parseInt(x) > parseInt(100)) 
        {
           $scope.errorNueva = true;
        }
        else if (parseInt(x) <= parseInt(100)){
            $scope.errorNueva = false;
        }
    };
    $scope.evaluacionesEstudiante = "";
    $scope.mostrarCursos = function() 
    {
        $http.get("../modelo/obtenerEvaluaciones.php?idgrupo="+idPrueba).success(function(response){
            if(response.length === 0){
                $scope.noHayDatos = true;
                $scope.hayDatos = false;
            }
            else{
                $scope.hayDatos = true;
                $scope.evaluacionesEstudiante = response;
            }      
        });
    };
    
    
    $scope.citasEvaluacion = "";
    $scope.todasLasCitas = "";
    $scope.verificarCitas = "";
    $scope.idEevaluacion = 0;
    $scope.mostrarCita = function(idEvaluacion) 
    {
            $scope.idEevaluacion = idEvaluacion;
            $http.get("../modelo/obtenerCitas.php?idEvaluacion="+idEvaluacion).success(function(response){$scope.citasEvaluacion = response});
           
                    
            $scope.notas = false;
            $scope.citas = true;
                    
                        
    };
    
    
    $scope.agregarCita = function(idCita) 
    {
        $http.get("../modelo/crearCita.php?idCita="+idCita).success(function(response){
            $scope.mostrarCita($scope.idEevaluacion);
        });
    };
    
    
    $scope.mostrarInformacion = function(idGrupo, codigo,numeroGrupo, nombre) {
        
        $scope.cursosEstudiante = false;
        $scope.notas = true;
        $scope.nombreCurso = nombre;
        
        
        idPrueba = parseInt(idGrupo);
        codigoGrupo = codigo;
        numGrupo = parseInt(numeroGrupo);
    };
});


var jsonPersonas;
var porcentajeObtenido = 0;
var porcentajeTotal = 0;
var porcentajeTotalNoEvaluado = 0;
    
function desplegarNotas(){
    var peticion = new XMLHttpRequest(); 
    peticion.open("GET", "../modelo/obtenerNotasEvaluadas.php?idGrupo="+idPrueba+'&codigoGrupo='+codigoGrupo+'&numGrupo='+numGrupo, true);
    peticion.onreadystatechange=function () 
    {
        if (peticion.readyState===4)
            if(peticion.status===200)
            {
                jsonPersonas=eval("("+ peticion.responseText +")");
                
                
                for(i = 0; i < jsonPersonas.notas1.porcentaje.length; i++){
                    porcentajeObtenido += ((jsonPersonas.notas1.porcentaje[i].porcentaje / 100)*jsonPersonas.notas1.porcentaje[i].nota);
                    porcentajeTotal = (parseInt(porcentajeTotal) + parseInt(jsonPersonas.notas1.porcentaje[i].porcentaje));
                } 
                for(i = 0; i < jsonPersonas.notas2.notaNoEvaluadas.length; i++){
                    porcentajeTotalNoEvaluado = (parseInt(porcentajeTotalNoEvaluado) + parseInt(jsonPersonas.notas2.notaNoEvaluadas[i].porcentaje));
                }  
                
                var barChartData = {
                        labels : ["Evaluacion","Evaluado","Obtenido"],
                        datasets : [
                            {
                                    fillColor : "#6b9dfa",
                                    strokeColor : "#ffffff",
                                    highlightFill: "#1864f2",
                                    highlightStroke: "#ffffff",
                                    data : [porcentajeTotalNoEvaluado,porcentajeTotal,porcentajeObtenido]
                            }
                        ]
                };
                var ctx3 = document.getElementById("grafico").getContext("2d");			
                window.myPie = new Chart(ctx3).Bar(barChartData);
                porcentajeObtenido = 0;
                porcentajeTotal = 0;
                porcentajeTotalNoEvaluado = 0;
            }
    };    
    peticion.send();    
}
    