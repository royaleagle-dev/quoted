I am Logged in to view this page.

@if(auth()->check())

{{ auth()->user()->name }}

@endif