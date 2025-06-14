<!-- Menú de navegación responsive -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 d-lg-none">
                <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="?pagina=main" style="color: var(--color5);">Sistema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <div class="w-100 d-flex justify-content-center my-2">
    <img src="img/Logo3.png" alt="Logo Stephanie Quintero" style="max-width:90px; max-height:90px;">
</div>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'main' ? ' active' : '' ?>" href="?pagina=main"><i class="bi bi-house-door me-2"></i>Inicio</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'historial' ? ' active' : '' ?>" href="?pagina=historial"><i class="bi bi-clock-history me-2"></i>Historial</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'test' ? ' active' : '' ?>" href="?pagina=test"><i class="bi bi-clipboard-check me-2"></i>Test</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'pacientes' ? ' active' : '' ?>" href="?pagina=pacientes"><i class="bi bi-people me-2"></i>Pacientes</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'cita' ? ' active' : '' ?>" href="?pagina=cita"><i class="bi bi-calendar2-plus me-2"></i>Citas</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'tratamiento' ? ' active' : '' ?>" href="?pagina=tratamiento"><i class="bi bi-capsule-pill me-2"></i>Tratamiento</a></li>
                    <li class="nav-item"><a class="nav-link" href="?pagina=logout"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                </ul>
            </div>
            </div>
            </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-lg-block sidebar">
                    <div class="sidebar-sticky">
                        <div class="w-100 d-flex justify-content-center my-3">
                        <img src="img/Logo3.png" alt="Logo Stephanie Quintero" style="max-width:120px; max-height:120px;">
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'main' ? ' active' : '' ?>" href="?pagina=main">
                                    <i class="bi bi-house-door me-2"></i> Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'historial' ? ' active' : '' ?>" href="?pagina=historial">
                                    <i class="bi bi-clock-history me-2"></i> Historial
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'test' ? ' active' : '' ?>" href="?pagina=test">
                                    <i class="bi bi-clipboard-check me-2"></i> Test
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'pacientes' ? ' active' : '' ?>" href="?pagina=pacientes">
                                    <i class="bi bi-people me-2"></i> Pacientes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'cita' ? ' active' : '' ?>" href="?pagina=cita">
                                    <i class="bi bi-calendar2-plus me-2"></i> Citas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'tratamiento' ? ' active' : '' ?>" href="?pagina=tratamiento">
                                    <i class="bi bi-capsule-pill me-2"></i> Tratamiento
                                </a>
                            </li>
                            <li class="nav-item mt-auto">
                                <a class="nav-link" href="?pagina=logout">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>