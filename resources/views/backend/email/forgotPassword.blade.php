@include('backend.includes.head')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="card p-5 shadow rounded">
                <h1>Forget Password Email</h1>
               <p>You can reset password from bellow link:</p> 
                <a href="{{ route('user.password.reset', $token) }}" class="btn btn-dark text-light">Reset Password</a>
            </div>
        </div>
    </div>
</div>
@include('backend.includes.script')