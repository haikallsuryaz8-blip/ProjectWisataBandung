@extends('layouts.app')

@section('title', $place->name . ' - Wisata Bandung')

@section('content')
<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, rgba(26, 26, 46, 0.8) 0%, rgba(83, 52, 131, 0.6) 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ $place->image ? asset('storage/' . $place->image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800' }}'); background-size: cover; background-position: center; filter: blur(2px); opacity: 0.3;"></div>
    <div class="container position-relative" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge me-3" style="background: var(--gradient-accent); color: #000; font-weight: 600; font-size: 0.9rem;">
                        {{ $place->category }}
                    </span>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $place->rating)
                                <i class="fas fa-star" style="color: #ffd700;"></i>
                            @elseif($i - 0.5 <= $place->rating)
                                <i class="fas fa-star-half-alt" style="color: #ffd700;"></i>
                            @else
                                <i class="far fa-star" style="color: #ffd700;"></i>
                            @endif
                        @endfor
                        <span class="ms-2" style="color: var(--accent-cyan); font-weight: 600;">{{ number_format($place->rating, 1) }}/5</span>
                    </div>
                </div>
                <h1 class="hero-title mb-3" style="font-size: 3rem;">{{ $place->name }}</h1>
                <div class="d-flex align-items-center mb-4">
                    <i class="fas fa-map-marker-alt me-2" style="color: var(--accent-cyan);"></i>
                    <span style="color: #ffffff; opacity: 0.9;">{{ $place->location }}</span>
                </div>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.places.edit', $place) }}" class="btn btn-modern">
                            <i class="fas fa-edit me-2"></i>Edit Destinasi
                        </a>
                        <form action="{{ route('admin.places.destroy', $place) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: rgba(220, 53, 69, 0.8); border: 1px solid rgba(220, 53, 69, 0.5); color: #ffffff;">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem; text-align: center;">
                    <div class="stats-number mb-2" style="font-size: 2rem;">{{ number_format($place->visitors) }}</div>
                    <div class="stats-label">Pengunjung</div>
                    @if($place->ticket_price)
                    <hr style="border-color: rgba(255, 255, 255, 0.2);">
                    <div class="stats-number mb-2" style="font-size: 1.5rem;">Rp {{ number_format($place->ticket_price, 0, ',', '.') }}</div>
                    <div class="stats-label">Harga Tiket</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
@if($place->image || $place->video_path || $place->photos->count())
<section class="py-5">
    <div class="container" data-aos="fade-up">
        <h2 class="hero-title mb-4" style="font-size: 2.5rem;">Galeri</h2>
        <div class="row g-4">
            @if($place->image)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; height: 400px;">
                    <img src="{{ asset('storage/' . $place->image) }}" alt="{{ $place->name }}" style="width: 100%; height: 100%; object-fit: cover;" class="hover-zoom">
                </div>
            </div>
            @endif
            @foreach($place->photos as $photo)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ 200 + ($loop->index * 100) }}">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; height: 400px;">
                    <img src="{{ asset('storage/' . $photo->path) }}" alt="Foto {{ $place->name }} {{ $loop->iteration }}" style="width: 100%; height: 100%; object-fit: cover;" class="hover-zoom">
                </div>
            </div>
            @endforeach
            @if($place->video_path)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; height: 400px;">
                    <video controls style="width: 100%; height: 100%; object-fit: cover;">
                        <source src="{{ asset('storage/' . $place->video_path) }}" type="video/mp4">
                        <source src="{{ asset('storage/' . $place->video_path) }}" type="video/webm">
                        <source src="{{ asset('storage/' . $place->video_path) }}" type="video/ogg">
                        Browser Anda tidak mendukung pemutar video ini.
                    </video>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Details Section -->
