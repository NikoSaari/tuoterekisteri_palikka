<x-layout>
    <x-topbar/>
    <x-container css="m-auto w-full max-w-xl my-6">
        <form method="POST" action="/add_product" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if($errors->any())
            <ul class="text-red-500 m-3 list-disc" type="circle">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            <x-label for="name">Tuotenimi</x-label>
            <x-input name="name" placeholder="Tuotteen nimi" css="w-full m-auto mb-3" value="{{old('name')}}"/>
            <x-label for="price">Hinta</x-label>
            <x-input name="price" placeholder="Tuotteen hinta" css="w-full m-auto mb-3" type="number" step="0.01" min="0" value="{{old('price')}}"/>
            <x-label for="image">Kuva</x-label>
            <input type="file" class="w-full m-auto mb-3" name="image" id="file" accept="image/*">
            <img class="m-auto w-32 h-32 object-cover my-3" id="image">
            <div class="flex flex-row items-center">
                <x-button type="submit" css="m-auto mt-3 relative">Lisää tuote</x-button>
            </div>
        </form>
    </x-container>
    <script>
        const image = document.querySelector("#image");
        const file = document.querySelector("#file");
        
        file.addEventListener("change", function(e) {
            image.src = URL.createObjectURL(e.target.files[0]);
        });

        image.addEventListener("load", function(e) {
            URL.revokeObjectURL(image.src);
        })
    </script>
</x-layout>