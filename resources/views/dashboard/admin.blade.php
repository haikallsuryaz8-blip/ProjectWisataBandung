@extends('layouts.app')

@section('title', 'Admin Dashboard - Wisata Bandung')

@section('content')
<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <span class="admin-brand-icon"><i class="fas fa-map-marked-alt"></i></span>
            <div>
                <h2>Admin Panel</h2>
                <p>Wisata Bandung</p>
            </div>
        </div>

        <nav class="admin-menu">
            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('places.index') }}">
                <i class="fas fa-map-marker-alt"></i>
                <span>Data Wisata</span>
            </a>
            <a href="{{ route('admin.places.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Wisata</span>
            </a>
            <a href="{{ route('home') }}">
                <i class="fas fa-globe"></i>
                <span>Lihat Website</span>
            </a>
        </nav>

        <div class="admin-account">
            <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <strong>{{ Auth::user()->name }}</strong>
                <small>{{ Auth::user()->email }}</small>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="admin-logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            <div>
                <p class="admin-kicker">Dashboard Administrator</p>
                <h1>Selamat datang, {{ Auth::user()->name }}</h1>
                <p>Kelola data destinasi wisata, pantau user, dan cek performa website dari satu halaman.</p>
            </div>
            <a href="{{ route('admin.places.create') }}" class="admin-primary-btn">
                <i class="fas fa-plus"></i>
                <span>Tambah Wisata</span>
            </a>
        </header>

        <section class="admin-stats">
            <div class="admin-stat-card">
                <span class="stat-icon blue"><i class="fas fa-map-location-dot"></i></span>
                <p>Total Wisata</p>
                <strong>{{ $placesCount ?? 0 }}</strong>
            </div>
            <div class="admin-stat-card">
                <span class="stat-icon green"><i class="fas fa-users"></i></span>
                <p>Total User</p>
                <strong>{{ $usersCount ?? 0 }}</strong>
            </div>
            <div class="admin-stat-card">
                <span class="stat-icon orange"><i class="fas fa-eye"></i></span>
                <p>Total Pengunjung</p>
                <strong>{{ number_format($totalVisitors ?? 0) }}</strong>
            </div>
            <div class="admin-stat-card">
                <span class="stat-icon yellow"><i class="fas fa-star"></i></span>
                <p>Rating Rata-rata</p>
                <strong>{{ $averageRating ? number_format($averageRating, 1) : '0.0' }}</strong>
            </div>
        </section>

        <section class="admin-grid">
            <div class="admin-panel wide">
                <div class="panel-header">
                    <div>
                        <h2>Destinasi Terbaru</h2>
                        <p>Data wisata yang baru ditambahkan atau diperbarui.</p>
                    </div>
                    <a href="{{ route('places.index') }}">Lihat semua</a>
                </div>

                <div class="table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nama Wisata</th>
                                <th>Kategori</th>
                                <th>Rating</th>
                                <th>Pengunjung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPlaces as $place)
                                <tr>
                                    <td>
                                        <strong>{{ $place->name }}</strong>
                                        <small>{{ $place->location }}</small>
                                    </td>
                                    <td>{{ $place->category }}</td>
                                    <td><i class="fas fa-star text-warning"></i> {{ number_format($place->rating, 1) }}</td>
                                    <td>{{ number_format($place->visitors) }}</td>
                                    <td>
                                        <a href="{{ route('admin.places.edit', $place) }}" class="table-action">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">Belum ada data wisata.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="admin-panel">
                <div class="panel-header">
                    <div>
                        <h2>User Terbaru</h2>
                        <p>Akun yang terdaftar di website.</p>
                    </div>
                </div>

                <div class="user-list">
                    @forelse($recentUsers as $user)
                        <div class="user-row">
                            <div class="user-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div>
                                <strong>{{ $user->name }}</strong>
                                <small>{{ $user->email }}</small>
                            </div>
                            <span class="role-badge {{ $user->role === 'admin' ? 'admin' : '' }}">{{ $user->role }}</span>
                        </div>
                    @empty
                        <p class="empty-state">Belum ada user.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="admin-panel content-manager">
            <div class="panel-header">
                <div>
                    <h2>Kelola Konten Website</h2>
                    <p>Ubah nama, deskripsi, lokasi, harga tiket, rating, gambar, dan video wisata.</p>
                </div>
                <a href="{{ route('admin.places.create') }}">Tambah wisata</a>
            </div>

            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Destinasi</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Update Konten</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($places as $place)
                            <tr>
                                <td>
                                    <strong>{{ $place->name }}</strong>
                                    <small>{{ $place->category }} - {{ $place->location }}</small>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($place->description, 90) }}</td>
                                <td>
                                    @if($place->ticket_price)
                                        Rp {{ number_format($place->ticket_price, 0, ',', '.') }}
                                    @else
                                        Gratis
                                    @endif
                                </td>
                                <td>
                                    <div class="content-actions">
                                        <a href="{{ route('admin.places.edit', $place) }}" class="table-action">Edit</a>
                                        <form action="{{ route('admin.places.destroy', $place) }}" method="POST" onsubmit="return confirm('Hapus destinasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">Belum ada konten wisata untuk dikelola.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-panel">
            <div class="panel-header">
                <div>
                    <h2>Akses Cepat</h2>
                    <p>Menu yang paling sering dipakai admin.</p>
                </div>
            </div>
            <div class="quick-actions">
                <a href="{{ route('admin.places.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Tambah destinasi baru</span>
                </a>
                <a href="{{ route('places.index') }}">
                    <i class="fas fa-list"></i>
                    <span>Kelola daftar wisata</span>
                </a>
                <a href="{{ route('home') }}">
                    <i class="fas fa-house"></i>
                    <span>Buka halaman utama</span>
                </a>
            </div>
        </section>
    </main>
