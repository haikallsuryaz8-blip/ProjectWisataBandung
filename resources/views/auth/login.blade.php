@extends('layouts.app')

@section('title', 'Login - Wisata Bandung')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Masuk Wisata Bandung</h1>
            <p class="auth-subtitle">Login sebagai pengguna atau admin untuk membuka dashboard.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="login-helper">
                <p>Pilih akun demo:</p>
                <div class="login-helper-actions">
                    <button type="button" onclick="fillUserLogin()">User</button>
                    <button type="button" onclick="fillAdminLogin()">Admin</button>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="form-input @error('email') is-invalid @enderror">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required
                       class="form-input @error('password') is-invalid @enderror">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn-auth">
                    Masuk Dashboard
                </button>
            </div>

            <div class="auth-links">
                <p>Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar pengguna</a></p>
            </div>
        </form>
    </div>
</div>

<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-purple) 100%);
    position: relative;
    overflow: hidden;
}

body {
    padding-top: 0 !important;
}

.navbar-modern,
main + section,
main + section + section,
main + section + section + footer {
    display: none !important;
}

.auth-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.auth-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    animation: slideUp 0.6s ease-out;
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-title {
    color: var(--text-light);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.auth-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1rem;
    margin: 0;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.login-helper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 12px;
    border: 1px solid rgba(255, 255, 255, 0.22);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.08);
}

.login-helper p {
    margin: 0;
    color: rgba(255, 255, 255, 0.82);
    font-size: 0.9rem;
}

.login-helper-actions {
    display: flex;
    gap: 8px;
}

.login-helper button {
    border: 0;
    border-radius: 8px;
    padding: 8px 10px;
    background: var(--accent-cyan);
    color: #07111f;
    font-weight: 700;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    color: var(--text-light);
    font-weight: 500;
    font-size: 0.9rem;
}

.form-input {
    padding: 0.75rem 1rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--text-light);
    font-size: 1rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.form-input:focus {
    outline: none;
    border-color: var(--accent-cyan);
    box-shadow: 0 0 0 3px rgba(0, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.15);
}

.form-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.btn-auth {
    padding: 0.875rem 2rem;
    background: linear-gradient(135deg, var(--accent-cyan) 0%, var(--accent-purple) 100%);
    border: none;
    border-radius: 10px;
    color: var(--primary-dark);
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 255, 255, 0.3);
}

.btn-auth:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 255, 255, 0.4);
}

.auth-links {
    text-align: center;
    margin-top: 1rem;
}

.auth-link {
    color: var(--accent-cyan);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.auth-link:hover {
    color: var(--text-light);
    text-decoration: underline;
}

.invalid-feedback {
    color: #ff6b6b;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 480px) {
    .auth-card {
        margin: 1rem;
        padding: 1.5rem;
    }

    .auth-title {
        font-size: 1.75rem;
    }
}
</style>

<script>
function fillUserLogin() {
    document.getElementById('email').value = 'user@wisatabandung.test';
    document.getElementById('password').value = 'User12345';
}

function fillAdminLogin() {
    document.getElementById('email').value = 'admin@gmail.com';
    document.getElementById('password').value = 'admin12345';
}
</script>
@endsection
