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
    <div id="mobile-menu-section" class="hidden text-center">
        <div class="mt-20">
            <ul class="text-black">
                <li class="p-5 bg-green-500 hover:bg-green-700"><a href="{{ url('/') }}">Home</a></li>
                <li class="p-5 bg-green-500 hover:bg-green-700"><a href="{{ url('/quotes') }}">Quotes</a></li>
                <li class="p-5 bg-green-500 hover:bg-green-700"><a href="{{ url('/categories') }}">Categories</a></li>
                <li class="p-5 bg-green-500 hover:bg-green-700">
                    <a href="javascript:void(0)" onclick = "toggle_dropdown('dropdown-nav-mobile')" class="hover:bg-green-700 bg-green-500 text-white p-1 rounded-md px-3 py-2">@if( Auth::check() ) {{ Auth::user()->name }} @else Account @endif  &nbsp;<span class="fas fa-chevron-down"></span></a>
                    <div class="dropdown-items mt-5" id="dropdown-nav-mobile">
                        <a href="" class="p-5 hover:bg-green-700 p-1 px-10 hover:text-white text-green-500">Preferences</a>
                        <a href="{{ url('/logout') }}" class="p-5 hover:bg-green-700 p-1 px-10 hover:text-white">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- App Navigation -->
    <div class="flex items-center justify-around text-white px-3 py-2 fixed top-0 left-0 gradient-1 w-full">
        <h3><a href="">Quoted</a></h3>
        <div class="md:hidden" id="mobile-menu">
            <span class="fas fa-bars" id="mobile-menu-icon"></span>
            <span class="fas fa-times" id="mobile-menu-cancel" style="display:none;"></span>
        </div>
        <div class="hidden md:flex md:items-center">
            <a href="{{ url('/') }}" class="px-3 py-2 hover:bg-green-700 rounded-md">Home</a>
            <a href="{{ url('/quotes') }}" class="px-3 py-2 hover:bg-green-700 rounded-md">Quotes</a>
            <a href="{{ url('/categories') }}" class="px-3 py-2 hover:bg-green-700 rounded-md">Categories</a>
            <div class="btn-dropdown">
                @auth
                <a href="javascript:void(0)" onclick = "toggle_dropdown('dropdown-nav')" class="hover:bg-green-700 bg-green-500 text-white p-1 rounded-md px-3 py-2">@if( Auth::check() ) {{ Auth::user()->name }} @else Account @endif  &nbsp;<span class="fas fa-chevron-down"></span></a>
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
            <!--
            -->

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
                if(status === true){
                    console.log('dropdown hidden');
                    element.style.display = 'none';
                    status = false;
                }else{
                    status = true;
                    element.style.display = 'block';
                    console.log('dropdown displayed')
                    console.log(status);                
                }
            }
        }) 
    }
    </script>

    <script>
        const menuBtn = document.querySelector("#mobile-menu-icon");
        const cancelBtn = document.querySelector("#mobile-menu-cancel");

        const openMobileMenu =  () => {
            document.querySelector("#mobile-menu-section").style.display = 'block';
            cancelBtn.style.display = 'block';
            menuBtn.style.display = 'none';
        }


        const closeMobileMenu = () => {
            document.querySelector("#mobile-menu-section").style.display = 'none';
            cancelBtn.style.display = 'none';
            menuBtn.style.display = 'block';
        }

        menuBtn.addEventListener('click', openMobileMenu);
        cancelBtn.addEventListener('click', closeMobileMenu);

    </script>

    @yield('javascript')
</body>
</html>