<!DOCTYPE html>
<html lang="en">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-landing-page.assets-and-meta :title="$title"/>

    @livewireStyles
</head>

<body>
    <div id="main-wrapper" style="min-height: 77.5vh">
        {{ $slot }}
    </div>



    {{-- ========== FOOTER START ========== --}}
    <x-footer/>
    {{-- ========== FOOTER END ========== --}}



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-landing-page.javascript />

    @livewireScripts

    @stack('additional-script')
</body>

</html>