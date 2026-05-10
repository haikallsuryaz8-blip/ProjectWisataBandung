@extends('layouts.app')

@section('title', 'Destinasi Wisata Bandung')

@section('content')
<!-- Hero Section -->
<section class="hero-fullscreen">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title fade-in" data-aos="fade-up">Jelajahi Keindahan Bandung</h1>
        <p class="hero-subtitle fade-in" data-aos="fade-up" data-aos-delay="200">
            Temukan destinasi wisata alam terbaik di kota Bandung dengan pengalaman yang tak terlupakan
        </p>
        <a href="#destinations" class="btn hero-cta fade-in" data-aos="fade-up" data-aos-delay="400">
            <i class="fas fa-compass me-2"></i>Mulai Petualangan
        </a>
        <div class="scroll-indicator fade-in" data-aos="fade-in" data-aos-delay="600">
            <i class="fas fa-chevron-down text-white" style="font-size: 2rem;"></i>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4" data-aos="fade-up">
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-number">{{ $places->count() }}</div>
                    <div class="stats-label">Destinasi</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-number">{{ $places->sum('visitors') }}</div>
                    <div class="stats-label">Pengunjung</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-number">{{ $places->avg('rating') ? number_format($places->avg('rating'), 1) : '0.0' }}</div>
                    <div class="stats-label">Rating Rata-rata</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-number">{{ $places->unique('category')->count() }}</div>
                    <div class="stats-label">Kategori</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5" id="categories">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="hero-title" style="font-size: 2.5rem;">Kategori Wisata</h2>
            <p class="text-light opacity-75">Pilih kategori wisata yang ingin Anda jelajahi</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="category-card" onclick="filterByCategory('Gunung')">
                    <div class="category-icon"><i class="fas fa-mountain"></i></div>
                    <div class="category-title">Gunung</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="category-card" onclick="filterByCategory('Danau')">
                    <div class="category-icon"><i class="fas fa-water"></i></div>
                    <div class="category-title">Danau</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="category-card" onclick="filterByCategory('Hutan')">
                    <div class="category-icon"><i class="fas fa-tree"></i></div>
                    <div class="category-title">Hutan</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="category-card" onclick="filterByCategory('Air Terjun')">
                    <div class="category-icon"><i class="fas fa-cloud-showers-heavy"></i></div>
                    <div class="category-title">Air Terjun</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="500">
                <div class="category-card" onclick="filterByCategory('Camping')">
                    <div class="category-icon"><i class="fas fa-campground"></i></div>
                    <div class="category-title">Camping</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="600">
                <div class="category-card" onclick="window.location.href='{{ route('places.index') }}'">
                    <div class="category-icon"><i class="fas fa-search"></i></div>
                    <div class="category-title">Semua</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="py-4" id="search">
    <div class="container">
        <div class="search-container" data-aos="fade-up">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6">
                    <input type="text" class="form-control search-input" placeholder="Cari destinasi wisata..." id="liveSearch">
                </div>
                <div class="col-lg-3">
                    <select class="form-select filter-select" id="liveCategoryFilter">
                        <option value="">Semua Kategori</option>
                        <option value="Gunung">Gunung</option>
                        <option value="Danau">Danau</option>
                        <option value="Hutan">Hutan</option>
                        <option value="Air Terjun">Air Terjun</option>
                        <option value="Camping">Camping</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-select filter-select" id="sortFilter">
                        <option value="">Urutkan</option>
                        <option value="rating">Rating Tertinggi</option>
                        <option value="visitors">Pengunjung Terbanyak</option>
                        <option value="name">Nama A-Z</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Destinations Section -->
