<x-layout>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <x-container css="m-auto w-full max-w-xl">
            <form action="/login" method="POST">
                @csrf
                @if($errors->any())
                <ul class="text-red-500 m-3 list-disc" type="circle">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                <x-label for="email">Sähköpostiosoite</x-label>
                <x-input css="w-full m-auto mb-3" name="email" placeholder="Sähköpostiosoite" type="email" value="{{old('email')}}"/>
                <x-label css="mt-3" for="email">Salasana</x-label>
                <x-input css="w-full m-auto" type="password" name="password" placeholder="Salasana"/>
                <div class="flex flex-row items-center">
                    <x-button type="submit" css="m-auto mt-3 relative">Kirjaudu sisään</x-button>
                </div>
            </form>
        </x-container>
    </div>
</x-layout>