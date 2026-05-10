<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Wisata Alam Bandung')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1a1a2e;
            --primary-blue: #16213e;
            --accent-purple: #533483;
            --accent-cyan: #00d4ff;
            --accent-emerald: #00ff88;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-glow: 0 0 20px rgba(0, 212, 255, 0.3);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-accent: linear-gradient(135deg, #00d4ff 0%, #00ff88 100%);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gradient-primary);
            background-attachment: fixed;
            min-height: 100vh;
            color: #ffffff;
            overflow-x: hidden;
            padding-top: 100px;
        }

        main {
            position: relative;
            z-index: 1;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-cyan);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-emerald);
        }

        /* Navbar Modern */
        .navbar-modern {
            background: rgba(26, 26, 46, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            transition: var(--transition);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-modern.scrolled {
            background: rgba(26, 26, 46, 0.95);
            box-shadow: var(--shadow-soft);
        }

        .navbar-brand-modern {
            font-weight: 800;
            font-size: 1.5rem;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .nav-link-modern {
            color: #ffffff !important;
            font-weight: 500;
            margin: 0 1rem;
            position: relative;
            transition: var(--transition);
            padding: 0.5rem 1rem;
            border-radius: 25px;
        }

        .nav-link-modern:hover {
            color: var(--accent-cyan) !important;
            background: rgba(0, 212, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-link-modern::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gradient-accent);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-link-modern:hover::before {
            width: 100%;
        }

        .btn-modern {
            background: var(--gradient-accent);
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            color: #000;
            transition: var(--transition);
            box-shadow: var(--shadow-glow);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
        }

        .btn-outline-modern {
            background: transparent;
            border: 2px solid var(--accent-cyan);
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            color: var(--accent-cyan);
            transition: var(--transition);
        }

        .btn-outline-modern:hover {
            background: var(--accent-cyan);
            color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-user {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            color: var(--text-light);
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .btn-user:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin-top: 0.5rem;
        }

        .dropdown-item {
            color: var(--text-dark);
            font-weight: 500;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background: rgba(0, 123, 255, 0.1);
            color: var(--primary-blue);
        }

        .dropdown-item i {
            width: 16px;
            margin-right: 0.5rem;
        }

        /* Hero Section */
        .hero-fullscreen {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
            animation: bgMove 20s ease-in-out infinite;
        }

        @keyframes bgMove {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(26, 26, 46, 0.8) 0%, rgba(83, 52, 131, 0.6) 100%);
            backdrop-filter: blur(1px);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 1rem;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from { filter: brightness(1); }
            to { filter: brightness(1.2); }
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.5rem);
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .hero-cta {
            background: var(--gradient-accent);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #000;
            transition: var(--transition);
            box-shadow: var(--shadow-glow);
            animation: pulse 2s infinite;
        }

        .hero-cta:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 0 40px rgba(0, 212, 255, 0.6);
        }

        @keyframes pulse {
            0% { box-shadow: var(--shadow-glow); }
            50% { box-shadow: 0 0 30px rgba(0, 212, 255, 0.8); }
            100% { box-shadow: var(--shadow-glow); }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-10px); }
            60% { transform: translateX(-50%) translateY(-5px); }
        }

        /* Category Cards */
        .category-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .category-card:hover::before {
            left: 100%;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .category-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .category-title {
            font-weight: 600;
            color: #ffffff;
        }

        /* Place Cards */
        .place-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            overflow: hidden;
            transition: var(--transition);
            position: relative;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-soft);
        }

        .place-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .place-image {
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .place-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.1) 0%, transparent 50%);
            transition: var(--transition);
        }

        .place-card:hover .place-image::before {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.3) 0%, transparent 50%);
        }

        .place-overlay {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            padding: 0.5rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .place-content {
            padding: 1.5rem;
        }

        .place-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .place-location {
            color: var(--accent-cyan);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .place-rating {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stars {
            color: #ffd700;
            margin-right: 0.5rem;
        }

        .place-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .place-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-card {
            flex: 1;
            border-radius: 15px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary-card {
            background: var(--gradient-accent);
            border: none;
            color: #000;
        }

        .btn-primary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.4);
        }

        .btn-secondary-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .btn-secondary-card:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Search & Filter */
        .search-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 1rem;
            margin: 2rem 0;
            box-shadow: var(--shadow-soft);
        }

        .search-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 0.75rem 1rem;
            color: #ffffff;
            font-weight: 500;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 0.2rem rgba(0, 212, 255, 0.25);
        }

        .filter-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 0.75rem 1rem;
            color: #ffffff;
            font-weight: 500;
        }

        .filter-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent-cyan);
        }

        /* Statistics Cards */
        .stats-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.1) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 15px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Toast Notifications */
        .toast-modern {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            color: #ffffff;
            box-shadow: var(--shadow-soft);
        }

        /* Dark Mode */
        .dark-mode-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 0.5rem;
            color: #ffffff;
            transition: var(--transition);
        }

        .dark-mode-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Mobile Menu */
        @media (max-width: 768px) {
            .navbar-collapse {
                background: rgba(26, 26, 46, 0.95);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-radius: 15px;
                margin-top: 1rem;
                padding: 1rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .place-card {
                margin-bottom: 1rem;
            }

            .category-card {
                margin-bottom: 1rem;
            }

            .search-container {
                padding: 0.5rem;
            }

            .search-input, .filter-select {
                margin-bottom: 0.5rem;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-up {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-modern" id="navbar">
        <div class="container">
            <a class="navbar-brand navbar-brand-modern" href="{{ route('home') }}">
                Wisata Bandung
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="{{ route('places.index') }}">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="#explore">Jelajah</a>
                    </li>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link nav-link-modern" href="{{ route('admin.places.create') }}">Tambah Wisata</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <div class="d-flex align-items-center">
                    <button id="darkModeToggle" class="btn dark-mode-toggle me-3">
                        Mode Gelap
                    </button>
                    <form class="d-flex" action="{{ route('places.index') }}" method="GET" id="searchForm">
                        <input class="form-control search-input me-2" type="search" name="search" placeholder="Cari tempat wisata..." value="{{ request('search') }}" aria-label="Search" id="searchInput">
                        <select class="form-select filter-select me-2" name="category" id="categoryFilter">
                            <option value="">Semua Kategori</option>
                            <option value="Gunung" {{ request('category') == 'Gunung' ? 'selected' : '' }}>Gunung</option>
                            <option value="Danau" {{ request('category') == 'Danau' ? 'selected' : '' }}>Danau</option>
                            <option value="Hutan" {{ request('category') == 'Hutan' ? 'selected' : '' }}>Hutan</option>
                            <option value="Air Terjun" {{ request('category') == 'Air Terjun' ? 'selected' : '' }}>Air Terjun</option>
                            <option value="Camping" {{ request('category') == 'Camping' ? 'selected' : '' }}>Camping</option>
                        </select>
                        <button class="btn btn-modern" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    @guest
                        <div class="auth-buttons ms-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-modern me-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-modern">Register</a>
                        </div>
                    @else
                        <div class="user-menu ms-3">
                            <div class="dropdown">
                                <button class="btn btn-user dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-2"></i>
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a></li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer">
        @if(session('success'))
        <div class="toast toast-modern fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Berhasil</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="toast toast-modern fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                <strong class="me-auto">Peringatan</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Terjadi kesalahan. Silakan periksa kembali form Anda.
            </div>
        </div>
        @endif
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Testimonials Section -->
    <section class="py-5" style="background: rgba(26, 26, 46, 0.5);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="hero-title" style="font-size: 2.5rem;">Apa Kata Pengunjung</h2>
                <p class="text-light opacity-75">Pengalaman wisatawan yang telah menjelajahi Bandung</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem; text-align: center;">
                        <div class="stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-light opacity-90 mb-3" style="font-style: italic;">
                            "Destinasi wisata di Bandung sangat memukau! Dari gunung hingga danau, semuanya indah dan terawat dengan baik."
                        </p>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=50&h=50&fit=crop&crop=face" alt="User" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 1rem; object-fit: cover;">
                            <div>
                                <div style="color: #ffffff; font-weight: 600;">Sarah Wijaya</div>
                                <div style="color: var(--accent-cyan); font-size: 0.9rem;">Jakarta</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem; text-align: center;">
                        <div class="stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text-light opacity-90 mb-3" style="font-style: italic;">
                            "Pengalaman camping di Bandung luar biasa! Udara sejuk, pemandangan indah, dan fasilitas yang memadai."
                        </p>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop&crop=face" alt="User" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 1rem; object-fit: cover;">
                            <div>
                                <div style="color: #ffffff; font-weight: 600;">Ahmad Rahman</div>
                                <div style="color: var(--accent-cyan); font-size: 0.9rem;">Bandung</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem; text-align: center;">
                        <div class="stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-light opacity-90 mb-3" style="font-style: italic;">
                            "Wisata alam Bandung cocok untuk keluarga. Anak-anak sangat senang dengan air terjun dan hiking ringan."
                        </p>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=50&h=50&fit=crop&crop=face" alt="User" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 1rem; object-fit: cover;">
                            <div>
                                <div style="color: #ffffff; font-weight: 600;">Maya Sari</div>
                                <div style="color: var(--accent-cyan); font-size: 0.9rem;">Surabaya</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 25px; padding: 3rem; max-width: 600px; margin: 0 auto;">
                    <i class="fas fa-envelope-open-text" style="font-size: 3rem; color: var(--accent-cyan); margin-bottom: 1rem;"></i>
                    <h3 class="hero-title mb-3" style="font-size: 2rem;">Dapatkan Update Terbaru</h3>
                    <p class="text-light opacity-75 mb-4">Berlangganan newsletter kami untuk mendapatkan informasi destinasi wisata terbaru dan promo menarik</p>
                    <form class="row g-3 justify-content-center">
                        <div class="col-md-8">
                            <input type="email" class="form-control glass-input" placeholder="Masukkan email Anda" style="border-radius: 25px; padding: 0.75rem 1.5rem; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff;" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-modern w-100" style="border-radius: 25px;">
                                <i class="fas fa-paper-plane me-2"></i>Berlangganan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Premium -->
    <footer style="background: rgba(26, 26, 46, 0.9); backdrop-filter: blur(20px); border-top: 1px solid var(--glass-border); padding: 3rem 0;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="mb-3">
                        <h4 class="navbar-brand-modern mb-3">Wisata Bandung</h4>
                        <p class="text-light opacity-75 mb-3">
                            Platform terpercaya untuk menemukan dan menjelajahi keindahan wisata alam Bandung.
                            Dari gunung megah hingga danau tenang, semua ada di sini.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-modern btn-sm" style="width: 40px; height: 40px; padding: 0; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-modern btn-sm" style="width: 40px; height: 40px; padding: 0; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-modern btn-sm" style="width: 40px; height: 40px; padding: 0; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-modern btn-sm" style="width: 40px; height: 40px; padding: 0; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <h5 class="text-white mb-3">Wisata</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('places.index', ['category' => 'Gunung']) }}" class="text-light opacity-75 text-decoration-none">Gunung</a></li>
                        <li class="mb-2"><a href="{{ route('places.index', ['category' => 'Danau']) }}" class="text-light opacity-75 text-decoration-none">Danau</a></li>
                        <li class="mb-2"><a href="{{ route('places.index', ['category' => 'Hutan']) }}" class="text-light opacity-75 text-decoration-none">Hutan</a></li>
                        <li class="mb-2"><a href="{{ route('places.index', ['category' => 'Air Terjun']) }}" class="text-light opacity-75 text-decoration-none">Air Terjun</a></li>
                        <li class="mb-2"><a href="{{ route('places.index', ['category' => 'Camping']) }}" class="text-light opacity-75 text-decoration-none">Camping</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="text-white mb-3">Layanan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Peta Wisata</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Panduan</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Reservasi</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Transportasi</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Akomodasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <h5 class="text-white mb-3">Dukungan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Bantuan</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Kontak Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <h5 class="text-white mb-3">Statistik</h5>
                    <div class="stats-mini">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-light opacity-75">Destinasi</span>
                            <span class="text-white fw-bold">{{ \App\Models\Place::count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-light opacity-75">Pengunjung</span>
                            <span class="text-white fw-bold">{{ \App\Models\Place::sum('visitors') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-light opacity-75">Rating</span>
                            <span class="text-white fw-bold">{{ \App\Models\Place::avg('rating') ? number_format(\App\Models\Place::avg('rating'), 1) : '0.0' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-light opacity-75">Kategori</span>
                            <span class="text-white fw-bold">{{ \App\Models\Place::distinct('category')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.1);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light opacity-75 mb-0">&copy; 2026 Wisata Bandung. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-light opacity-75">Dibuat untuk Wisata Bandung</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;

        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            body.classList.add('dark-mode');
            darkModeToggle.innerHTML = 'Mode Terang';
        } else {
            darkModeToggle.innerHTML = 'Mode Gelap';
        }

        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.toggle('dark-mode');
            const theme = body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
            darkModeToggle.innerHTML = theme === 'dark' ? 'Mode Terang' : 'Mode Gelap';
        });

        // Real-time search
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });

        // Category filter
        const categoryFilter = document.getElementById('categoryFilter');
        categoryFilter.addEventListener('change', function() {
            searchForm.submit();
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Loading animation for forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                    submitBtn.disabled = true;
                }
            });
        });

        // Auto-hide toasts
        setTimeout(() => {
            document.querySelectorAll('.toast').forEach(toast => {
                const bsToast = new bootstrap.Toast(toast);
                bsToast.hide();
            });
        }, 5000);
    </script>
</body>
</html>