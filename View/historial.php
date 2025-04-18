<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pacientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Estilos CSS personalizados para la página */
        body{
            font-family: sans-serif; /* Tipo de letra general del cuerpo */
            background-color: #f4f4f4; /* Color de fondo de la página */
        }

        .container{
            max-width: 956px; /* Ancho máximo del contenedor principal */
            margin: 0 auto; /* Centrar el contenedor horizontalmente */
            padding: 20px; /* Espacio interno alrededor del contenido del contenedor */
        }
            .profile-button {
            width: 100px; /* Ancho del botón de perfil */
            height: 100px; /* Alto del botón de perfil */
            border-radius: 50%; /* Hacer el botón circular */
            overflow: hidden; /* Ocultar cualquier parte de la imagen que se salga del círculo */
            display: flex; /* Usar flexbox para centrar la imagen */
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
        }

        .profile-button img {
            width: 100%; /* La imagen ocupa todo el ancho del botón */
            height: 100%; /* La imagen ocupa todo el alto del botón */
            object-fit: cover; /* Ajustar la imagen para cubrir el contenedor sin deformarla */
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-2 bg-dark text-white p-4 sticky-top" style="height: 100vh;">

                <div class="p-3 text-center sticky-top">
                    <img src="Styles/Screenshot_42.png" alt="Foto de perfil" class="rounded-circle img-fluid mb-3" style="width: 100px;">
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Casa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Historial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cerrar Sesión</a>
                    </li>
                </ul>
            </nav>
            <main class="col-md-10 p-4" style="margin-top: 10px;">
                <header class="d-flex justify-content-between align-items-center mb-4 sticky-top bg-light shadow-sm p-3">
                    <h2>Historial de Pacientes</h2>
                    <div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#incluirPacienteModal">
        Incluir Paciente
    </button>

    <div class="modal fade" id="incluirPacienteModal" tabindex="-1" role="dialog" aria-labelledby="incluirPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="incluirPacienteModalLabel">Incluir Nuevo Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                  

    <div class="container mt-5">
        <form action="">
            <header class="mb-4 text-center">
                <h2 class="">Historia de Vida</h2>
               
            </header>

            <section class="form-group">
                <h2 class="h5">Datos Personales</h2>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellidos">Apellido:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="idPacienteModificar">Cédula de Identidad:</label><br>
                        <input type="text" class="form-control" id="idPacienteModificar" placeholder="Cédula ( Inicia con V o E )"><br>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="edad">Edad:</label>
                        <input type="number" class="form-control" id="Edad" name="Edad" required> 
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_nacimiento">F. de nac:</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="localidad">Localidad:</label>
                        <input type="text" class="form-control" id="Localidad" name="Localidad" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="estado_civil">Estado civil:</label>
                        <select class="form-control" id="estado_civil" name="estado_civil" required>
                            <option value="target_blank"></option>
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                            <option value="divorciado">Divorciado</option>
                            <option value="viudo">Viudo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="profesion">Profesión:</label>
                        <input type="text" class="form-control" id="profesion" name="profesion" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="estudios">Estudios:</label>
                    <input type="text" class="form-control" id="estudios" name="estudios" required>
                </div>
                <div class="form-group">
                    <label>¿Cómo nos has conocido?</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="Amigos/familia" name="conocido" value="Amigos/familia" required>
                        <label class="form-check-label" for="Amigos/familia">Amigos/familia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="Instagram" name="conocido" value="Instagram">
                        <label class="form-check-label" for="Instagram">Instagram</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="Google" name="conocido" value="Google">
                        <label class="form-check-label" for="Google">Google</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="Otros" name="conocido" value="Otros">
                        <label class="form-check-label" for="Otros">Otros</label>
                    </div>
                </div>
            </section>

            <div class="alert alert-info" role="alert">
                <b>A continuación, rellena aquellos apartados/preguntas que consideres que son necesarios para el tratamiento</b>
            </div>

            <section>
                <h3 class="h5">Análisis funcional</h3>
                <p><b>Del siguiente listado, ¿Qué sensación presentas actualmente?:</b></p>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="tensión" name="sintoma" value="tensión" required>
                            <label class="form-check-label" for="Tensión">Tensión</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="taquicardia" name="sintoma" value="taquicardia">
                            <label class="form-check-label" for="Taquicardia">Taquicardia</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Fracaso" name="sintoma" value="Fracaso">
                            <label class="form-check-label" for="Fracaso">Fracaso</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Presión en el pecho" name="sintoma" value="Presión en el pecho">
                            <label class="form-check-label" for="Presión en el pecho">Presión en el pecho</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Ansiedad" name="sintoma" value="Ansiedad" required>
                            <label class="form-check-label" for="Tensión">Ansiedad</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Presión" name="sintoma" value="Presión">
                            <label class="form-check-label" for="Presión">Presión</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Celos" name="sintoma" value="Celos">
                            <label class="form-check-label" for="Celos">Celos</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Problemas de pareja" name="sintoma" value="Problemas de pareja">
                            <label class="form-check-label" for="Problemas de pareja">Problemas de pareja</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Flojedad" name="sintoma" value="Flojedad" required>
                            <label class="form-check-label" for="Flojedad">Flojedad</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Irritabilidad" name="Irritabilidad" value="Irritabilidad">
                            <label class="form-check-label" for="Irritabilidad">Irritabilidad</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Miedo" name="sintoma" value="Miedo">
                            <label class="form-check-label" for="Miedo">Miedo</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Dificultades sexuales" name="sintoma" value="Dificultades sexuales">
                            <label class="form-check-label" for="Dificultades sexuales">Dificultades sexuales</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Sudor" name="sintoma" value="Sudor" required>
                            <label class="form-check-label" for="Sudor">Sudor</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Culpa" name="sintoma" value="Culpa">
                            <label class="form-check-label" for="Culpa">Culpa</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Desconfianza" name="sintoma" value="Desconfianza">
                            <label class="form-check-label" for="Desconfianza">Desconfianza</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Problemas familiares" name="sintoma" value="Problemas familiares">
                            <label class="form-check-label" for="Problemas familiares">Problemas familiares</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Mareo" name="sintoma" value="Mareo" required>
                            <label class="form-check-label" for="Mareo">Mareo</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Cansancio" name="sintoma" value="Cansancio" required>
                            <label class="form-check-label" for="Cansancio">Cansancio</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Sueño" name="sintoma" value="Sueño">
                            <label class="form-check-label" for="Sueño">Sueño</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Nerviosismo" name="sintoma" value="Nerviosismo">
                            <label class="form-check-label" for="Nerviosismo">Nerviosismo</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="otros_sintomas">Otros síntomas:</label>
                    <textarea class="form-control" id="otros_sintomas" rows="3"></textarea>
                </div>
            </section>

            <section>
                <h2 class="h2">Organismo</h2>

                <div class="form-group">
                    <label for="convivencia">¿Con quién convives actualmente?</label>
                    <textarea class="form-control" id="convivencia" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="relacion_mejorar">¿Cambiarías/mejorarías tu relación con alguno de ellos? ¿Por qué?</label>
                    <textarea class="form-control" id="relacion_mejorar" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="area_conflictiva">¿Destacarías alguna área conflictiva en tu relación con tu familia/pareja que quisieras trabajar en terapia? (Entendiendo área como comunicación, relaciones sexuales en el caso de tu pareja...)</label>
                    <textarea class="form-control" id="area_conflictiva" rows="3"></textarea>
                </div>
           
                <h3 class="h5">Hábitos y estilo de vida</h3>

                <div class="form-group">
                    <label>¿Consumes alcohol?</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="alcohol_si" name="alcohol" value="si" required>
                        <label class="form-check-label" for="alcohol_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="alcohol_no" name="alcohol" value="no">
                        <label class="form-check-label" for="alcohol_no">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="frecuencia_alcohol">¿Con qué frecuencia y cuánta cantidad?</label>
                    <textarea class="form-control" id="frecuencia_alcohol" rows="2"></textarea>
                </div>

                
                <div class="form-group">
                    <label>¿Fumas o vapeas?</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="fumar_si" name="fumar" value="si" required>
                        <label class="form-check-label" for="fumar_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="fumar_no" name="fumar" value="no">
                        <label class="form-check-label" for="fumar_no">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="frecuencia_fumar">¿Con qué frecuencia y cuánta cantidad?</label>
                    <textarea class="form-control" id="frecuencia_fumar" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label>¿Consumes algún otro tipo de sustancia?</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="sustancia_si" name="sustancia" value="si" required>
                        <label class="form-check-label" for="sustancia_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="sustancia_no" name="sustancia" value="no">
                        <label class="form-check-label" for="sustancia_no">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="frecuencia_sustancia">Indica cuál y con qué frecuencia</label>
                    <textarea class="form-control" id="frecuencia_sustancia" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label for="rutina_sueno">Explica brevemente tu rutina de sueño (tiempo, calidad y si haces siesta...)</label>
                    <textarea class="form-control" id="rutina_sueno" rows="3"></textarea>
                </div>
      
                <h3 class="h5">Tratamientos anteriores</h3>
                <div class="form-group">
                    <label>¿Has acudido al psicólogo o psiquiatría anteriormente? ¿Qué tipo de tratamiento recibió?</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="no_acudido" name="acudido" value="no" required>
                        <label class="form-check-label" for="no_acudido">No</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="psicologo" name="acudido" value="psicólogo">
                        <label class="form-check-label" for="psicologo">Psicólogo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="psiquiatra" name="acudido" value="psiquiatra">
                        <label class="form-check-label" for="psiquiatra">Psiquiatra</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="otro_acudido" name="acudido" value="otro">
                        <label class="form-check-label" for="otro_acudido">Otro</label>
                    </div>
                    <textarea class="form-control mt-2" name="tratamiento_recibido" rows="2" placeholder="Especifica el tratamiento recibido"></textarea>
                </div>

                <div class="form-group">
                    <label for="finalizado_tratamiento">¿Finalizaste el tratamiento? En caso negativo, ¿por qué razón?</label>
                    <textarea class="form-control" id="finalizado_tratamiento" rows="2"></textarea>
                </div>
           
                <h3 class="h5">Preguntas relativas</h3>
                <div class="form-group">
                    <label for="personas_significativas">¿Cuáles son las personas más significativas de tu vida actualmente?</label>
                    <textarea class="form-control" id="personas_significativas" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="ayuda_terapia">¿Cuál o cuáles crees que podrían ayudarte durante tu terapia?</label>
                    <textarea class="form-control" id="ayuda_terapia" rows="3"></textarea>
                </div>
           
                <h3 class="h5">Motivación y compromiso</h3>
                <div class="form-group">
                    <label for="espera_terapia">¿Qué esperas conseguir cuando finalice la terapia?</label>
                    <textarea class="form-control" id="espera_terapia" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="compromiso_terapia">Del 1 al 10 ¿Cuál es tu compromiso hacia la terapia?</label>
                    <input type="number" class="form-control" id="compromiso_terapia" name="compromiso_terapia" min="1" max="10">
                </div>

                <div class="form-group">
                    <label for="duracion_terapia">¿Cuánto tiempo crees que durará la terapia?</label>
                    <textarea class="form-control" id="duracion_terapia" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label for="importante_reflejar">¿Hay algo que no haya aparecido aquí pero consideras importante reflejar para abordar de manera adecuada el tratamiento? en caso afirmativo, indícalo</label>
                    <textarea class="form-control" id="importante_reflejar" rows="3"></textarea>
                </div>
            </section>

            <hr class="my-4">

        </form>
    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success">Guardar Paciente</button>
                </div>
            </div>
        </div>
    </div>

   

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modificarPacienteModal">
            Modificar Paciente
        </button>
    
        <div class="modal fade" id="modificarPacienteModal" tabindex="-1" role="dialog" aria-labelledby="modificarPacienteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modificarPacienteModalLabel">Modificar Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nombrePacienteModificar">Nombre:</label>
                                <input type="text" class="form-control" id="nombrePacienteModificar" placeholder="Ingrese el nuevo nombre">
                            </div>
                            <div class="form-group">
                                <label for="apellidoPacienteModificar">Apellido:</label>
                                <input type="text" class="form-control" id="apellidoPacienteModificar" placeholder="Ingrese el nuevo apellido">
                            </div>
                            <div class="form-group">
                                <label for="idPacienteModificar">Cédula de identidad:</label>
                                <input type="text" class="form-control" id="idPacienteModificar" placeholder="Cédula ( Inicia con V o E )">
                            </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                </header>
                <div class="input-group mb-4">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente por nombre, cédula..." onkeyup="buscarPacientesEnTiempoReal()">
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4" id="pacientesContainer">
                    <?php
                    // Aquí se va ha iterar el array de pacientes en PHP
                    $pacientes = [
                        ['nombre' => 'María Pérez', 'cedula' => 'V-12345678', 'fecha_nacimiento' => '15/03/1988', 'id' => '1'],
                        ['nombre' => 'José Rodríguez', 'cedula' => 'E-98765432', 'fecha_nacimiento' => '28/09/1995', 'id' => '2'],
                        ['nombre' => 'Ana Gómez', 'cedula' => 'V-54321876', 'fecha_nacimiento' => '02/07/1979', 'id' => '3'],
                        ['nombre' => 'Carlos López', 'cedula' => 'E-11223344', 'fecha_nacimiento' => '20/01/2000', 'id' => '4'],
                        ['nombre' => 'Laura Vargas', 'cedula' => 'V-99887766', 'fecha_nacimiento' => '05/11/1992', 'id' => '5'],
                        ['nombre' => 'Sofía Martínez', 'cedula' => 'V-76543210', 'fecha_nacimiento' => '10/06/1990', 'id' => '6'],
                        // ... más pacientes
                    ];

                    foreach ($pacientes as $paciente) {
                        echo '<article class="col mb-4 paciente-card" data-nombre="' . htmlspecialchars($paciente['nombre']) . '" data-cedula="' . htmlspecialchars($paciente['cedula']) . '" data-paciente-id="' . htmlspecialchars($paciente['id']) . '">';
                        echo '     <div class="card">';
                        echo '         <div class="card-body">';
                        echo '             <h5 class="card-title">' . htmlspecialchars($paciente['nombre']) . '</h5>';
                        echo '             <p class="card-text">Cédula: ' . htmlspecialchars($paciente['cedula']) . '</p>';
                        echo '             <p class="card-text">Fecha de Nacimiento: ' . htmlspecialchars($paciente['fecha_nacimiento']) . '</p>';
                        echo '             <div class="d-flex justify-content-between align-items-center">';
                        echo '                 <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal"';
                        echo '                         data-nombre-paciente="' . htmlspecialchars($paciente['nombre']) . '"';
                        echo '                         data-cedula-paciente="' . htmlspecialchars($paciente['cedula']) . '"';
                        echo '                         data-fecha-nacimiento="' . htmlspecialchars($paciente['fecha_nacimiento']) . '">';
                        echo '                     Ver Detalles';
                        echo '                 </button>';
                        echo '                 <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarPacienteModal-' . htmlspecialchars($paciente['id']) . '">';
                        echo '                     <i class="bi bi-trash3-fill eliminar-icono-tarjeta"></i> Eliminar';
                        echo '                 </button>';
                        echo '             </div>';
                        echo '         </div>';
                        echo '     </div>';

                        // Modal de Eliminar Paciente para cada tarjeta
                        echo '<div class="modal fade" id="eliminarPacienteModal-' . htmlspecialchars($paciente['id']) . '" tabindex="-1" aria-labelledby="eliminarPacienteModalLabel-' . htmlspecialchars($paciente['id']) . '" aria-hidden="true">';
                        echo '    <div class="modal-dialog">';
                        echo '        <div class="modal-content">';
                        echo '            <div class="modal-header bg-warning text-dark">';
                        echo '                <h5 class="modal-title" id="eliminarPacienteModalLabel-' . htmlspecialchars($paciente['id']) . '">Confirmar Eliminación</h5>';
                        echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                        echo '            </div>';
                        echo '            <div class="modal-body">';
                        echo '                <p>¿Está seguro de que desea eliminar a <strong>' . htmlspecialchars($paciente['nombre']) . '</strong>?</p>';
                        echo '                <p class="text-danger">Esta acción no se puede deshacer.</p>';
                        echo '            </div>';
                        echo '            <div class="modal-footer">';
                        echo '                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
                        echo '                <button type="button" class="btn btn-danger" onclick="eliminarPaciente(\'' . htmlspecialchars($paciente['id']) . '\')">Eliminar Paciente</button>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';

                        echo '</article>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="verDetallesModal" tabindex="-1" role="dialog" aria-labelledby="verDetallesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verDetallesModalLabel">Detalles del Paciente</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formularioVerDetalles">
                        <div class="form-group">
                            <label for="nombre_detalle">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_detalle" name="nombre_detalle" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="cedula_detalle">Cédula:</label>
                            <input type="text" class="form-control" id="cedula_detalle" name="cedula_detalle" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento_detalle">Fecha de Nacimiento:</label>
                            <input type="text" class="form-control" id="fecha_nacimiento_detalle" name="fecha_nacimiento_detalle" value="" readonly>
                        </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-light text-center p-3">
        <p>&copy; 2023 Historial de Pacientes. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script>
        function buscarPacientesEnTiempoReal() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const pacienteCards = document.querySelectorAll('.paciente-card');

            pacienteCards.forEach(card => {
                const nombre = card.dataset.nombre.toLowerCase();
                const cedula = card.dataset.cedula.toLowerCase();

                if (nombre.includes(searchTerm) || cedula.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        $(document).ready(function() {
            $('#verDetallesModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var nombre = button.data('nombre-paciente'); // Extrae la información de los atributos data-*
                var cedula = button.data('cedula-paciente');
                var fechaNacimiento = button.data('fecha-nacimiento');
                // Puedes extraer más datos aquí según los atributos data-* que hayas añadido

                var modal = $(this);
                modal.find('.modal-title').text('Detalles de ' + nombre); // Actualiza el título del modal
                modal.find('#nombre_detalle').val(nombre); // Llena los campos del formulario con la información
                modal.find('#cedula_detalle').val(cedula);
                modal.find('#fecha_nacimiento_detalle').val(fechaNacimiento);
                // Llena más campos del formulario aquí si es necesario
            });
        });

        function eliminarPaciente(pacienteId) {
            console.log('Eliminar paciente con ID:', pacienteId);

            const modal = document.getElementById('eliminarPacienteModal-' + pacienteId);
            const modalBootstrap = bootstrap.Modal.getInstance(modal);
            if (modalBootstrap) {
                modalBootstrap.hide();
            }
        }
    </script>
</body>
</html>
</body>
</html>