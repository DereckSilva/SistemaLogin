@extends('home')

@section('titulo')
    {{ $titulo  }}
@endsection

@section('conteudo')
    <body class='bg-gray-200 font-mono text-1xl font-bold align-middle'>

        @livewire('login', ['messagess' => session('sucesso'), 'error' => session('error')])

    </body>
@endsection
