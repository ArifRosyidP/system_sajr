@extends('main')


@section('login')
    <!--begin::Body-->

    <body class="login-page bg-body-secondary">
        <div class="login-box">
            <div class="login-logo d-flex justify-content-center">
                <a href="../index2.html">
                    <img src="{{ asset('assets/img/logo PT Sarana Abadi Jaya Raya.png') }}" alt="SAJR Logo"
                        class="opacity-75" /></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="{{ route('login.auth') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="bi bi-envelope"></span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                autofocus required value="{{ old('email') }}" />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" autofocus required>
                        </div>

                        <!--begin::Row-->
                        <div class="row">
                            {{-- <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                            </div>
                        </div> --}}
                            <!-- /.col -->
                            {{-- <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div> --}}
                            <!-- /.col -->
                        </div>
                        <!--end::Row-->
                        <div class="text-center mb-3 mt-3 d-grid">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                            <p class="mb-2 mt-2 text-center">- Belum memiliki akun? -</p>
                            <a href="/register" class="btn btn-danger">
                                Register
                            </a>
                        </div>
                    </form>

                    <!-- /.social-auth-links -->

                    <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </body>
    <!--end::Body-->
@endsection

@push('LoginJs')

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // ganti icon
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let swalData = localStorage.getItem('swal');

            if (swalData) {
                let data = JSON.parse(swalData);

                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.icon,
                    showConfirmButton: false,
                    timer: 1500
                });

                // hapus setelah dipakai
                localStorage.removeItem('swal');
            }
        });
    </script>

    @if (session('alert'))
        <script>
            Swal.fire({
                title: "{{ session('alert.title') }}",
                text: "{{ session('alert.text') }}",
                icon: "{{ session('alert.icon') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

@endpush