<section class="py-5" style="background: rgba(26, 26, 46, 0.3);">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8" data-aos="fade-up">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem;">
                    <h3 class="mb-4" style="color: #ffffff; font-weight: 700;">Tentang Destinasi</h3>
                    <p style="color: rgba(255, 255, 255, 0.9); line-height: 1.8; font-size: 1.1rem;">{{ $place->description }}</p>
                </div>

                <!-- Operating Hours -->
                @if($place->opening_hours)
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem; margin-top: 2rem;" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="mb-3" style="color: #ffffff; font-weight: 600;">
                        <i class="fas fa-clock me-2" style="color: var(--accent-cyan);"></i>Jam Operasional
                    </h4>
                    <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.1rem;">{{ $place->opening_hours }}</p>
                </div>
                @endif

                <!-- Facilities -->
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem; margin-top: 2rem;" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="mb-3" style="color: #ffffff; font-weight: 600;">
                        <i class="fas fa-concierge-bell me-2" style="color: var(--accent-cyan);"></i>Fasilitas
                    </h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-parking me-3" style="color: var(--accent-emerald); width: 20px;"></i>
                                <span style="color: rgba(255, 255, 255, 0.9);">Area Parkir</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-utensils me-3" style="color: var(--accent-emerald); width: 20px;"></i>
                                <span style="color: rgba(255, 255, 255, 0.9);">Warung Makan</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-restroom me-3" style="color: var(--accent-emerald); width: 20px;"></i>
                                <span style="color: rgba(255, 255, 255, 0.9);">Toilet</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-camera me-3" style="color: var(--accent-emerald); width: 20px;"></i>
                                <span style="color: rgba(255, 255, 255, 0.9);">Spot Foto</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <!-- Map Section -->
                @if($place->maps_url)
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem; margin-bottom: 2rem;">
                    <h4 class="mb-3" style="color: #ffffff; font-weight: 600;">
                        <i class="fas fa-map-marked-alt me-2" style="color: var(--accent-cyan);"></i>Lokasi
                    </h4>
                    <div style="border-radius: 15px; overflow: hidden; height: 250px;">
                        <iframe src="{{ str_replace('https://maps.google.com', 'https://www.google.com/maps/embed?pb=', $place->maps_url) }}"
                                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                    <a href="{{ $place->maps_url }}" target="_blank" class="btn btn-modern w-100 mt-3">
                        <i class="fas fa-external-link-alt me-2"></i>Buka di Google Maps
                    </a>
                </div>
                @endif

                <!-- Quick Info -->
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem;">
                    <h4 class="mb-3" style="color: #ffffff; font-weight: 600;">
                        <i class="fas fa-info-circle me-2" style="color: var(--accent-cyan);"></i>Informasi Cepat
                    </h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: rgba(255, 255, 255, 0.8);">Kategori:</span>
                        <span style="color: #ffffff; font-weight: 600;">{{ $place->category }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: rgba(255, 255, 255, 0.8);">Rating:</span>
                        <span style="color: var(--accent-cyan); font-weight: 600;">{{ number_format($place->rating, 1) }}/5</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: rgba(255, 255, 255, 0.8);">Pengunjung:</span>
                        <span style="color: #ffffff; font-weight: 600;">{{ number_format($place->visitors) }}</span>
                    </div>
                    @if($place->ticket_price)
                    <div class="d-flex justify-content-between">
                        <span style="color: rgba(255, 255, 255, 0.8);">Harga Tiket:</span>
                        <span style="color: var(--accent-emerald); font-weight: 600;">Rp {{ number_format($place->ticket_price, 0, ',', '.') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visitor Comments -->
<section class="py-5" style="background: rgba(26, 26, 46, 0.35);">
    <div class="container" data-aos="fade-up">
        <div class="row g-4">
            <div class="col-lg-5">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem;">
                    <h2 class="mb-3" style="color: #ffffff; font-weight: 700;">Beri Komentar</h2>
                    <p class="text-light opacity-75">Bagikan pengalaman Anda tentang tempat wisata ini.</p>

                    <form action="{{ route('places.comments.store', $place) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="rating" class="form-label" style="color: #ffffff;">Rating</label>
                            <select id="rating" name="rating" class="form-select glass-input">
                                <option value="">Pilih rating</option>
                                <option value="5">5 - Sangat bagus</option>
                                <option value="4">4 - Bagus</option>
                                <option value="3">3 - Cukup</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Buruk</option>
                            </select>
                            @error('rating')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label" style="color: #ffffff;">Komentar</label>
                            <textarea id="comment" name="comment" rows="5" class="form-control glass-input" placeholder="Tulis komentar Anda..." required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-modern w-100">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Komentar
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem;">
                    <h2 class="mb-4" style="color: #ffffff; font-weight: 700;">Komentar Pengunjung</h2>

                    @forelse($place->comments->sortByDesc('created_at') as $comment)
                        <div class="visitor-comment">
                            <div class="d-flex justify-content-between gap-3">
                                <div>
                                    <strong>{{ $comment->user->name }}</strong>
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                @if($comment->rating)
                                    <span class="comment-rating">
                                        <i class="fas fa-star"></i> {{ $comment->rating }}/5
                                    </span>
                                @endif
                            </div>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-comments" style="font-size: 3rem; color: var(--accent-cyan); opacity: .6;"></i>
                            <h4 class="mt-3" style="color: #ffffff;">Belum ada komentar</h4>
                            <p class="text-light opacity-75">Jadilah pengunjung pertama yang memberi komentar.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Destinations -->
<section class="py-5">
    <div class="container" data-aos="fade-up">
        <h2 class="hero-title mb-4" style="font-size: 2.5rem;">Destinasi Terkait</h2>
        <div class="row g-4">
            @php
                $relatedPlaces = \App\Models\Place::where('category', $place->category)
                    ->where('id', '!=', $place->id)
                    ->take(3)
                    ->get();
            @endphp
            @forelse($relatedPlaces as $relatedPlace)
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index + 1) * 100 }}">
                <div class="place-card">
                    <div class="place-image" style="background-image: url('{{ $relatedPlace->image ? asset('storage/' . $relatedPlace->image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400' }}');">
                        <div class="place-overlay">
                            <span class="badge" style="background: var(--gradient-accent); color: #000; font-weight: 600;">
                                {{ $relatedPlace->category }}
                            </span>
                        </div>
                    </div>
                    <div class="place-content">
                        <h3 class="place-title">{{ $relatedPlace->name }}</h3>
                        <div class="place-location">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $relatedPlace->location }}
                        </div>
                        <div class="place-rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $relatedPlace->rating)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $relatedPlace->rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span style="color: var(--accent-cyan); font-weight: 600;">{{ number_format($relatedPlace->rating, 1) }}</span>
                        </div>
                        <a href="{{ route('places.show', $relatedPlace) }}" class="btn btn-card btn-primary-card w-100">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 3rem; display: inline-block;">
                    <i class="fas fa-search" style="font-size: 3rem; color: var(--accent-cyan); opacity: 0.5;"></i>
                    <h4 class="mt-3" style="color: #ffffff;">Belum ada destinasi terkait</h4>
                    <a href="{{ route('places.index') }}" class="btn btn-modern mt-3">
                        <i class="fas fa-compass me-2"></i>Jelajahi Semua Destinasi
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Back to Top -->
<button id="backToTop" style="position: fixed; bottom: 2rem; right: 2rem; background: var(--gradient-accent); border: none; border-radius: 50%; width: 50px; height: 50px; color: #000; font-size: 1.2rem; cursor: pointer; opacity: 0; transition: var(--transition); z-index: 1000;">
    <i class="fas fa-arrow-up"></i>
</button>

<style>
.visitor-comment {
    border-bottom: 1px solid rgba(255, 255, 255, 0.14);
    padding: 0 0 1rem;
    margin-bottom: 1rem;
}

.visitor-comment:last-child {
    border-bottom: 0;
    margin-bottom: 0;
    padding-bottom: 0;
}

.visitor-comment strong {
    color: #ffffff;
    display: block;
}

.visitor-comment small,
.visitor-comment p {
    color: rgba(255, 255, 255, 0.75);
}

.visitor-comment p {
    margin: .75rem 0 0;
    line-height: 1.7;
}

.comment-rating {
    color: #ffd700;
    font-weight: 700;
    white-space: nowrap;
}
</style>

<script>
    // Back to top button
    window.addEventListener('scroll', function() {
        const backToTop = document.getElementById('backToTop');
        if (window.scrollY > 300) {
            backToTop.style.opacity = '1';
        } else {
            backToTop.style.opacity = '0';
        }
    });

    document.getElementById('backToTop').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Image zoom effect
    document.querySelectorAll('.hover-zoom').forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.3s ease';
        });

        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
</script>
@endsection
