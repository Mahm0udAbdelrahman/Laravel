<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 p-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="w-full m-2 p-2">
                    <a href="{{ route('album.create') }}" class="btn-success  text-white p-2  m-2 font-semibold rounded-lg">Create</a>

                </div>
                <table class="min-w-full divide-y divide-gray-200 mt-6">
                  <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Id</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Title</th>
                      {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Status</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Image</th> --}}
                      {{-- <th scope="col" class="relative px-6 py-3">Edit</th> --}}
                      <th scope="col" class="relative px-6 py-3">Manage</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($albums as $album )

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->index+1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a class="text-blue-400 font-semibold hover:text-blue-800"  href=" {{route('album.show' ,$album->id) }}">

                                {{ $album->title }}
                            </a>
                        </td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap">Active</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200" />
                        </td> --}}
                        {{-- <td class="px-6 py-4 text-right text-sm">Edit Delete</td> --}}
                        <td class="px-6 py-4 text-right text-sm">
                            <div class="flex justify-around">
                            <a href="{{ route('album.edit' ,$album->id) }}" class="btn btn-success m-2 ">Edit</a>
                            <form method="POST" action="{{ route('album.destroy' , $album->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="if(!confirm('Are you sure ?')){return false}" class="btn btn-danger m-2">Delete</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                    <!-- More items... -->
                  </tbody>
                </table>
                <div class="m-2 p-2">Pagination</div>
              </div>
            </div>
          </div>


    </div>



</x-app-layout>
