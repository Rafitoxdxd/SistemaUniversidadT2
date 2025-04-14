<!doctype html>
<html lang="en">
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
                <li class="nav-item"><a class="nav-link active" href="?page=main">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href='?page=logout'>Cerrar Sesión</a></li>
                <br>
            </ul>
            </div>
            </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Mi Perfil</h1>
          </div> 

        <div class="row">
            <!-- col-md-*: Define el ancho de las columnas en diferentes tamaños de pantalla. -->
            <div class="col-md-4">
                <!-- Card crea contenedores de tarjetas para mostrar la información de las órdenes. -->
                <div class="card">
                    <?php

                        echo "<li> Name: ".$_SESSION["name"]."</li>";
                        echo "<li> Lastname: ".$_SESSION["lastname"]."</li>";
                        echo "<li> Mail: ".$_SESSION["mail"]."</li>";
                        if (isset($_SESSION["birthdate"]))
                        { echo "<li> Birth Date: ".$_SESSION["birthdate"]."</li>"; }
                        if (isset($_SESSION["gender"]))
                        {echo "<li> Gender: ".$_SESSION["gender"]."</li>"; }
                    ?>
        </div>
            </div>
                </div>

                <!-- canvas: Reserva un espacio para el gráfico (necesitarás una librería como Chart.js para generar el gráfico dinámicamente) -->
                 <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>
        </div>
            </div>
            
        

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
