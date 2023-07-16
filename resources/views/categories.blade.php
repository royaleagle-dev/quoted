@extends('layouts.default')

@section('meta')
<link rel="stylesheet" href="/vendor/iziToast/dist/css/iziToast.min.css">
<script src = "/vendor/iziToast/dist/js/iziToast.min.js"></script>
@stop

@section('content')
<style>
            .dropdown-items a{
                display:block;
            }

            .dropdown-items{
                position:absolute;
                background:white;
                min-width: 7%;
                
            }
            .btn-dropdown{
                z-index:1;
            }
        </style>

<div class="modal-backdrop">
    <div class="modal">
        <div class="gradient-1 py-12 px-8">
                <h4 class="mb-6 text-2xl text-white">Add Category</h4>
                    <div class="mb-6">
                        <h3 class="text-white">Add a New Category -- <span class="text-sm">Super-Admin Access only<span></h3>
                    </div>
                    <div class="mb-6">
                    <div class="mb-6">
                        <label for="category" class="block mb-2 text-sm font-medium dark:text-white text-white">Category Name</label>
                        <input id="category-input" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Business" required>
                    </div>
                    <div class="mb-6">
                        <label for="category" class="block mb-2 text-sm font-medium dark:text-white text-white">Category Description</label>
                        <input id="description-input" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Descriptioin Here" required>
                    </div>  
                    </div>

                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width:49%;" id="proceedAddCategory">Add Category</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width:49%;" id="cancelAddCategory">Cancel</button>
            </div>
    </div>
</div>

<div class="mt-[5vh] md:mt-[5%]">
    <div class="md:flex md:justify-center md:items-center w-full" style="gap:20px;align-items:flex-start;">  
        <div class="w-full md:w-[40vw]">
            <div class="search">
                <form>
                    <div class="mb-6">
                        <label for="search" class="block mb-2 text-sm font-medium dark:text-white text-white"></label>
                        <input id="search" name="search" type="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Here..." required>
                    </div>
                </form>
            </div>
            <div class="mb-2 mt-2">
                <a href="javascript:void(0)" onclick = "addCategory()">Add Category</a>
            </div>
            @if(!$categories->isEmpty())
            @foreach($categories as $category)
            <div class="bg-gray-100 py-5 px-4 mb-4" id="container-{{ $category->id }}" style="transition: all 2s ease-out;">
                <div class="flex justify-between items-center mb-1">
                    <p class="">{{ $category->name }}</p>
                    <div class="">
                        <a style="cursor:not-allowed" href="javascript:void(0)" class="bg-green-900 text-white p-1 rounded-md px-3 py-2">Added {{ $category->created_at }}</a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-red-400">No Record Found, Please Refresh, Try a new search term or Add New Data</p>
            @endif
        </div>
    </div>
</div>

@stop

@section('javascript')
<script>
    const addCategory = () => { 
        document.querySelector(".modal-backdrop").style.display='block';

        const cancel_add_category = () => {
            document.querySelector(".modal-backdrop").style.display='none';
        }
        
        const proceed_add_category = () => {
            //proceed to add category here.
            categoryInput = document.querySelector("#category-input").value;
            if(categoryInput != false){
                const addCategory = fetch("{{ url('/categories/add') }}", {
                    method: 'POST',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                    },
                    body: JSON.stringify({
                        'category': categoryInput,
                        'description': document.querySelector("#description-input").value,
                        '_token': "{{ csrf_token() }}",
                    }),
                }).then(response => {
                    return response.json();
                }).then(json => {
                    switch(json.status){
                        case 'success':
                            iziToast.show({
                                title: 'Success',
                                message: json.message,
                            });
                            break;
                        case 'error':
                            iziToast.show({
                                title: 'Error',
                                message: json.message,
                                backgroundColor: 'red',
                                titleColor: 'white',
                                messageColor: 'white',
                            });
                            break;
                    }
                })
            }else{
                iziToast.show({
                    title: 'Error',
                    message: 'Category Field Must Not Be Empty',
                    backgroundColor: 'red',
                    titleColor: 'white',
                    messageColor: 'white',
                })
            }

            

        }

        //dom elements
        const cancelAddCategory = document.querySelector("#cancelAddCategory");
        const proceedAddCategory = document.querySelector("#proceedAddCategory");
        
        //event listeners
        cancelAddCategory.addEventListener('click', cancel_add_category);
        proceedAddCategory.addEventListener('click', proceed_add_category);
    }

    const confirmDelete = (recordId, containerId) => {
        const delete_record = () => {
            const delete_url = `{{ url('/mg/remove/') }}`;
            const fetch_url = fetch(delete_url, {
                method: 'POST',
                body: JSON.stringify({
                    "id": recordId,
                }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                }
            }).then(response => {
                return response.json()

            }).then(json => {
                if(json.status === 'success'){
                    document.querySelector(".modal-backdrop").style.display='none';
                    iziToast.show({
                        title: 'Success',
                        message: 'Operation Successfull',
                    });
                    document.getElementById(containerId).style.opacity='0.2';
                    document.getElementById(containerId).style.cursor='not-allowed';
                }
                console.log(json.status);
                console.log(json.record_id);
            })

        }
        
        //proceedDelete.addEventListener('click', delete_record);
    }
</script>
<script>
    /*
    if(window.location.search){
        console.log('search path present');
    }else{
        console.log('Normal Path detected');
    }
    */
</script>

@stop