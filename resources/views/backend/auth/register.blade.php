@section('css')
<link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
@endsection
@include('backend.includes.head')
<nav>
    <div class="nav-content">
        <div class="left-item">
            <img src="{{ asset('frontend/images/Black logo - no background.png') }}" alt="">
        </div>
        <div class="right-item">
            <a href="{{route('dashboard')}}" class="getting-start">Getting Start</a>
        </div>
    </div>
</nav>
<div class="nk-main ">
    <div class="nk-wrap nk-wrap-nosidebar ">
        <!-- content @s -->
        <div class="nk-content ">
            <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                <div class="card">
                    <div class="card-inner card-inner-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title text-center">Register</h4>
                            </div>
                        </div>
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        {{-- <div id="successMessage" class="alert alert-success" style="display: none;"></div>
                        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div> --}}
                        <form method="POST" action="{{ route('register.store') }}" id="registerForm">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>

                                <input type="text" name="name" class="form-control form-control-lg" id="name"
                                    placeholder="Enter your name">

                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="form-label" for="email">Email or Username</label>

                                <input type="email" name="email" class="form-control form-control-lg" id="email"
                                    placeholder="Enter your email address or username">

                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="form-label" for="password">Passcode</label>

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
                            <div class="form-group">
                                <button type="submit" id="register"
                                    class="btn btn-lg btn-primary btn-block">Register</button>
                            </div>
                        </form>
                        <div class="form-note-s2 text-center pt-4"> Already have an account? <a
                                href="{{ route('login') }}"><strong>Sign in instead</strong></a>
                        </div>
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
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        // $(document).ready(function() {
        //     $('#register').click(function(e) {
        //         e.preventDefault();

        //         var formData = $('#registerForm').serialize();

        //         $.ajax({
        //             url: '/api/register',
        //             type: 'POST',
        //             data: formData,
        //             success: function(response) {
        //                 console.log(response.success)
        //                 $('#successMessage').text(response.message).show();
        //                 $('#errorMessage').hide();

        //             },
        //             error: function(error) {
        //                 var errors = error.responseJSON.errors;
        //                 $('#errorMessage').empty();
        //                 $.each(errors, function(key, value) {
        //                     $('#errorMessage').append('<div>' + value + '</div>');
        //                 });
        //                 $('#errorMessage').show();
        //                 $('#successMessage').hide();
        //                 console.log(errors);
        //             }

        //         });
        //     })
        // });
    </script>
@endpush
@include('backend.includes.script')
