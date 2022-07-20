<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url('logo.png') ?>" alt="logo" class="logo-style rounded-circle">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/facilitadores">Facilitadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cursos">Cursos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Capacitaciones
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/capacitaciones/listado"><i class="fa-solid fa-list"></i> Listado</a></li>
                        <li><a class="dropdown-item" href="/capacitaciones/inscripciones"><i class="fa-solid fa-pen-to-square"></i> Inscritos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/participantes">Participantes</a>
                </li>

            </ul>
            <!-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>