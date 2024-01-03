@include('backend.includes.head')
<div class="nk-main ">
    <!-- wrap @s -->
    <div class="nk-header nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ml-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                            class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="html/index.html" class="logo-link">
                        <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x"
                            alt="logo">
                        <img class="logo-dark logo-img" src="./images/logo-dark.png"
                            srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div><!-- .nk-header-brand -->
                <div class="nk-header-search ml-3 ml-xl-0">
                    <h2>Shariya</h2>
                </div><!-- .nk-header-news -->
                <div class="nk-header-tools">
                    <h2>Getting start</h2>
                </div>
            </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
    </div>
    <br><br>
    <div class="nk-wrap nk-wrap-nosidebar mt-5">
        <!-- content @s -->
        <div class="nk-content ">
            <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                <div class="card">
                    <div class="card-inner card-inner-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title text-center">Reset Your Password</h4>
                            </div>
                        </div>
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        {{-- <div id="successMessage" class="alert alert-success" style="display: none;"></div>
                        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div> --}}
                        <form method="POST" action="{{ route('password.update') }}" >
                            @csrf

                            <input type="hidden" name="token" value="{{$token}}">
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
                                <button type="submit" id="update"
                                    class="btn btn-lg btn-primary btn-block">Update</button>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
            <div class="nk-footer nk-auth-footer-full">
                <div class="row g-3 bg-dark">
                    <div class="col-lg-12">
                        <div class="nk-block-content text-center ">
                            <p class="text-light text-center">&copy; All Right Reserved By Shariya Shuvo, 2023</p>
                        </div>
                    </div>
                </div>
            </div>
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
@endpush --}}
@include('backend.includes.script')
