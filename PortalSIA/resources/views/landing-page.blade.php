<!DOCTYPE html>
<html lang="en">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-landing-page.assets-and-meta />

    @livewireStyles
</head>

<body>
    {{ $slot }}



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-landing-page.javascript />

    @livewireScripts
</body>



</html>