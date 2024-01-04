@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
@endsection
@include('backend.includes.head')
@include('backend.loader')
<div class="nk-main ">
    <nav>
        <div class="nav-content">
            <div class="left-item">
               <a href="{{route('homepage')}}"> <img src="{{ asset('frontend/images/Black logo - no background.png') }}" alt=""></a>
            </div>
            <div class="right-item">
                <a href="{{ route('dashboard') }}" class="button-1">Getting Start</a>
            </div>
        </div>
    </nav>
    <div class="nk-wrap nk-wrap-nosidebar">
        <!-- content @s -->
        <div class="nk-content ">
            <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                <div class="card">
                    <div class="card-inner card-inner-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title text-center">Reset</h4>

                            </div>
                        </div>
                        @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    

                    <form method="POST" action="{{route('user.password.post')}}">
                        @csrf
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="email" name="email" class="form-control form-control-lg"
                                    id="email" placeholder="Enter your email">
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button  type="submit" class="btn btn-lg btn-primary btn-block">Reset</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="nk-footer nk-auth-footer-full">
                <div class="container wide-lg">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="nk-block-content text-center text-lg-left">
                                <p class="text-soft">&copy; 2019 CryptoLite. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wrap @e -->
    </div>
    <!-- content @e -->
</div>

@include('backend.includes.script')
