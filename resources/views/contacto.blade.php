{{-- resources/views/pages/home.blade.php --}}
@extends('pages.base')

@section('title', 'Página Inicial')

@section('content')
    <div class="w-full min-h-screen">
        <livewire:contacto />
    </div>
@endsection