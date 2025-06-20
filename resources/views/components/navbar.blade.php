<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&display=swap" rel="stylesheet">
<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #0c0c0f; border-bottom: 1px solid #2a2a2a;">
    <div class="container-fluid">
        <a class="navbar-brand text-danger fw-bold"
            href="https://www.canva.com/design/DAGp1wcrlmI/6jLIsHZ_Wv74uMewI_K7dg/view?utm_content=DAGp1wcrlmI&utm_campaign=designshare&utm_medium=link2&utm_source=uniquelinks&utlId=hebc37401bc">
            <img src="https://geoparkjogja.jogjaprov.go.id/img/location/jogja-map.svg" alt="SHIELD Logo" height="30">
            {{ $title }}
        </a>
        <button class="navbar-toggler text-light border border-secondary" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link shield-link active" aria-current="page" href="{{ route('home') }}">
                        <i class="fa-solid fa-shield-halved"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link shield-link" href="{{ route('map') }}">
                        <i class="fa-solid fa-location-crosshairs"></i> Peta Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link shield-link" href="{{ route('table') }}">
                        <i class="fa-solid fa-list-check"></i> Tabel Data
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link shield-link text-warning" href="{{ route('contact') }}">
                        <i class="fa-solid fa-phone-volume"></i> Emergency Contact
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle shield-link" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-vault"></i> Data
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark bg-dark-subtle border-0 shadow-sm">
                            <li><a class="dropdown-item text-light" href="{{ route('api.points') }}" target="_blank">
                                    <i class="fa-solid fa-circle-dot me-2"></i> Data Pelapor</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="nav-link shield-link border-0 bg-transparent" type="submit">
                                <i class="fa-solid fa-power-off" style="color: #ff4d4d;"></i> Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link shield-link text-primary" href="{{ route('login') }}">
                            <i class="fa-solid fa-user-shield" style="color: #1e90ff;"></i> Login
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- STYLING SHIELD NAVBAR -->
<style>
    :root {
        --shield-red: #ff003c;
        --shield-gray: #dcdcdc;
        --shield-dark: #0c0c0f;
        --shield-hover: #ffffff;
        --font-futuristic: 'Orbitron', sans-serif;
    }

    .navbar {
        font-family: var(--font-futuristic);
        letter-spacing: 0.05rem;
        padding: 0.6rem 1.2rem;
    }

    .navbar-brand {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--shield-red);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.3s ease;
    }

    .navbar-brand:hover {
        color: #ff3366;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
        gap: 1.2rem;
    }

    .shield-link {
        color: var(--shield-gray) !important;
        font-size: 0.95rem;
        letter-spacing: 0.03rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        padding: 0.4rem 0.6rem;
    }

    .shield-link:hover {
        color: var(--shield-hover) !important;
        text-shadow: 0 0 8px var(--shield-red);
    }

    .navbar-nav .nav-link.active {
        color: var(--shield-red) !important;
        font-weight: 600;
    }

    .dropdown-menu a {
        font-family: var(--font-futuristic);
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }

    .dropdown-menu a:hover {
        background-color: rgba(255, 0, 0, 0.08);
        text-shadow: 0 0 4px var(--shield-red);
    }

    .navbar-toggler {
        background-color: rgba(255, 255, 255, 0.05);
        padding: 0.4rem;
        border-radius: 0.25rem;
    }

    .navbar-toggler-icon {
        filter: invert(1);
    }
</style>
