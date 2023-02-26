<head>
    @vite('resources/images/')
    @vite('resources/css/app.css')
    @livewireStyles

</head>

<body>

    {{ $slot }}


    @livewireScripts


</body>
