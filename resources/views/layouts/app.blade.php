<x-main-layout>
    @include('layouts.sidebar')
    <div id="main">
        @include('layouts.navigation')
        <main>{{ $slot ?? '' }}</main>
        @include('layouts.footer')
    </div>
</x-main-layout>
