<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=No">
    <link rel="stylesheet" href="/tail-output.css">
    <link rel="stylesheet" href="/vendor/fontAwesome5/css/all.min.css">
    
    <link rel="stylesheet" href="/styles.css">
    <title>Quoted</title>
    @yield('meta')
</head>
<body>
    <!-- App Navigation -->
    <div class="flex items-center justify-around text-white px-3 py-2 fixed top-0 left-0 gradient-1 w-full">
        <h3><a href="">Quoted</a></h3>
        <div class="md:hidden">
            <span class="fas fa-bars"></span>
        </div>
        <div class="hidden md:flex md:items-center">
            <a href="{{ url('/') }}" class="px-3 py-2 hover:bg-green-700 rounded-md">Home</a>
            <a href="{{ url('/quotes') }}" class="px-3 py-2 hover:bg-green-700 rounded-md">Quotes</a>
            <a href="{{ url('/categories') }}" class="px-3 py-2 hover:bg-green-700 rounded-md">Categories</a>
            <div class="btn-dropdown">
                @auth
                <a href="javascript:void(0)" onclick = "toggle_dropdown('dropdown-nav')" class="hover:bg-green-700 bg-green-500 text-white p-1 rounded-md px-3 py-2">@if( Auth::check() ) {{ Auth::user()->name }} @else Not Authenticated @endif  &nbsp;<span class="fas fa-chevron-down"></span></a>
                <div class="dropdown-items mt-2 text-black" id="dropdown-nav">
                    <a href="" class="hover:bg-green-700 p-1 px-10 hover:text-white">Preferences</a>
                    <a href="{{ url('/logout') }}" class="hover:bg-green-700 p-1 px-10 hover:text-white">Logout</a>
                </div>
                @endauth

                @if(!Auth::check())
                <a href="javascript:void(0)" onclick = "toggle_dropdown('dropdown-nav')" class="hover:bg-green-700 bg-green-500 text-white p-1 rounded-md px-3 py-2">Account &nbsp;<span class="fas fa-chevron-down"></span></a>
                <div class="dropdown-items mt-2 text-black" id="dropdown-nav">
                    <a href="{{ url('/login') }}" class="hover:bg-green-700 p-1 px-3 hover:text-white">Login</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End of App Navigation -->
    
    <!-- App Content -->
    <div class="mt-10">
        @yield('content')
    </div>
    <!-- End of App Content -->

    <script>
    const dropdown = document.querySelectorAll(".dropdown-items");
    dropdown.forEach(element => {
        element.style.display = 'none';
    })
    let status = false;
    const toggle_dropdown = (elemId) => {
        let dropdown = document.querySelectorAll(".dropdown-items");
        dropdown.forEach(element => {
            element.style.display = 'none';
            if(element.id == elemId){
                if(status == true){
                    element.style.display = 'none';
                    status = false;
                }else{
                    element.style.display = 'block';
                    status = true;                
                }
            }
        }) 
    }
    </script>

    @yield('javascript')
</body>
</html>