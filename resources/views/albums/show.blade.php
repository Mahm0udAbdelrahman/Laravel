<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet">

@endsection
    <div class="container mx-auto m-2 p-2 bg-white shadow-md rounded-lg">

        <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
            <form method="POST" class="dropzone" id="my-dropzone" action="{{ route('ablums.upload', $album->id) }}" enctype="multipart/form-data">
                @csrf
              <div class="sm:col-span-6">
                <label for="title" class="block text-sm font-medium text-gray-700"> Image </label>
                <div class="mt-1">
                  <input type="file" id="imageUpload" multiple  id="my-dropzone"  name="image[]" class="  block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 dropzone" />


                </div>
              </div>
              <button class="btn btn-success m-2">Upload</button>

            </form>
          </div>
          <div class="mt-4">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2  md:grid-4">
                @foreach ($photos as $photo)
                <div class="bg-gray-300 p-2">
                  <a class="block relative h-56 rounded overflow-hidden">
                     <img
                     alt="gallery"
                     class="object-cover object-center w-full h-full block"
                     src="{{ $photo->getUrl() }}">
                   </a>
                   <div class="flex justify-between mt-4 p-4">
                   <a class="m-2 p-2 bg-blue-500 hover:bg-blue-700 rounded-lg" href="{{ route('album.image.show', [$album->id, $photo->id]) }}">Full image</a>
                   <form method="POST" action="{{ route('album.image.destroy', [$album->id, $photo->id]) }}">
                     @csrf
                     @method('DELETE')
                     <button class="m-2 p-2 rounded-lg bg-red-500 hover:bg-red-700">Delete</button>
                   </form>
                 </div>
                 </div>
                @endforeach

            </div>
          </div>

    </div>
    

@section('script')

    <script>
        Dropzone.options.imageUpload ={
            accepredFiles: ".xlsx, .xlsm , .xlsb, .xltx, , .xltm, .xls, .xlt , .xml ";
            success:function(file,response){
                swal({ title: "Success!" , text: "Import added successfully" , type:"success" , timer:3000 })
            },
        };
    </script>
@endsection



</x-app-layout>
