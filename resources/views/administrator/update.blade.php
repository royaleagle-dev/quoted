@extends('layouts.default')

@section('content')

<div class="mt-[10vh] md:mt-[10%]">
    <div class="md:flex md:justify-center md:items-center">
        <div class="md:w-1/2 md:flex md:justify-center">
            <div class="bg-green-400 w-96 py-12 px-8">
                <form method="POST" action = "{{ url('mg/update') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-black">Quote Author</label>
                        <input id="email" name="quote_author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ $quote->quote_author }}">
                    </div>  
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-black">Quote Text</label>
                        <textarea id="message" name="quote_text" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>{{ $quote->quote_text }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label for="Quote Category" class="block mb-2 text-sm font-medium dark:text-white text-black">Quote Category</label>
                        <select id="countries" name="quote_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="1">United States</option>
                            <option value="2">Canada</option>
                            <option value="3">France</option>
                            <option value="4">Germany</option>
                        </select>
                    </div>
                    <input type="hidden" value="{{ $quote->id }}" name="quote_id">
                    <button type="submit" class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width:100%;">Update Quote</button>
                </form>
            </div>
        </div>        
        <div class="md:w-1/2 px-12 py-6">
            <p class="text-2xl mb-2">{{ $quote->quote_text }}</p>
            <p><strong>{{ $quote->quote_author }}</strong></p>
        </div>
    </div>
</div>

@stop