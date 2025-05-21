<!doctype html>
<html lang="es">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="Styles/Bootstrap/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <style>
            /* Estilos específicos para el formulario de login cuando se muestra en main.php */
            .login-body-bg { /* Clase para aplicar al body si es necesario un fondo específico */
                background-color: #f8f9fa;
            }
            .login-container-main {
                width: 400px;
                margin: 100px auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                animation: fadeInMain 1s ease-in-out; 
            }
            @keyframes fadeInMain {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .login-container-main .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                animation: inputFocusMain 0.3s ease-in-out;
            }
            @keyframes inputFocusMain {
                from { transform: scale(1); }
                to { transform: scale(1.05); }
            }
            .login-container-main .btn-primary {
                transition: background-color 0.3s ease-in-out;
            }
            .login-container-main .btn-primary:hover {
                background-color: #0069d9;
            }
        </style>
    </head>

    <body>
        <header>
        </header>

        <main>
            <ul>
                <?php
                    //se verifica si el usuario esta logueado
                    if (isset($_SESSION["usuario"]))
                    {
                        // Muestra el menú para un usuario con sesión iniciada
                        echo "<ul>";
                        echo "<li> <a href='?pagina=profile'>PERFIL</a></li>";
                        echo "<li> <a href='?pagina=logout'>CERRAR SESION</a></li>";
                        echo "</ul>";

                        // Aquí podrías añadir más contenido para la página principal si el usuario está logueado
                        echo "<div class='container mt-4'>";
                        echo "<h1>Bienvenido al Sistema Universitario</h1>";
                        echo "<p>Utiliza el menú para navegar.</p>";
                        echo "</div>";
                    }
                    else
                    {
                        // Muestra el formulario de login si no hay sesión iniciada
                        // Aplicamos una clase al body para el fondo si es necesario (opcional)
                        // echo "<script>document.body.classList.add('login-body-bg');</script>";

                        echo '<div class="container">'; // Contenedor general de Bootstrap
                        echo '  <div class="login-container-main">'; // Contenedor específico del login
                        echo '    <h2 class="text-center mb-4">Iniciar sesión</h2>';
                        echo '    <form action="" method="POST">'; // El action="" enviará al script actual (index.php)
                        echo '      <div class="form-group mb-3">'; // mb-3 para Bootstrap 5
                        echo '        <label for="cedula">Usuario:</label>';
                        echo '        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingresa su Cédula">';
                        echo '      </div>';
                        echo '      <div class="form-group mb-3">'; // mb-3 para Bootstrap 5
                        echo '        <label for="contra">Contraseña:</label>';
                        echo '        <input type="password" class="form-control" name="contra" id="contra" placeholder="Ingresa tu contraseña">';
                        echo '      </div>';
                        echo '      <input type="submit" name="login" class="btn btn-primary w-100" value="Iniciar sesión">'; // w-100 para ancho completo en BS5
                        echo '      <p class="mt-3 text-center">¿No tienes cuenta? <a href="?pagina=register">Regístrate</a></p>';
                        echo '    </form>';
                        echo '  </div>';
                        echo '</div>';
                    }
                ?>
        </main>

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
    </body>
</html>