</div>

<style>
body {
    padding-top: 0 !important;
    background: #eef3f8 !important;
    color: #172033 !important;
}

.navbar-modern,
main + section,
main + section + section,
main + section + section + footer {
    display: none !important;
}

.admin-shell {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 280px 1fr;
    background: #eef3f8;
}

.admin-sidebar {
    background: #111827;
    color: #ffffff;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    position: sticky;
    top: 0;
    min-height: 100vh;
}

.admin-brand,
.admin-account,
.admin-menu a,
.admin-logout,
.admin-primary-btn,
.quick-actions a,
.user-row {
    display: flex;
    align-items: center;
}

.admin-brand {
    gap: 12px;
}

.admin-brand-icon {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    background: #38bdf8;
    color: #082f49;
    display: grid;
    place-items: center;
    font-size: 20px;
}

.admin-brand h2,
.admin-header h1,
.panel-header h2 {
    margin: 0;
}

.admin-brand p,
.admin-header p,
.panel-header p,
.admin-stat-card p,
.admin-account small,
.admin-table small,
.user-row small {
    margin: 0;
    color: #718096;
}

.admin-brand p,
.admin-account small {
    color: #9ca3af;
}

.admin-menu {
    display: grid;
    gap: 8px;
}

.admin-menu a {
    gap: 12px;
    color: #d1d5db;
    text-decoration: none;
    padding: 12px 14px;
    border-radius: 8px;
}

.admin-menu a:hover,
.admin-menu a.active {
    background: #1f2937;
    color: #ffffff;
}

.admin-account {
    gap: 12px;
    margin-top: auto;
    padding-top: 18px;
    border-top: 1px solid #263244;
}

.admin-avatar,
.user-initial {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #38bdf8;
    color: #082f49;
    display: grid;
    place-items: center;
    font-weight: 800;
    flex: 0 0 auto;
}

.admin-logout {
    width: 100%;
    gap: 10px;
    border: 0;
    border-radius: 8px;
    background: #7f1d1d;
    color: #ffffff;
    padding: 12px 14px;
    font-weight: 700;
}

.admin-main {
    padding: 32px;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: flex-start;
    margin-bottom: 24px;
}

.admin-kicker {
    color: #2563eb !important;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .08em;
    font-size: 12px;
}

.admin-primary-btn {
    gap: 10px;
    background: #2563eb;
    color: #ffffff;
    border-radius: 8px;
    padding: 12px 16px;
    text-decoration: none;
    font-weight: 800;
    white-space: nowrap;
}

.admin-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.admin-stat-card,
.admin-panel {
    background: #ffffff;
    border: 1px solid #dbe4ef;
    border-radius: 8px;
    box-shadow: 0 12px 30px rgba(15, 23, 42, .06);
}

.admin-stat-card {
    padding: 20px;
}

.admin-stat-card strong {
    display: block;
    font-size: 32px;
    color: #111827;
    margin-top: 6px;
}

.stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 8px;
    display: grid;
    place-items: center;
    margin-bottom: 14px;
}

.stat-icon.blue { background: #dbeafe; color: #1d4ed8; }
.stat-icon.green { background: #dcfce7; color: #15803d; }
.stat-icon.orange { background: #ffedd5; color: #c2410c; }
.stat-icon.yellow { background: #fef9c3; color: #a16207; }

.admin-grid {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(320px, 1fr);
    gap: 24px;
    margin-bottom: 24px;
}

.admin-panel {
    padding: 22px;
}

.panel-header {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
}

.panel-header a,
.table-action {
    color: #2563eb;
    font-weight: 800;
    text-decoration: none;
}

.table-wrap {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th,
.admin-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #e5edf5;
    vertical-align: middle;
}

.admin-table th {
    color: #526172;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .05em;
}

.admin-table small,
.user-row small {
    display: block;
}

.user-list {
    display: grid;
    gap: 12px;
}

.user-row {
    gap: 12px;
    padding: 12px;
    border: 1px solid #e5edf5;
    border-radius: 8px;
}

.role-badge {
    margin-left: auto;
    padding: 4px 8px;
    border-radius: 999px;
    background: #e5e7eb;
    color: #374151;
    font-size: 12px;
    font-weight: 800;
}

.role-badge.admin {
    background: #dbeafe;
    color: #1d4ed8;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.content-manager {
    margin-bottom: 24px;
}

.content-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.content-actions form {
    margin: 0;
}

.content-actions button {
    border: 0;
    background: transparent;
    color: #dc2626;
    font-weight: 800;
    padding: 0;
}

.quick-actions a {
    gap: 10px;
    padding: 16px;
    border: 1px solid #dbe4ef;
    border-radius: 8px;
    color: #172033;
    text-decoration: none;
    font-weight: 800;
}

.quick-actions a:hover {
    border-color: #2563eb;
    color: #2563eb;
}

.empty-state {
    color: #718096;
    text-align: center;
    padding: 18px;
}

@media (max-width: 1100px) {
    .admin-shell,
    .admin-grid {
        grid-template-columns: 1fr;
    }

    .admin-sidebar {
        position: static;
        min-height: auto;
    }

    .admin-stats,
    .quick-actions {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 700px) {
    .admin-main,
    .admin-sidebar {
        padding: 18px;
    }

    .admin-header {
        display: grid;
    }

    .admin-stats,
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
