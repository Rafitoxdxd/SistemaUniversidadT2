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

    <style>
        :root {
            --color1: #DBE1F0;
            --color2: #A7D0D8;
            --color3: #ABCDDD;
            --color4: #E0C323;
            --color5: #75A5B8;
        }
        body {
            background: linear-gradient(135deg, var(--color1) 0%, var(--color2) 40%, var(--color3) 100%);
            min-height: 100vh;
        }
        .login-container {
            width: 370px;
            margin: 70px auto;
            padding: 35px 28px 28px 28px;
            background-color: #fff;
            border-radius: 22px;
            box-shadow: 0 0 24px rgba(117, 165, 184, 0.12);
            border: 1.5px solid var(--color1);
        }
        .login-container h2 {
            color: #222;
            font-weight: bold;
            margin-bottom: 2rem;
            font-size: 1.7rem;
        }
        .form-label {
            color: #888;
            font-weight: 500;
            font-size: 0.97rem;
            margin-bottom: 0.3rem;
        }
        .input-group-text {
            background: var(--color1);
            border: none;
            color: var(--color5);
            font-size: 1.2rem;
        }
        .form-control {
            background: var(--color1);
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            color: #222;
            padding-left: 0.5rem;
            transition: box-shadow 0.2s, border 0.2s;
        }
        .form-control:focus {
            border: 2px solid var(--color4);
            box-shadow: 0 0 0 0.1rem rgba(224, 195, 35, 0.18);
            background: #fff;
        }
        .input-group:focus-within .input-group-text {
            border: 2px solid var(--color4);
            background: #fff;
            color: var(--color4);
        }
        .change-link {
            color: var(--color4);
            font-size: 0.93rem;
            cursor: pointer;
            float: right;
            text-decoration: underline;
        }
        .btn-yellow {
            background: var(--color4);
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 20px;
            font-size: 1.09rem;
            letter-spacing: 0.5px;
            width: 100%;
            margin-top: 0.7rem;
            margin-bottom: 0.5rem;
            padding: 0.7rem;
            transition: background 0.2s;
        }
        .btn-yellow:hover {
            background: #c7a91e;
        }
        .form-link {
            color: var(--color5);
            text-align: center;
            display: block;
            margin-top: 1rem;
            font-size: 0.98rem;
        }
        .form-link a {
            color: var(--color2);
            text-decoration: underline;
        }
        .form-link a:hover {
            color: var(--color4);
        }
    </style>
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
