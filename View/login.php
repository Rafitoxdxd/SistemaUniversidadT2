<!doctype html>
<html lang="es">
<head>
    <title>Iniciar sesión</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main>
        <form action="" method="POST">
            <div class="login-container">
                <h2 class="text-center">Iniciar sesión</h2>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingresa tu cédula">
                    </div>
                </div>
                <div class="mb-2">
                    <label for="contra" class="form-label">Contraseña</label>
                    <span class="change-link" onclick="document.getElementById('contra').focus()">Cambiar</span>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" name="contra" id="contra" placeholder="Ingresa tu contraseña">
                        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword()"><i class="bi bi-eye" id="eye"></i></span>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-yellow">Iniciar sesión</button>
                <div class="form-link">
                    ¿No tienes cuenta? <a href="?pagina=register">Regístrate</a>
                </div>
            </div>
        </form>
    </main>
    <script>
        function togglePassword() {
            const input = document.getElementById('contra');
            const icon = document.getElementById('eye');
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
