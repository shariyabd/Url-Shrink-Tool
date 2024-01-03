@include('backend.includes.head')
<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
           @include('backend.includes.sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('backend.includes.header')
                <!-- main header @e -->
                <!-- content @s -->
               @yield('content')
                <!-- content @e -->
                <!-- footer @s -->
              @include('backend.includes.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
@include('backend.includes.script')