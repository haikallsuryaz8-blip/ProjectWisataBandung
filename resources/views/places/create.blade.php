@extends('layouts.app')

@section('title', 'Tambah Destinasi Wisata')

@section('content')
<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, rgba(26, 26, 46, 0.8) 0%, rgba(83, 52, 131, 0.6) 100%);">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="hero-title" style="font-size: 3rem;">Tambah Destinasi Wisata</h1>
        <p class="text-light opacity-75">Tambahkan destinasi wisata baru ke dalam koleksi Bandung</p>
    </div>
</section>

<!-- Form Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 25px; padding: 3rem;">
                    <form action="{{ route('admin.places.store') }}" method="POST" enctype="multipart/form-data" id="placeForm">
                        @csrf

                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h3 class="mb-4" style="color: #ffffff; font-weight: 700; border-bottom: 2px solid var(--accent-cyan); padding-bottom: 0.5rem;">
                                <i class="fas fa-info-circle me-2" style="color: var(--accent-cyan);"></i>Informasi Dasar
                            </h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control glass-input @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name') }}" placeholder="Nama Destinasi" required>
                                        <label for="name" class="glass-label">Nama Destinasi *</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select glass-input @error('category') is-invalid @enderror"
                                                id="category" name="category" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Gunung" {{ old('category') == 'Gunung' ? 'selected' : '' }}>Gunung</option>
                                            <option value="Danau" {{ old('category') == 'Danau' ? 'selected' : '' }}>Danau</option>
                                            <option value="Hutan" {{ old('category') == 'Hutan' ? 'selected' : '' }}>Hutan</option>
                                            <option value="Air Terjun" {{ old('category') == 'Air Terjun' ? 'selected' : '' }}>Air Terjun</option>
                                            <option value="Camping" {{ old('category') == 'Camping' ? 'selected' : '' }}>Camping</option>
                                        </select>
                                        <label for="category" class="glass-label">Kategori *</label>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control glass-input @error('location') is-invalid @enderror"
                                               id="location" name="location" value="{{ old('location') }}" placeholder="Lokasi" required>
                                        <label for="location" class="glass-label">Lokasi *</label>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control glass-input @error('description') is-invalid @enderror"
                                                  id="description" name="description" placeholder="Deskripsi" style="height: 120px;" required>{{ old('description') }}</textarea>
                                        <label for="description" class="glass-label">Deskripsi *</label>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details Information -->
                        <div class="mb-4">
                            <h3 class="mb-4" style="color: #ffffff; font-weight: 700; border-bottom: 2px solid var(--accent-cyan); padding-bottom: 0.5rem;">
                                <i class="fas fa-list me-2" style="color: var(--accent-cyan);"></i>Detail Informasi
                            </h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control glass-input @error('rating') is-invalid @enderror"
                                               id="rating" name="rating" value="{{ old('rating', 0) }}" placeholder="Rating" min="0" max="5" step="0.1" required>
                                        <label for="rating" class="glass-label">Rating (0-5) *</label>
                                        @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control glass-input @error('visitors') is-invalid @enderror"
                                               id="visitors" name="visitors" value="{{ old('visitors', 0) }}" placeholder="Jumlah Pengunjung" min="0" required>
                                        <label for="visitors" class="glass-label">Jumlah Pengunjung *</label>
                                        @error('visitors')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control glass-input @error('opening_hours') is-invalid @enderror"
                                               id="opening_hours" name="opening_hours" value="{{ old('opening_hours') }}" placeholder="Jam Operasional">
                                        <label for="opening_hours" class="glass-label">Jam Operasional</label>
                                        @error('opening_hours')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control glass-input @error('ticket_price') is-invalid @enderror"
                                               id="ticket_price" name="ticket_price" value="{{ old('ticket_price') }}" placeholder="Harga Tiket" min="0">
                                        <label for="ticket_price" class="glass-label">Harga Tiket (Rp)</label>
                                        @error('ticket_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="url" class="form-control glass-input @error('maps_url') is-invalid @enderror"
                                               id="maps_url" name="maps_url" value="{{ old('maps_url') }}" placeholder="URL Google Maps">
                                        <label for="maps_url" class="glass-label">URL Google Maps</label>
                                        @error('maps_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload -->
                        <div class="mb-4">
                            <h3 class="mb-4" style="color: #ffffff; font-weight: 700; border-bottom: 2px solid var(--accent-cyan); padding-bottom: 0.5rem;">
                                <i class="fas fa-camera me-2" style="color: var(--accent-cyan);"></i>Media
                            </h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="upload-area" id="imageUpload">
                                        <input type="file" id="image" name="image" accept="image/*" class="d-none">
                                        <div class="upload-content">
                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                            <div class="upload-text">Klik untuk upload gambar</div>
                                            <div class="upload-subtext">atau drag & drop di sini</div>
                                            <div class="upload-preview" id="imagePreview"></div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="upload-area" id="videoUpload">
                                        <input type="file" id="video" name="video" accept="video/*" class="d-none">
                                        <div class="upload-content">
                                            <i class="fas fa-video upload-icon"></i>
                                            <div class="upload-text">Klik untuk upload video</div>
                                            <div class="upload-subtext">atau drag & drop di sini</div>
                                            <div class="upload-preview" id="videoPreview"></div>
                                        </div>
                                    </div>
                                    @error('video')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="photos" class="form-label" style="color: #ffffff; font-weight: 600;">Foto Galeri Tambahan</label>
                                <input type="file" id="photos" name="photos[]" accept="image/*" multiple
                                       class="form-control glass-input @error('photos.*') is-invalid @enderror">
                                <small class="text-light opacity-75">Bisa pilih lebih dari satu foto. Format: JPG, PNG, WEBP. Maksimal 2MB per foto.</small>
                                @error('photos.*')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('places.index') }}" class="btn btn-secondary-modern">
                                <i class="fas fa-arrow-left me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary-modern">
                                <i class="fas fa-save me-2"></i>Simpan Destinasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.upload-area {
    background: rgba(255, 255, 255, 0.1);
    border: 2px dashed rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.upload-area:hover {
    border-color: var(--accent-cyan);
    background: rgba(0, 212, 255, 0.1);
}

.upload-icon {
    font-size: 3rem;
    color: var(--accent-cyan);
    margin-bottom: 1rem;
}

.upload-text {
    color: #ffffff;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.upload-subtext {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.upload-preview {
    margin-top: 1rem;
}

.upload-preview img,
.upload-preview video {
    max-width: 100%;
    max-height: 200px;
    border-radius: 10px;
    object-fit: cover;
}

.btn-primary-modern {
    background: var(--gradient-accent);
    border: none;
    color: #000;
    font-weight: 600;
    padding: 0.75rem 2rem;
    border-radius: 15px;
    transition: var(--transition);
}

.btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 212, 255, 0.3);
}

