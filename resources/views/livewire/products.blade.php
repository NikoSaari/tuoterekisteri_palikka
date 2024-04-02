<div>
    <div>
        @foreach ($products as $product)
            <x-container css="my-6 h-42 w-full max-w-5xl m-auto p-2 flex">
                <img src="/images/{{$product->image}}" class="w-32 h-32 object-cover">
                <div class="flex-grow flex flex-col mx-3">
                    <p class="font-bold text-xl">{{$product->name}}</p>
                    <p class="text-xl">{{number_format($product->price, 2, ",", " ")}} €</p>
                    <div class="flex-grow"></div>
                    @auth
                    <div class="flex flex-row" data-id="{{$product->id}}" data-name="{{$product->name}}">
                        <x-button css="mr-3" link="/edit_product/{{$product->id}}">Muokkaa</x-button>
                        <x-button css="delete">Poista</x-button>
                    </div>
                    @endauth
                </div>
            </x-container>
        @endforeach
    </div>
    
    {{$products->links("vendor.livewire.bootstrap")}}
    
    <form method="POST" action="/delete_product" id="delete_product_form">
        @csrf
        <input type="hidden" name="product" id="delete_product_id">
    </form>
    <script>
        const deleteForm = document.querySelector("#delete_product_form");
        const deleteId = document.querySelector("#delete_product_id");

        document.querySelectorAll(".delete").forEach((deleteBtn) => {
            const dataset = deleteBtn.parentElement.dataset;
            deleteBtn.addEventListener("click", function() {
                if (confirm("Oletko varma, että haluat poistaa tuotteen "+dataset.name+"? Toimintoa ei voi peruuttaa!")) {
                    deleteId.value = dataset.id;
                    deleteForm.submit();
                }
            });
        });
    </script>
</div>
