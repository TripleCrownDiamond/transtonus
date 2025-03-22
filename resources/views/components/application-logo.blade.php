<!-- Logo  -->
<a href="{{ route('home', ['locale' => 'fr']) }}" class="flex items-center">
    @if (file_exists(public_path('img/white.png')))
        <img src="{{ asset('img/dark.png') }}" alt="Logo" class="w-[140px] h-auto">
    @else
        <h1 class="sitename text-2xl font-bold text-gray-800">{{ config('app.name', 'Transtonus') }}</h1>
    @endif
</a>
