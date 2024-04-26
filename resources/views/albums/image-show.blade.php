<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

    <div class="container mx-auto m-2 p-2 bg-white shadow-md rounded-lg">
        <div class="m-2 p-2">
            <img src="{{ $image->getUrl() }}">
        </div>
        <div class="m-2 p-2">
            <ul>
                <li>Collection_name:{{ $image->collection_name  }}</li>
                <li>name: {{ $image->name }}</li>
                <li>Mime type:{{ $image->mime_type }}</li>
                <li>Size:{{ $image->human_readable_size }}</li>
            </ul>
        </div>


    </div>




</x-app-layout>
