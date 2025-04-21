<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="Styles/Bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            animation: inputFocus 0.3s ease-in-out;
        }
        @keyframes inputFocus {
            from { transform: scale(1); }
            to { transform: scale(1.05); }
        }
        .btn-primary {
            transition: background-color 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2 class="text-center mb-4">Registrarse</h2>
            <form id="registroForm" action="" method="POST">
                
                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingresa tu cédula">
                </div>
                
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre">
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresa tu apellido">
                </div>

                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresa tu gmail">
                </div>

                <div class="form-group">
                    <label for="contra">Contraseña:</label>
                    <input type="password" class="form-control" name="contra" id="contra" placeholder="Ingresa tu contraseña">
                </div>

                <div class="form-group">
                    <label for="FNacimiento">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" name="FNacimiento" id="FNacimiento">
                </div>

                <div class="form-group">
                    <label for="genero">Género:</label>
                    <select class="form-control" id="genero" name="genero">
                        <option value="m">Masculino</option>
                        <option value="f">Femenino</option>
                        <option value="o">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select class="form-control" id="rol" name="rol">
                        <option value="c">Paciente</option>
                        <option value="p">Psicólogo</option>
                    </select>
                </div>

                <!--
                <div class="form-group">
                    <label for="isPsychologist">Es usted psicólogo/a?</label>
                    <input type="checkbox" class="form-control-check" name="isPsychologist" id="isPsychologist" id="">
                </div>
                -->

                <input type="submit" name="register" class="btn btn-primary btn-block">
            </form>
        </div>
    </div>

</div>

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Registro Exitoso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Usuario Registrado exitosamente.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input class="btn btn-secondary" data-dismiss="modal" type="submit" name="register">
            </div>
        </div>
    </div>
</div>

  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registroForm = document.getElementById('registroForm');

            registroForm.addEventListener('submit', function(event) {
                //event.preventDefault(); // Evita el envío del formulario

                // Aquí va tu lógica para procesar el registro
                // (simulación de registro exitoso para este ejemplo)

                $('#successModal').modal('show'); // Muestra el modal de éxito
            });
        });
    </script>

    
    
    
</body>
</html>