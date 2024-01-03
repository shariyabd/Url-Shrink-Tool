@include('backend.includes.head')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow p-5 text-center">
                    <h1>Email Verification Mail</h1>
                   <p> Please verify your email with bellow link:</p>
                    <a href="{{ route('user.verify', $token) }}" class="btn btn-dark mt-2">Verify Email</a>
                </div>
            </div>
        </div>
    </div>
@include('backend.includes.script')