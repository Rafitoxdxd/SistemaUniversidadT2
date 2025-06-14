<!doctype html>
<html lang="es">
<head>
    <title>Registro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <main>
        <form action="" method="POST">
            <div class="login-container">
                <h2 class="text-center">Crear cuenta</h2>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresa tu apellido" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingresa tu cédula" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu correo" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Crea una contraseña" required>
                        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password', 'eye1')"><i class="bi bi-eye" id="eye1"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Repetir Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Repite la contraseña" required>
                        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password2', 'eye2')"><i class="bi bi-eye" id="eye2"></i></span>
                    </div>
                </div>
                <button type="submit" name="register" class="btn btn-yellow">Registrarse</button>
                <div class="form-link">
                    ¿Ya tienes cuenta? <a href="?pagina=login">Inicia sesión</a>
                </div>
            </div>
        </form>
    </main>
    <script>
        function togglePassword(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(eyeId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>