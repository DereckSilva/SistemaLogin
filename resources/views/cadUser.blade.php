@extends('home')

@section('link')
    <link rel="icon" href="{{Vite::asset('resources/images/senha.png')}}">
@endsection

@section('titulo')
    {{ $titulo }}
@endsection

@section('conteudo')
    @livewire('cad-user', ['message' => session('message'), 'error' => session('error')])
@endsection
