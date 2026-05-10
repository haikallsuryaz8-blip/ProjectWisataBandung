@extends('layouts.app')

@section('title', 'Dashboard - Wisata Bandung')

@section('content')
<div class="user-dashboard">
    <!-- Header -->
    <header class="dashboard-header">
        <div class="header-content">
            <div class="welcome-section">
                <h1 class="welcome-title">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="welcome-subtitle">Discover amazing places in Bandung</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('places.index') }}" class="btn-explore">
                    <i class="fas fa-compass"></i>
                    Explore Places
                </a>
                <button type="button" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <!-- Quick Stats -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $placesCount ?? 0 }}</h3>
                        <p class="stat-label">Places to Visit</p>
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $favoritesCount ?? 0 }}</h3>
                        <p class="stat-label">Favorites</p>
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $reviewsCount ?? 0 }}</h3>
                        <p class="stat-label">Reviews Given</p>
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $visitedCount ?? 0 }}</h3>
                        <p class="stat-label">Places Visited</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Places -->
    <section class="featured-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Featured Destinations</h2>
                <p class="section-subtitle">Handpicked places you might love</p>
            </div>

            <div class="places-grid">
                @if(!empty($featuredPlaces) && count($featuredPlaces))
                    @foreach($featuredPlaces as $place)
                    <div class="place-card">
                        <div class="place-image">
                            <img src="{{ asset('storage/' . $place->image) }}" alt="{{ $place->name }}">
                            <div class="place-overlay">
                                <div class="place-rating">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $place->rating }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="place-content">
                            <div class="place-category">{{ $place->category }}</div>
                            <h3 class="place-title">{{ $place->name }}</h3>
                            <p class="place-description">{{ \Illuminate\Support\Str::limit($place->description ?? '', 100) }}</p>
                            <div class="place-footer">
                                <div class="place-price">
                                    @if(isset($place->ticket_price) && $place->ticket_price > 0)
                                        <span class="price">Rp {{ number_format($place->ticket_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="price-free">Free</span>
                                    @endif
                                </div>
                                <a href="{{ route('places.show', $place) }}" class="btn-view">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="no-places">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>No places available</h3>
                    <p>Check back later for amazing destinations!</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Explore by Category</h2>
                <p class="section-subtitle">Find places that match your interests</p>
            </div>

            <div class="categories-grid">
                <a href="{{ route('places.index', ['category' => 'Gunung']) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-mountain"></i>
                    </div>
                    <h3 class="category-title">Gunung</h3>
                    <p class="category-count">{{ $mountainCount ?? 0 }} destinasi</p>
                </a>

                <a href="{{ route('places.index', ['category' => 'Danau']) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3 class="category-title">Danau</h3>
                    <p class="category-count">{{ $lakeCount ?? 0 }} destinasi</p>
                </a>

                <a href="{{ route('places.index', ['category' => 'Hutan']) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-tree"></i>
                    </div>
                    <h3 class="category-title">Hutan</h3>
                    <p class="category-count">{{ $forestCount ?? 0 }} destinasi</p>
                </a>

                <a href="{{ route('places.index', ['category' => 'Air Terjun']) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-cloud-showers-heavy"></i>
                    </div>
                    <h3 class="category-title">Air Terjun</h3>
                    <p class="category-count">{{ $waterfallCount ?? 0 }} destinasi</p>
                </a>

                <a href="{{ route('places.index', ['category' => 'Camping']) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-campground"></i>
                    </div>
                    <h3 class="category-title">Camping</h3>
                    <p class="category-count">{{ $campingCount ?? 0 }} destinasi</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Recent Activity -->
    <section class="activity-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Your Recent Activity</h2>
                <p class="section-subtitle">Places you've recently viewed or reviewed</p>
            </div>

            <div class="activity-list">
                @if(!empty($recentActivity) && count($recentActivity))
                    @foreach($recentActivity as $activity)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-text">You viewed <strong>{{ $activity->place->name }}</strong></p>
                            <p class="activity-time">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="no-activity">
                    <i class="fas fa-history"></i>
                    <h3>No recent activity</h3>
                    <p>Start exploring places to see your activity here!</p>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>

<style>
.user-dashboard {
    background: #0d0f24;
    min-height: 100vh;
    padding-bottom: 4rem;
}

/* Header */
.dashboard-header {
    background: linear-gradient(135deg, rgba(22, 33, 62, 0.95) 0%, rgba(83, 52, 131, 0.95) 100%);
    color: white;
    padding: 5rem 0 4rem;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="header-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23header-pattern)"/></svg>');
    opacity: 0.3;
}

.header-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
}

.welcome-section h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.welcome-subtitle {
    font-size: 1.1rem;
    margin: 0;
    opacity: 0.9;
}

.header-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.btn-explore {
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-explore:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.btn-logout {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-logout:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Stats Section */
.stats-section {
    padding: 3rem 0;
    background: rgba(255, 255, 255, 0.04);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.stat-item {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    padding: 2rem;
    display: flex;
    align-items: center;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
    transition: all 0.4s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--accent-cyan), var(--primary-blue));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 1.5rem;
}

.stat-info h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0 0 0.25rem 0;
}

.stat-label {
    color: var(--text-muted);
    margin: 0;
    font-size: 0.9rem;
}

/* Sections */
.featured-section,
.categories-section,
.activity-section {
    padding: 4rem 0;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0 0 0.5rem 0;
}

.section-subtitle {
    color: var(--text-muted);
    margin: 0;
    font-size: 1rem;
}

/* Places Grid */
.places-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.place-card {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 24px 80px rgba(0, 0, 0, 0.18);
    transition: all 0.4s ease;
}

.place-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.place-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.place-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.place-card:hover .place-image img {
    transform: scale(1.05);
}

.place-overlay {
    position: absolute;
    top: 1rem;
    right: 1rem;
}

.place-rating {
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.5rem;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.9rem;
    font-weight: 600;
}

.place-content {
    padding: 1.5rem;
    min-height: 220px;
}

.place-category {
    color: var(--primary-blue);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.place-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0 0 0.5rem 0;
}

.place-description {
    color: var(--text-muted);
    margin: 0 0 1rem 0;
    line-height: 1.5;
}

.place-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.place-price {
    font-weight: 600;
    color: var(--text-dark);
}

.price {
    color: var(--accent-cyan);
}

.price-free {
    color: #28a745;
}

.btn-view {
    background: linear-gradient(135deg, var(--primary-blue), var(--accent-purple));
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.btn-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.no-places {
    grid-column: 1 / -1;
    text-align: center;
    padding: 3rem;
    color: var(--text-muted);
}

.no-places i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Categories */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.category-card {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 25px;
    padding: 2rem;
    text-align: center;
    text-decoration: none;
    color: #ffffff;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.16);
    transition: all 0.4s ease;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.category-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--accent-cyan), var(--primary-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    margin: 0 auto 1rem;
}

.category-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
}

.category-count {
    color: var(--text-muted);
    margin: 0;
    font-size: 0.9rem;
}

/* Activity */
.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-width: 600px;
    margin: 0 auto;
}

.activity-item {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18);
}

.activity-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--accent-cyan), var(--primary-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
}

.activity-content p {
    margin: 0;
}

.activity-text {
    color: var(--text-dark);
    font-weight: 500;
}

.activity-time {
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.no-activity {
    text-align: center;
    padding: 3rem;
    color: var(--text-muted);
}

.no-activity i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 2rem;
    }

    .welcome-section h1 {
        font-size: 2rem;
    }

    .header-actions {
        justify-content: center;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .places-grid {
        grid-template-columns: 1fr;
    }

    .categories-grid {
        grid-template-columns: 1fr;
    }

    .container {
        padding: 0 1rem;
    }

    .featured-section,
    .categories-section,
    .activity-section {
        padding: 2rem 0;
    }
}
</style>
@endsection
