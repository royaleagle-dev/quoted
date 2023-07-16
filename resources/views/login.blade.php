@extends('layouts.default')

@section('meta')
<link rel="stylesheet" href="/vendor/iziToast/dist/css/iziToast.min.css">
<script src = "/vendor/iziToast/dist/js/iziToast.min.js"></script>
@stop

@section('content')

<div class="mt-[10vh] md:mt-[10%]">
    <div class="md:flex md:justify-center md:items-center">
        <div class="md:w-1/2 md:flex md:justify-center">
            <div class="gradient-1 w-96 py-10 px-8">
                <h2 class="text-white text-2xl mb-4 text-center">Sign-In</h2>
                <form method="POST" id="loginForm">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-white">Email</label>
                        <input id="email" type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="mail@gmail.com" required>
                    </div>  
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium dark:text-white text-white">Password</label>
                        <input id="password" type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>  
                    <button type="submit" class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width:100%;">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('javascript')
<script>
    const form = document.querySelector("#loginForm")
    
    form.onsubmit = function(event){
        event.preventDefault(0);
        const data = {
            //continue from here;
            'email':document.querySelector("input[name='email']").value,
            'password':document.querySelector("input[name='password']").value,
            '_token': "{{ csrf_token() }}",
        }
        const submitData = fetch("{{ url('/login') }}", {
            method: "POST",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
            },
            body: JSON.stringify(data),
        }).then(response => {
            return response.json()
        }).then(json => {
            if(json.status === 'success'){
                iziToast.show({
                    title: 'Success',
                    message: json.message,
                });
                setTimeout(function(){
                    window.location = "{{ url('/') }}"
                }, 3500)
            }else if(json.status === 'error'){
                iziToast.show({
                    title: 'Error',
                    message: json.message,
                    backgroundColor: 'red',
                    titleColor: 'white',
                    messageColor: 'white',
                })
            }
        })
    }
    
</script>
@stop