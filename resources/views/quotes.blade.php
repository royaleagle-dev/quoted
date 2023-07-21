@extends('layouts.default')

@section('meta')
<link rel="stylesheet" href="/vendor/iziToast/dist/css/iziToast.min.css">
<script src = "/vendor/iziToast/dist/js/iziToast.min.js"></script>
@stop

@section('content')

<div class="modal-backdrop px-5">
    <div class="modal md:w-[40%] sm:w-full">
        <div class="gradient-1 py-12 px-8">
                <h4 class="mb-6 text-2xl text-white">Confirmation</h4>
                    <div class="mb-6">
                        <h3 class="text-white">Do you really want to delete this quote?</h3>
                    </div>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width:45%;" id="proceedDelete">Yes</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width:45%;" id="cancelDelete">No</button>
            </div>
    </div>
</div>

<div class="mt-[7%]">
    <div class="md:flex md:justify-between md:items-center w-full" style="gap:20px;align-items:flex-start;">
        <div class="md:w-1/3">
            <div class="gradient-1 sm:w-[100%] md:w-96 py-12 px-8" style="margin:0 auto;">
                <h4 class="mb-6 text-2xl text-white">Filters</h4>
                    <div class="mb-6">
                        @csrf
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-white">Sort By Date</label>
                        <select id="date_sort" name="quote_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="DATE_ASC">Ascending</option>
                            <option value="DATE_DSC">Descending</option>
                            <option value="DATE_N">None</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-white">Sort By Author</label>
                        <select id="author_sort" name="quote_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="AUTHOR_ASC">Ascending</option>
                            <option value="AUTHOR_DSC">Descending</option>
                            <option value="AUTHOR_N">None</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-white">Sort By Quote Text</label>
                        <select id="text_sort" name="quote_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="TEXT_ASC">Ascending</option>
                            <option value="TEXT_DSC">Descending</option>
                            <option value="TEXT_N">None</option>
                        </select>
                    </div>
                    <button type="submit" class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width:100%;" id="filterBtn">Apply Filter</button>
            </div>
        </div>
        <div class="md:w-2/3 md:pr-20 px-3">
            <div class="search mt-5">
                <form>
                    <div class="mb-6 w-[100%] px-4">
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-white"></label>
                        <input id="search" name="search" type="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Here..." required>
                    </div>
                </form>
            </div>
            @if(!$quotes->isEmpty())
            @foreach($quotes as $quote)
            <div class="bg-gray-100 py-5 px-4 mb-4 w-[100%]" id="container-{{ $quote->id }}" style="transition: all 2s ease-out;">
                <div class="md:flex justify-between items-center mb-3">
                    <p class="mb-3">{{ $quote->quote_text }}</p>
                    <div class="btn-dropdown">
                        <a href="javascript:void(0)" onclick = "toggle_dropdown('dropdown-{{ $quote->id }}')" class="bg-green-500 text-white text-sm p-1 rounded-md px-3 py-2">Actions &nbsp;<span class="fas fa-chevron-down"></span></a>
                        <div class="dropdown-items mt-2" id="dropdown-{{ $quote->id }}">
                            <a href="{{ route('get_update', ['id' => $quote->id] ) }}" class="hover:bg-green-700 p-1 px-3 hover:text-white">Edit</a>
                            <a href="javascript:void(0)" class="hover:bg-green-700 p-1 px-3 hover:text-white" onclick = "confirmDelete('{{ $quote->id }}', 'container-{{ $quote->id }}')">Delete</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="flex justify-between items-center text-sm py-3 px-3">
                    <strong class="text-green-700">{{ $quote->quote_author }}</strong>
                    <p class="text-green-700">Submitted: {{ $quote->created_at }}</p>
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
    const confirmDelete = (recordId, containerId) => {
        document.querySelector(".modal-backdrop").style.display='block';
        const delete_record = () => {
            const delete_url = `{{ url('/mg/remove/') }}`;
            const fetch_url = fetch(delete_url, {
                method: 'POST',
                body: JSON.stringify({
                    "id": recordId,
                    "_token": "{{ csrf_token() }}"
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
        const cancel_delete = () => {
            const x = document.querySelector(".modal-backdrop").style.display='none';
        }
        const proceedDelete = document.querySelector("#proceedDelete");
        const cancelDelete = document.querySelector("#cancelDelete");
        proceedDelete.addEventListener('click', delete_record);
        cancelDelete.addEventListener('click', cancel_delete);
    }
</script>
<script>
    const filterBtn = document.querySelector("#filterBtn");
    const filter = () => {
        const date_sort = document.querySelector("#date_sort").value;
        const author_sort = document.querySelector("#author_sort").value;
        const text_sort = document.querySelector("#text_sort").value;
        const location = "{{ url('/filter') }}" + `?date_sort=${date_sort}&author_sort=${author_sort}&text_sort=${text_sort}`;
        window.location = location;
    }
    filterBtn.addEventListener('click', filter);
</script>

@stop
