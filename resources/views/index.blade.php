<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="" type="image/png" sizes="48x48" title="Shrink-Url">
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    <title>Shrink Url</title>

   
</head>


<body>

    <nav>
        <div class="nav-content">
            <div class="left-item">
                <img src="{{ asset('frontend/images/Black logo - no background.png') }}" alt="">
            </div>
            <div class="right-item">
                {{-- <a href="{{route('dashboard')}}" class="getting-start">Getting Start</a> --}}
            </div>
        </div>
    </nav>


    <main>
        <div class="main-content">
            <div class="left-item">
                <h1>Url Shrink</h1>
                <p>This is a simple URL shortening service that helps you generate shorter, more
                    manageablelinks.
                    With our service, you can easily convert long URLs into shorter ones that are easier
                    toshare,remember, and use. Get started now and simplify your links!</p>
                {{-- <a href="{{route('dashboard')}}" class="try-free">Try For Free</a> --}}
            </div>
            <div class="right-item">
                <img src="{{ asset('frontend/images/man.png') }}" alt="">
            </div>
        </div>
    </main>

    
    <footer>
        <p class="pt-3">© All Right Reserved By Shariya Shuvo, 2023</p>
    </footer>

   

 
</body>

</html>
