@extends('main')

@section('register')
    <!--begin::Body-->

    <body class="register-page bg-body-secondary">
        <div class="register-box">
            <div class="register-logo justify-content-center">
                <a href="../index2.html">
                    <img src="{{ asset('assets/img/logo PT Sarana Abadi Jaya Raya.png') }}" alt="SAJR Logo"
                        class="opacity-75" /></a>
            </div>
            <!-- /.register-logo -->
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="register-box-msg">Daftar Akun Baru</p>

                    <form action="#" id="registerForm" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="bi bi-person"></span>
                            </div>
                            <input type="text" name="nama" class="form-control" placeholder="Full Name" id="nama"
                                autofocus required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="bi bi-envelope"></span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                autofocus required />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" autofocus required>
                        </div>
                        <div class="text-center mb-3 mt-3 d-grid">
                            <button type="submit" class="btn btn-primary">Register</button>
                            {{-- <a type="submit" class="btn btn-primary">
                            Register
                        </a> --}}
                        </div>
                    </form>

                    <!-- /.social-auth-links -->

                    <p class="mb-0">
                        <a href="/login" class="text-center"> Sudah memiliki akun? </a>
                    </p>
                </div>
                <!-- /.register-card-body -->
            </div>
        </div>
        <!-- /.register-box -->
    </body>
    <!--end::Body-->
@endsection

@push('RegisterJs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! \Proengsoft\JsValidation\Facades\JsValidatorFacade::formRequest(
        'App\Http\Requests\RegisterRequest',
        '#registerForm',
    ) !!}

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
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this)

            //add acount
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                type: "POST",
                url: "{{ route('register.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // simpan alert ke browser
                    localStorage.setItem('swal', JSON.stringify(response));

                    // redirect ke login
                    window.location.href = response.redirect;
                    // Swal.fire({
                    //     title: response.title,
                    //     text: response.text,
                    //     icon: response.icon,
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                },
                error: function(jqXHR) {
                    if (jqXHR.status === 422) {
                        let errors = jqXHR.responseJSON.errors;
                        let message = '';

                        for (let field in errors) {
                            message += errors[field][0] + '<br>';
                        }
                        Swal.fire({
                            title: 'Validation Error',
                            html: message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // Swal.fire({
                        //     title: 'Validation Error',
                        //     html: message,
                        //     icon: 'error'
                        // });

                    } else {
                        Swal.fire({
                            title: 'Server Error',
                            text: 'Terjadi kesalahan pada server',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Swal.fire({
                        //     title: 'Server Error',
                        //     text: 'Terjadi kesalahan pada server',
                        //     icon: 'error'
                        // });
                    }
                    // alert("Error : " + jqXHR.responseText);
                }
            })
        });
    </script>
@endpush
