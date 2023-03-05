@extends('home')

@section('titulo')
    {{ $titulo }}
@endsection

@section('conteudo')
    @livewire('cad-user')
@endsection