.btn-secondary-modern {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
    font-weight: 600;
    padding: 0.75rem 2rem;
    border-radius: 15px;
    transition: var(--transition);
}

.btn-secondary-modern:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload handling
    function setupFileUpload(uploadAreaId, inputId, previewId, isImage = true) {
        const uploadArea = document.getElementById(uploadAreaId);
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        uploadArea.addEventListener('click', () => input.click());

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'var(--accent-cyan)';
            uploadArea.style.background = 'rgba(0, 212, 255, 0.1)';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = 'rgba(255, 255, 255, 0.3)';
            uploadArea.style.background = 'rgba(255, 255, 255, 0.1)';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'rgba(255, 255, 255, 0.3)';
            uploadArea.style.background = 'rgba(255, 255, 255, 0.1)';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                input.files = files;
                handleFilePreview(files[0], preview, isImage);
            }
        });

        input.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFilePreview(e.target.files[0], preview, isImage);
            }
        });
    }

    function handleFilePreview(file, preview, isImage) {
        preview.innerHTML = '';

        if (isImage) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.onload = () => URL.revokeObjectURL(img.src);
            preview.appendChild(img);
        } else {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.onload = () => URL.revokeObjectURL(video.src);
            preview.appendChild(video);
        }
    }

    setupFileUpload('imageUpload', 'image', 'imagePreview', true);
    setupFileUpload('videoUpload', 'video', 'videoPreview', false);

    // Form validation
    const form = document.getElementById('placeForm');
    form.addEventListener('submit', function(e) {
        // Add loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;

        // Re-enable after 10 seconds as fallback
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 10000);
    });

    // Floating label animation
    document.querySelectorAll('.form-floating input, .form-floating textarea, .form-floating select').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });

        // Check initial state
        if (input.value) {
            input.parentElement.classList.add('focused');
        }
    });
});
</script>
@endsection
