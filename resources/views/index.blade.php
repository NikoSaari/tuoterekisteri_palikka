<x-layout>
    <x-topbar/>
    @if($errors->any() || session("success"))
    <x-container css="my-6 w-full max-w-5xl m-auto p-2">
        <ul class="list-disc" type="circle">
            @if(session("success"))
                <li class="text-green-500">{{session("success")}}</li>
            @endif
            @foreach($errors->all() as $error)
                <li class="text-red-500">{{$error}}</li>
            @endforeach
        </ul>
    </x-container>
    @endif
    <livewire:products/>
</x-layout>