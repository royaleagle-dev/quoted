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
            <!--
            <div class=" mt-3 mb-3 search flex justify-between items-center">
                <form>
                    <div class="">
                        <input id="search" name="search" type="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Here..." required>
                    </div>
                </form>
                @auth
                <div class="p-3 bg-green-500 text-white py-2 rounded-md">
                    <a href="javascript:void(0)" onclick = "addCategory()"><span class="fas fa-plus"></span></a>
                </div>
                @endauth
            </div>
            -->
            <div class="mb-4 mt-5">
                <h4 class="text-center text-xl text-green-500">Quotes in <span class="text-green-700">{{ $category }}</span> category</h4>
            </div>
            @foreach($quotes as $quote)
            <div class="bg-gray-100 py-5 px-4 mb-4" style="transition: all 2s ease-out;">
                <div class="">
                    <p class=""><a>{{ $quote->quote_text }}</a></p>
                    <strong class="text-sm mb-2 mt-2">{{ $quote->quote_author }}</strong>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@stop