<section class="py-5" id="destinations">
    <div class="container">
        @if(request('search') || request('category'))
        <div class="alert" style="background: rgba(0, 212, 255, 0.1); border: 1px solid rgba(0, 212, 255, 0.3); border-radius: 15px; color: #ffffff;" data-aos="fade-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-search me-2" style="color: var(--accent-cyan);"></i>
                <div>
                    <strong>Hasil Pencarian</strong>
                    @if(request('search'))
                    <div>Pencarian: "{{ request('search') }}"</div>
                    @endif
                    @if(request('category'))
                    <div>Kategori: {{ request('category') }}</div>
                    @endif
                    <div>Ditemukan: {{ $places->count() }} destinasi</div>
                </div>
                <a href="{{ route('places.index') }}" class="btn btn-sm ms-auto" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff;">
                    <i class="fas fa-times me-1"></i>Tampilkan Semua
                </a>
            </div>
        </div>
        @endif

        @if($places->count() > 0)
        <div class="row g-4" id="placesContainer">
            @foreach($places as $place)
            <div class="col-xl-3 col-lg-4 col-md-6 place-item" data-category="{{ $place->category }}" data-name="{{ strtolower($place->name) }}" data-rating="{{ $place->rating }}" data-visitors="{{ $place->visitors }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 6) * 100 }}">
                <div class="place-card">
                    <div class="place-image" style="background-image: url('{{ $place->image ? asset('storage/' . $place->image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400' }}');">
                        <div class="place-overlay">
                            <span class="badge" style="background: var(--gradient-accent); color: #000; font-weight: 600;">
                                {{ $place->category }}
                            </span>
                        </div>
                    </div>
                    <div class="place-content">
                        <h3 class="place-title">{{ $place->name }}</h3>
                        <div class="place-location">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $place->location }}
                        </div>
                        <div class="place-rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $place->rating)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $place->rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span style="color: var(--accent-cyan); font-weight: 600;">{{ number_format($place->rating, 1) }}</span>
                        </div>
                        <div class="place-stats">
                            <span><i class="fas fa-users me-1"></i>{{ number_format($place->visitors) }}</span>
                            @if($place->ticket_price)
                            <span><i class="fas fa-ticket-alt me-1"></i>Rp {{ number_format($place->ticket_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="place-actions">
                            <a href="{{ route('places.show', $place) }}" class="btn btn-card btn-primary-card">
                                <i class="fas fa-eye me-1"></i>Lihat
                            </a>
                            @if(Auth::check() && Auth::user()->role === 'admin')
                            <div class="dropdown">
                                <button class="btn btn-card btn-secondary-card" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu" style="background: rgba(26, 26, 46, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                                    <li><a class="dropdown-item text-light" href="{{ route('admin.places.edit', $place) }}"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                    <li><hr class="dropdown-divider" style="border-color: rgba(255, 255, 255, 0.1);"></li>
                                    <li>
                                        <form action="{{ route('admin.places.destroy', $place) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-5" data-aos="fade-up">
            <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 25px; padding: 3rem; display: inline-block;">
                <i class="fas fa-search" style="font-size: 4rem; color: var(--accent-cyan); opacity: 0.5;"></i>
                <h3 class="mt-3" style="color: #ffffff;">Tidak ada destinasi ditemukan</h3>
                <p class="text-light opacity-75">Coba ubah kata kunci pencarian atau filter kategori</p>
                <a href="{{ route('places.index') }}" class="btn btn-modern mt-3">
                    <i class="fas fa-home me-2"></i>Kembali ke Semua Destinasi
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Popular Destinations Section -->
<section class="py-5" style="background: rgba(26, 26, 46, 0.3);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="hero-title" style="font-size: 2.5rem;">Destinasi Populer</h2>
            <p class="text-light opacity-75">Tempat wisata paling diminati pengunjung</p>
        </div>
        <div class="row g-4">
            @foreach($places->sortByDesc('visitors')->take(6) as $place)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 200 }}">
                <div class="place-card">
                    <div class="place-image" style="background-image: url('{{ $place->image ? asset('storage/' . $place->image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400' }}');">
                        <div class="place-overlay">
                            <span class="badge" style="background: var(--gradient-accent); color: #000; font-weight: 600;">Populer</span>
                        </div>
                    </div>
                    <div class="place-content">
                        <h3 class="place-title">{{ $place->name }}</h3>
                        <div class="place-location">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $place->location }}
                        </div>
                        <div class="place-rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $place->rating)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $place->rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span style="color: var(--accent-cyan); font-weight: 600;">{{ number_format($place->rating, 1) }}</span>
                        </div>
                        <div class="place-stats">
                            <span><i class="fas fa-users me-1"></i>{{ number_format($place->visitors) }} pengunjung</span>
                        </div>
                        <a href="{{ route('places.show', $place) }}" class="btn btn-card btn-primary-card w-100">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 25px; padding: 3rem;">
                <h2 class="hero-title mb-3" style="font-size: 2.5rem;">Siap Memulai Petualangan?</h2>
                <p class="text-light opacity-75 mb-4">Bergabunglah dengan ribuan wisatawan yang telah menjelajahi keindahan Bandung</p>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.places.create') }}" class="btn hero-cta me-3">
                        <i class="fas fa-plus me-2"></i>Tambah Destinasi Baru
                    </a>
                @endif
                <a href="#categories" class="btn" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff;">
                    <i class="fas fa-compass me-2"></i>Jelajahi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Live search and filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const liveSearch = document.getElementById('liveSearch');
        const liveCategoryFilter = document.getElementById('liveCategoryFilter');
        const sortFilter = document.getElementById('sortFilter');
        const placesContainer = document.getElementById('placesContainer');
        const placeItems = document.querySelectorAll('.place-item');

        function filterPlaces() {
            const searchTerm = liveSearch.value.toLowerCase();
            const categoryFilter = liveCategoryFilter.value;
            const sortBy = sortFilter.value;

            let visibleItems = Array.from(placeItems);

            // Filter by search term
            if (searchTerm) {
                visibleItems = visibleItems.filter(item => {
                    const name = item.dataset.name;
                    return name.includes(searchTerm);
                });
            }

            // Filter by category
            if (categoryFilter) {
                visibleItems = visibleItems.filter(item => {
                    return item.dataset.category === categoryFilter;
                });
            }

            // Sort items
            if (sortBy) {
                visibleItems.sort((a, b) => {
                    switch(sortBy) {
                        case 'rating':
                            return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
                        case 'visitors':
                            return parseInt(b.dataset.visitors) - parseInt(a.dataset.visitors);
                        case 'name':
                            return a.dataset.name.localeCompare(b.dataset.name);
                        default:
                            return 0;
                    }
                });
            }

            // Hide all items first
            placeItems.forEach(item => {
                item.style.display = 'none';
                item.style.opacity = '0';
            });

            // Show filtered items with animation
            visibleItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 100);
            });
        }

        liveSearch.addEventListener('input', filterPlaces);
        liveCategoryFilter.addEventListener('change', filterPlaces);
        sortFilter.addEventListener('change', filterPlaces);
    });

    function filterByCategory(category) {
        const categoryFilter = document.getElementById('liveCategoryFilter');
        categoryFilter.value = category;
        categoryFilter.dispatchEvent(new Event('change'));
        document.getElementById('destinations').scrollIntoView({ behavior: 'smooth' });
    }

    // Loading skeleton for images
    document.querySelectorAll('.place-image').forEach(img => {
        const skeleton = document.createElement('div');
        skeleton.className = 'skeleton';
        skeleton.style.width = '100%';
        skeleton.style.height = '100%';
        skeleton.style.position = 'absolute';
        skeleton.style.top = '0';
        skeleton.style.left = '0';
        img.appendChild(skeleton);

        const bgImg = new Image();
        bgImg.onload = function() {
            skeleton.style.display = 'none';
        };
        bgImg.src = img.style.backgroundImage.slice(5, -2);
    });
</script>
@endsection
