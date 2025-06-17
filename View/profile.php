<?php
require_once(__DIR__ . '/../Model/userManagement.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Asegúrate de tener el usuario en sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Si guardas el objeto Usuario en $_SESSION['usuario']:
$usuario = $_SESSION['usuario'];
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Perfil</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
         
        />
        <link rel="stylesheet" href="css/navegacion.css">
         <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        
        <style>
            /* Paleta de colores para un estilo más elegante en tonos de gris y azul */
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
                box-shadow: 0 12px 25px rgba(117, 165, 184, 0.10); /* Sombra del card más fuerte */
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

            /* Estilos específicos para la página de perfil */
            .profile-main-content {
                margin-left: 17%;
                padding: 2.5rem 2rem;
                background: #fff;
                border-radius: 24px;
                box-shadow: 0 8px 32px rgba(117,165,184,0.10);
                min-height: 100vh;
                margin-top: 2.5rem;
                margin-bottom: 2.5rem;
                max-width: 600px;
            }
            .profile-card {
                background: #fff;
                border-radius: 22px;
                box-shadow: 0 0 24px rgba(117, 165, 184, 0.12);
                border: 1.5px solid var(--color1);
                max-width: 480px;
                margin: 0 auto;
                padding: 2.5rem 2.2rem 2rem 2.2rem;
            }
            .profile-avatar {
                width: 90px;
                height: 90px;
                border-radius: 50%;
                background: var(--color1);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 3.2rem;
                color: var(--color5);
                margin: 0 auto 1.2rem auto;
            }
            .profile-title {
                color: #222;
                font-weight: bold;
                text-align: center;
                margin-bottom: 0.5rem;
            }
            .profile-data {
                margin-bottom: 1.2rem;
            }
            .profile-data label {
                color: #888;
                font-weight: 500;
                font-size: 0.97rem;
                margin-bottom: 0.1rem;
            }
            .profile-data .value {
                color: #222;
                font-size: 1.08rem;
                font-weight: 500;
            }
            .profile-actions {
                display: flex;
                gap: 1rem;
                justify-content: center;
                margin-top: 1.5rem;
            }
            .btn-edit {
                background: var(--color5);
                color: #fff;
                border: none;
                font-weight: 500;
                border-radius: 16px;
                padding: 0.6rem 1.3rem;
                transition: background 0.2s;
            }
            .btn-edit:hover {
                background: #4e7b8a;
            }
            .btn-password {
                background: var(--color4);
                color: #fff;
                border: none;
                font-weight: 500;
                border-radius: 16px;
                padding: 0.6rem 1.3rem;
                transition: background 0.2s;
            }
            .btn-password:hover {
                background: #c7a91e;
            }
            @media (max-width: 900px) {
                .profile-main-content {
                    margin-left: 0;
                    padding: 1.2rem 0.5rem;
                }
            }
        </style>
    </head>

    <body>
    <?php require_once("menu/menu.php"); ?>
    <div class="profile-main-content">
        <div class="profile-card">
            <div class="profile-avatar">
                <i class="bi bi-person-circle"></i>
            </div>
            <h2 class="profile-title">
                <?php echo htmlspecialchars($usuario->getNombre() . ' ' . $usuario->getApellido()); ?>
            </h2>
            <div class="profile-data">
                <label>Cédula:</label>
                <div class="value mb-2"><?php echo htmlspecialchars($usuario->getCedula()); ?></div>
                <label>Correo electrónico:</label>
                <div class="value mb-2"><?php echo htmlspecialchars($usuario->getCorreo()); ?></div>
                <label>Fecha de nacimiento:</label>
                <div class="value mb-2"><?php echo htmlspecialchars($usuario->getFNacimiento()); ?></div>
                <label>Género:</label>
                <div class="value mb-2"><?php echo htmlspecialchars($usuario->getGenero()); ?></div>
                <label>Rol:</label>
                <div class="value mb-2"><?php echo htmlspecialchars($usuario->getRol()); ?></div>
            </div>
            <div class="profile-actions">
                <button type="button" class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
    <i class="bi bi-pencil"></i> Editar perfil
</button>
<!-- Botón Cambiar Contraseña -->
<button type="button" class="btn btn-password" data-bs-toggle="modal" data-bs-target="#modalCambiarContrasena">
    <i class="bi bi-key"></i> Cambiar contraseña
</button>
            </div>
        </div>
    </div>
        <!-- Modal Editar Perfil -->
<div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="?pagina=profile">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarPerfilLabel">Editar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <!-- Campos de edición -->
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->getNombre()); ?>" required>
        </div>
        <div class="mb-3">
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario->getApellido()); ?>" required>
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo electrónico</label>
          <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario->getCorreo()); ?>" required>
        </div>
        
        <div class="mb-3">
          <label for="cedula" class="form-label">Cédula</label>
          <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo htmlspecialchars($usuario->getCedula()); ?>" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-edit">Guardar cambios</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Cambiar Contraseña -->
<div class="modal fade" id="modalCambiarContrasena" tabindex="-1" aria-labelledby="modalCambiarContrasenaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="?pagina=profile">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCambiarContrasenaLabel">Cambiar Contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="nueva_contrasena" class="form-label">Nueva contraseña</label>
          <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena" required>
        </div>
        <div class="mb-3">
          <label for="repetir_contrasena" class="form-label">Repetir contraseña</label>
          <input type="password" class="form-control" id="repetir_contrasena" name="repetir_contrasena" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-password">Guardar</button>
      </div>
    </form>
  </div>
</div>
        <footer>
            </footer>
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