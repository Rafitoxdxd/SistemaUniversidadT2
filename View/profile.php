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
    </head>

    <body>
    <!-- container-fluid: Crea un contenedor de ancho completo que se adapta al tamaño de la pantalla. -->
    <div class="container-fluid">

        <!-- row: Define filas para organizar el contenido en columnas. -->
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="?pagina=main">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href='?pagina=logout'>CERRAR SESION</a></li>
                    <li class="nav-item"><a class="nav-link" href='?pagina=historial'>Historial</a></li>

                    <br>
                </ul>
            </div>
        </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Mi Perfil</h1>
        </div> 

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <?php
                        //obtiene los datos de la sesión, en este caso el usuario
                        $v_usuario = $_SESSION["usuario"];

                        //extrae los datos del usuario
                        echo "<li> Nombre: ".$v_usuario->getNombre()."</li>";
                        echo "<li> Apellido: ".$v_usuario->getApellido()."</li>";
                        echo "<li> Correo: ".$v_usuario->getCorreo()."</li>";
                        echo "<li> Fecha de Nacimiento: ".$v_usuario->getFNacimiento()."</li>";
                        echo "<li> Género: ".$v_usuario->getGenero()."</li>";
                    ?>
        </div>
            </div>
                </div>
    
        </div>
            </div>

    </main>
            
        

        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
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
