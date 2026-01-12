<nav class="navbar navbar-expand-lg fixed-top navbar-premium">
    <!-- Perfect Medium Container -->
    <div class="nav-container-perfect">
        
        <!-- 1. LEFT: Logo -->
        <a href="{{ route('home') }}" class="brand-logo">
            <img src="https://i.ibb.co.com/gbLB6Dqj/Logo-02.png" alt="Logically Debate">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <i class="fas fa-bars text-white fs-2"></i>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarContent">
 
            <ul class="navbar-nav mx-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link-simple {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-simple {{ Request::routeIs('debates') ? 'active' : '' }}" href="{{ route('debates') }}">Debate Hall</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-simple {{ Request::routeIs('leaderboard') ? 'active' : '' }}" href="{{ route('leaderboard') }}">Leaderboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-simple {{ Request::routeIs('community') ? 'active' : '' }}" href="{{ route('community') }}">Community</a>
                </li>
            </ul>

            <!-- 3. RIGHT: Auth Buttons -->
            <div class="d-flex align-items-center gap-3 auth-buttons">
                @auth
                    <a href="{{ route('debate.create') }}" class="btn-gradient-red">
                        Create Debate
                    </a>
                    <a href="#" class="btn-solid-dark">
                        My Profile
                    </a>
                @else
                    <a href="{{ route('contact') }}" class="btn-gradient-red">
                        Contact Us
                    </a>
                    <a href="#" class="btn-solid-dark">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>

:root {
    --primary-red: #ef233c;
    --nav-glass: rgba(5, 5, 5, 0.95);
}


.navbar-premium {
    background: var(--nav-glass);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    height: 85px;
    transition: all 0.3s ease;
}

.nav-container-perfect {
    width: 100%;
    max-width: 1500px; 
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between; 
    align-items: center;
}

/* Logo */
.brand-logo img {
    height: 42px; 
    width: auto;
}

.nav-link-simple {
    color: #ffffff !important;
    font-size: 0.95rem; 
    font-weight: 800; 
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0 20px;
    text-decoration: none;
    transition: color 0.3s ease;
    font-family: 'Inter', sans-serif;
}

.nav-link-simple:hover, 
.nav-link-simple.active {
    color: var(--primary-red) !important;
}

.btn-gradient-red {
    background: linear-gradient(135deg, #ef233c 0%, #d90429 100%);
    color: white !important;
    padding: 10px 30px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 0.85rem;
    text-transform: uppercase;
    border: none;
    box-shadow: 0 4px 15px rgba(239, 35, 60, 0.4);
    transition: transform 0.2s;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-gradient-red:hover { transform: translateY(-2px); }

.btn-solid-dark {
    background: #151515;
    color: white !important;
    padding: 10px 28px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 0.85rem;
    border: 1px solid #333;
    text-transform: uppercase;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    transition: background 0.2s;
}
.btn-solid-dark:hover { background: #222; }

/* Mobile Responsive */
.navbar-toggler { border: none; outline: none; }

@media (max-width: 991px) {
    .navbar-collapse {
        background: #000;
        padding: 20px;
        position: absolute;
        top: 85px; left: 0; width: 100%;
        border-bottom: 1px solid #222;
        text-align: center;
    }
    .nav-link-simple { display: block; margin: 15px 0; }
    .auth-buttons { justify-content: center; margin-top: 20px; }
}
</style>