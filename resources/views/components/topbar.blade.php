<nav class="w-full bg-white shadow h-16 flex flex-row">
    <x-topbar-btn link="/">Tuotteet</x-topbar-btn>
    @auth
        <x-topbar-btn link="/add_product">Lisää tuote</x-topbar-btn>
    @endauth
    <div class="flex-grow"></div>
    @auth
        <x-topbar-btn action="/logout">Kirjaudu ulos</x-topbar-btn>
    @endauth
    @guest
        <x-topbar-btn link="/login">Kirjaudu sisään</x-topbar-btn>
    @endguest
</nav>