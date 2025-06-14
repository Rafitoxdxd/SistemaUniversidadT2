<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pacientes</title>
    <link rel="stylesheet" href="css/navegacion.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <?php require_once("menu/menu.php"); ?>
        <style>
            /* Paleta de colores para un estilo más elegante en tonos de gris y azul */

            /* Importar fuente de Google Fonts (asegúrate de que el usuario tenga conexión) */
            @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');


            /* Ajuste para el contenido principal */
            .col-md-9.ml-sm-auto {
                margin-left: 17%;
                padding: 40px;
                background-color: var(--main-content-bg);
                min-height: 100vh;
            }

            /* Estilo para los datos del perfil dentro del card */
            .card {
                border: none;
                box-shadow: 0 12px 25px rgba(0,0,0,0.25); /* Sombra del card más fuerte */
                border-radius: 20px;
                overflow: hidden;
                background: linear-gradient(160deg, #eaf2f8, #dee2e6); /* Degradado suave en grises muy claros */
            }

            .card-body {
                padding: 30px;
            }

            .card-title {
                color: #212529; /* Gris oscuro para el título del card */
                font-weight: 700;
                margin-bottom: 25px;
                text-shadow: 1px 1px 3px rgba(0,0,0,0.15);
            }

            .card ul {
                padding-left: 0;
            }

            .card li {
                list-style: none;
                padding: 12px 0;
                border-bottom: 1px dotted rgba(0, 0, 0, 0.2);
                color: #343a40;
                font-size: 1.05rem;
                display: flex;
                align-items: center;
                line-height: 1.5;
            }

            .card li strong {
                color: #212529;
                margin-right: 15px;
            }

            .card li:last-child {
                border-bottom: none;
            }

            /* Media query para pantallas pequeñas (ajustes para la diversión móvil) */
            
        </style>

</head>
<body>
    
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <header class="header d-flex justify-content-between align-items-center mb-4 sticky-top bg-light shadow-sm p-3">
                <h2>Historial de Pacientes</h2>
                
                <div class="profile-icon-container">  
                    <a href='?pagina=profile' title="Mi Perfil">  
                        <i class="bi bi-person" style="font-size: 40px; color: #6c757d;"></i>  
                    </a>  
                </div>

                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente por nombre, cédula..." onkeyup="buscarPacientesEnTiempoReal()">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#incluirPacienteModal">Incluir Paciente</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal">Modificar Paciente</button>
                </div>
            </header>
            
            <div class="cont" id="pacientesContainer">
                <div class="row">
                    <?php
                    $pacientes = Historial::cargarHistoriales();
                    foreach ($pacientes as $paciente) {
                        $datosPaciente = json_decode($paciente->getDatos(), true);
                        echo '<div class="col-12 col-md-6 mb-4 paciente-card" data-nombre="' . $datosPaciente['nombre'] . '" data-cedula="' . $datosPaciente['cedula'] . '" data-paciente-id="' . $paciente->getId() . '">';
                        echo '  <div class="card" style="width: 100%;">';
                        echo '      <div class="card-body">';
                        echo '          <h5 class="card-title">' . htmlspecialchars($datosPaciente['nombre']) . '</h5>';
                        echo '          <p class="card-text">Cédula: ' . htmlspecialchars($datosPaciente['cedula']) . '</p>';
                        echo '          <p class="card-text">Fecha de Nacimiento: ' . htmlspecialchars($datosPaciente['fecha_nacimiento']) . '</p>';
                        echo '          <div class="d-flex justify-content-between align-items-center">';
                        echo '              <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal"';
                        echo '                  data-nombre-paciente="' . htmlspecialchars($datosPaciente['nombre']) . '"';
                        echo '                  data-cedula-paciente="' . htmlspecialchars($datosPaciente['cedula']) . '"';
                        echo '                  data-fecha-nacimiento="' . htmlspecialchars($datosPaciente['fecha_nacimiento']) . '">';
                        echo '                  Ver Detalles';
                        echo '              </button>';
                        echo '              <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarPacienteModal-' . $paciente->getId() . '">';
                        echo '                  <i class="bi bi-trash3-fill eliminar-icono-tarjeta"></i> Eliminar';
                        echo '              </button>';
                        echo '          </div>';
                        echo '      </div>';
                        echo '  </div>';

                        // Modal de Eliminar Paciente para cada tarjeta
                        echo '<div class="modal fade" id="eliminarPacienteModal-' . $paciente->getId() . '" tabindex="-1" aria-labelledby="eliminarPacienteModalLabel-' . $paciente->getId() . '" aria-hidden="true">';
                        echo '    <div class="modal-dialog">';
                        echo '        <div class="modal-content">';

                        echo '        <form  action="" method="POST">';

                        echo '            <div class="modal-header bg-warning text-dark">';
                        echo '                <h5 class="modal-title" id="eliminarPacienteModalLabel-' . $paciente->getId() . '">Confirmar Eliminación</h5>';
                        echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                        echo '            </div>';
                        echo '            <div class="modal-body">';
                        echo '                <p>¿Está seguro de que desea eliminar a <strong>' . htmlspecialchars($datosPaciente['nombre']) . '</strong>?</p>';
                        echo '                <p class="text-danger">Esta acción no se puede deshacer.</p>';
                        echo '            </div>';
                        echo '            <div class="modal-footer">';
                        echo '                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
                        //hidden text
                        echo '                <input type="text" name="idPacienteEliminar" value="' . $paciente->getId() . '" hidden  name="eliminar"/>';    
                        echo '                <input type="submit" class="btn btn-danger" name="eliminar"/>';
                        echo '            </div>';

                        echo '        </form>';

                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="incluirPacienteModal" tabindex="-1" aria-labelledby="incluirPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="incluirPacienteModalLabel">Incluir Nuevo Paciente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <form action="" method="POST">
                        <header class="mb-4 text-center">
                            <h2 class="">Historia de Vida</h2>
                        </header>

                        <section class="mb-3">
                            <h2 class="h5">Datos Personales</h2>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label">Apellido:</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div>
                                    <label for="idPacienteModificar" class="form-label">Cédula de Identidad:</label><br>
                                    <input type="text" class="form-control" id="idPacienteModificar" name="cedula" placeholder="Cédula ( Inicia con V o E )"><br>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="edad" class="form-label">Edad:</label>
                                    <input type="number" class="form-control" id="Edad" name="Edad">
                                </div>
                                <div class="col-md-3">
                                    <label for="fecha_nacimiento" class="form-label">F. de nac:</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                </div>
                                <div class="col-md-6">
                                    <label for="localidad" class="form-label">Localidad:</label>
                                    <input type="text" class="form-control" id="Localidad" name="Localidad">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="estado_civil" class="form-label">Estado civil:</label>
                                    <select class="form-control" id="estado_civil" name="estado_civil">
                                        <option value=""></option>
                                        <option value="soltero">Soltero</option>
                                        <option value="casado">Casado</option>
                                        <option value="divorciado">Divorciado</option>
                                        <option value="viudo">Viudo</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="profesion" class="form-label">Profesión:</label>
                                    <input type="text" class="form-control" id="profesion" name="profesion">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="estudios" class="form-label">Estudios:</label>
                                <input type="text" class="form-control" id="estudios" name="estudios">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">¿Cómo nos has conocido?</label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="Amigos/familia" name="conocido" value="Amigos/familia">
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

                        <section class="mb-3">
                            <h3 class="h5">Análisis funcional</h3>
                            <p><b>Del siguiente listado, ¿Qué sensación presentas actualmente?:</b></p>

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="tensión" name="sintoma[]" value="tensión">
                                        <label class="form-check-label" for="Tensión">Tensión</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="taquicardia" name="sintoma[]" value="taquicardia">
                                        <label class="form-check-label" for="Taquicardia">Taquicardia</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Fracaso" name="sintoma[]" value="Fracaso">
                                        <label class="form-check-label" for="Fracaso">Fracaso</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Presión en el pecho" name="sintoma[]" value="Presión en el pecho">
                                        <label class="form-check-label" for="Presión en el pecho">Presión en el pecho</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Ansiedad" name="sintoma[]" value="Ansiedad">
                                        <label class="form-check-label" for="Tensión">Ansiedad</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Presión" name="sintoma[]" value="Presión">
                                        <label class="form-check-label" for="Presión">Presión</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Celos" name="sintoma[]" value="Celos">
                                        <label class="form-check-label" for="Celos">Celos</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Problemas de pareja" name="sintoma[]" value="Problemas de pareja">
                                        <label class="form-check-label" for="Problemas de pareja">Problemas de pareja</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Flojedad" name="sintoma[]" value="Flojedad">
                                        <label class="form-check-label" for="Flojedad">Flojedad</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Irritabilidad" name="Irritabilidad" value="Irritabilidad">
                                        <label class="form-check-label" for="Irritabilidad">Irritabilidad</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Miedo" name="sintoma[]" value="Miedo">
                                        <label class="form-check-label" for="Miedo">Miedo</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Dificultades sexuales" name="sintoma[]" value="Dificultades sexuales">
                                        <label class="form-check-label" for="Dificultades sexuales">Dificultades sexuales</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Sudor" name="sintoma[]" value="Sudor">
                                        <label class="form-check-label" for="Sudor">Sudor</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Culpa" name="sintoma[]" value="Culpa">
                                        <label class="form-check-label" for="Culpa">Culpa</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Desconfianza" name="sintoma[]" value="Desconfianza">
                                        <label class="form-check-label" for="Desconfianza">Desconfianza</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Problemas familiares" name="sintoma[]" value="Problemas familiares">
                                        <label class="form-check-label" for="Problemas familiares">Problemas familiares</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Mareo" name="sintoma[]" value="Mareo">
                                        <label class="form-check-label" for="Mareo">Mareo</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Cansancio" name="sintoma[]" value="Cansancio">
                                        <label class="form-check-label" for="Cansancio">Cansancio</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Sueño" name="sintoma[]" value="Sueño">
                                        <label class="form-check-label" for="Sueño">Sueño</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Nerviosismo" name="sintoma[]" value="Nerviosismo">
                                        <label class="form-check-label" for="Nerviosismo">Nerviosismo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="otros_sintoma" class="form-label">Otros síntomas:</label>
                                <textarea class="form-control" id="otros_sintoma" name="otros_sintoma" rows="3"></textarea>
                            </div>
                        </section>

                        <section class="mb-3">
                            <h2 class="h2">Organismo</h2>

                            <div class="mb-3">
                                <label for="convivencia" class="form-label">¿Con quién convives actualmente?</label>
                                <textarea class="form-control" id="convivencia" name="convivencia" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="relacion_mejorar" class="form-label">¿Cambiarías/mejorarías tu relación con alguno de ellos? ¿Por qué?</label>
                                <textarea class="form-control" id="relacion_mejorar" name="relacion_mejorar" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="area_conflictiva" class="form-label">¿Destacarías alguna área conflictiva en tu relación con tu familia/pareja que quisieras trabajar en terapia? (Entendiendo área como comunicación, relaciones sexuales en el caso de tu pareja...)</label>
                                <textarea class="form-control" id="area_conflictiva" name="area_conflictiva" rows="3"></textarea>
                            </div>

                            <h3 class="h5">Hábitos y estilo de vida</h3>

                            <div class="mb-3">
                                <label class="form-label">¿Consumes alcohol?</label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="alcohol_si" name="alcohol" value="si">
                                    <label class="form-check-label" for="alcohol_si">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="alcohol_no" name="alcohol" value="no">
                                    <label class="form-check-label" for="alcohol_no">No</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="frecuencia_alcohol" class="form-label">¿Con qué frecuencia y cuánta cantidad?</label>
                            <textarea class="form-control" id="frecuencia_alcohol" name="frecuencia_alcohol" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">¿Fumas o vapeas?</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="fumar_si" name="fumar" value="si">
                                <label class="form-check-label" for="fumar_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="fumar_no" name="fumar" value="no">
                                <label class="form-check-label" for="fumar_no">No</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="frecuencia_fumar" class="form-label">¿Con qué frecuencia y cuánta cantidad?</label>
                            <textarea class="form-control" id="frecuencia_fumar" name="frecuencia_fumar" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">¿Consumes algún otro tipo de sustancia?</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="sustancia_si" name="sustancia" value="si">
                                <label class="form-check-label" for="sustancia_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="sustancia_no" name="sustancia" value="no">
                                <label class="form-check-label" for="sustancia_no">No</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="frecuencia_sustancia" class="form-label">Indica cuál y con qué frecuencia</label>
                            <textarea class="form-control" id="frecuencia_sustancia" name="frecuencia_sustancia" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rutina_sueno" class="form-label">Explica brevemente tu rutina de sueño (tiempo, calidad y si haces siesta...)</label>
                            <textarea class="form-control" id="rutina_sueno" name="rutina_sueno" rows="3"></textarea>
                        </div>

                        <h3 class="h5">Tratamientos anteriores</h3>
                        <div class="mb-3">
                            <label class="form-label">¿Has acudido al psicólogo o psiquiatría anteriormente? ¿Qué tipo de tratamiento recibió?</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="no_acudido" name="acudido" value="no">
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

                        <div class="mb-3">
                            <label for="finalizado_tratamiento" class="form-label">¿Finalizaste el tratamiento? En caso negativo, ¿por qué razón?</label>
                            <textarea class="form-control" id="finalizado_tratamiento" name="finalizado_tratamiento" rows="2"></textarea>
                        </div>

                        <h3 class="h5">Preguntas relativas</h3>
                        <div class="mb-3">
                            <label for="personas_significativas" class="form-label">¿Cuáles son las personas más significativas de tu vida actualmente?</label>
                            <textarea class="form-control" id="personas_significativas" name="personas_significativas" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ayuda_terapia" class="form-label">¿Cuál o cuáles crees que podrían ayudarte durante tu terapia?</label>
                            <textarea class="form-control" id="ayuda_terapia" name="ayuda_terapia" rows="3"></textarea>
                        </div>

                        <h3 class="h5">Motivación y compromiso</h3>
                        <div class="mb-3">
                            <label for="espera_terapia" class="form-label">¿Qué esperas conseguir cuando finalice la terapia?</label>
                            <textarea class="form-control" id="espera_terapia" name="espera_terapia" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="compromiso_terapia" class="form-label">Del 1 al 10 ¿Cuál es tu compromiso hacia la terapia?</label>
                            <input type="number" class="form-control" id="compromiso_terapia" name="compromiso_terapia" min="1" max="10">
                        </div>

                        <div class="mb-3">
                            <label for="duracion_terapia" class="form-label">¿Cuánto tiempo crees que durará la terapia?</label>
                            <textarea class="form-control" id="duracion_terapia" name="duracion_terapia" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="importante_reflejar" class="form-label">¿Hay algo que no haya aparecido aquí pero consideras importante reflejar para abordar de manera adecuada el tratamiento? en caso afirmativo, indícalo</label>
                            <textarea class="form-control" id="importante_reflejar" name="importante_reflejar" rows="3"></textarea>
                        </div>
                    </section>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" value="Guardar Pacientes" id="guardar" name="guardar" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



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
        
                <form action="" method="post">
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

</body>



<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>

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

</html>