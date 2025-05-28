<!doctype html>
<html lang="es">
    <head>
        <title>Iniciar secion</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            body {
                background-color: #f8f9fa;
            }
            .login-container {
                width: 400px;
                margin: 100px auto;
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
        <header>
            <a href="?pagina=main">HOME</a>
        </header>

        <main>
        <form action="" method="POST">

        <div class="container">
        <div class="login-container">

            <h2 class="text-center mb-4">Iniciar sesión</h2>

            <div class="form-group">
                <label for="cedula">Usuario:</label>
                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingresa su Cédula">
            </div>

            <div class="form-group">
                <label for="contra">Contraseña:</label>
                <input type="password" class="form-control" name="contra" id="contra" placeholder="Ingresa tu contraseña">
            </div>
            
            <input  type="submit" name="login" class="btn btn-primary btn-block" value="Iniciar sesión" >
            
            <p>Ya tienes cuenta? <a href="?pagina=register">registrate</a></p>
            
        </div>
        </div>

        </form>
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
