@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
@endsection
@include('backend.includes.head')
<nav>
    <div class="nav-content">
        <div class="left-item">
           <a href="{{route('homepage')}}"> <img src="{{ asset('frontend/images/Black logo - no background.png') }}" alt=""></a>
        </div>
        <div class="right-item">
            <a href="{{ route('dashboard') }}" class="getting-start">Getting Start</a>
        </div>
    </div>
</nav>
<div class="nk-main ">
    <!-- wrap @s -->
    <div class="nk-wrap nk-wrap-nosidebar">
        <!-- content @s -->
        <div class="nk-content ">
            <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                <div class="card">
                    <div class="card-inner card-inner-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title text-center">Sign-In</h4>

                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif


                        <div id="successMessage" class="alert alert-success" style="display: none;"></div>
                        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
                        <form method="POST" action="{{ route('login.store') }}" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="default-01">Email or Username</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input type="email" id="email" name="email"
                                        class="form-control form-control-lg" id="default-01"
                                        placeholder="Enter your email address or username">
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password">Passcode</label>
                                    <a class="link link-primary link-sm"
                                        href="{{route('user.password.get')}}">Forgot Code?</a>
                                </div>
                                <div class="form-control-wrap">
                                    <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                        data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="password" placeholder="Enter your passcode">
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button id="login" class="btn btn-lg btn-primary btn-block">Sign in</button>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('register.create') }}">Create An Account</a>
                                    <a href="{{ route('user.password.get') }}">Forgot Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer>
                <p class="pt-3">© All Right Reserved By Shariya Shuvo, 2023</p>
            </footer>
        </div>
        <!-- wrap @e -->
    </div>
    <!-- content @e -->
</div>
{{-- @push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#login').click(function(e) {
                e.preventDefault();

                var formData = $('#loginForm').serialize();

                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        $('#successMessage').text(response.message).show();
                        $('#errorMessage').hide();
                        if (response.success && response.token) {

                            localStorage.setItem('accessToken', response.token);

                            // Redirect to the dashboard route
                            window.location.href = "{{ url('api/dashboard') }}";
                        } else {
                            // Handle a scenario where the token is not present in the response
                            console.error('Access token not found in the response.');
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = JSON.parse(xhr.responseText).error;
                        $('#errorMessage').empty();

                        $.each(errors, function(key, value) {
                            $('#errorMessage').append('<div>' + value + '</div>');
                        });
                        $('#errorMessage').show();
                        $('#successMessage').hide();

                        console.log(errors);
                    }
                });
            })
        });
    </script>
@endpush --}}
@include('backend.includes.script')
