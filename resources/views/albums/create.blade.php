<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="container mx-auto m-4 p-4 bg-white shadow-md rounded-lg">
        <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
            <form method="POST" action="{{ route('album.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="sm:col-span-6">
                <label for="title" class="block text-sm font-medium text-gray-700"> Post Title </label>
                <div class="mt-1">
                  <input type="text" id="title" value="{{ old('title') }}"  name="title" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
              </div>
              <div class="sm:col-span-6 pt-5">
                <button class="btn btn-success" > Create</button>


              </div>
            </form>
          </div>


    </div>








</x-app-layout>
