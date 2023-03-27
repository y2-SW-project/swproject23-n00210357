<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    @foreach ($errors->all() as $error)
                    <p> {{$error}}</p>
                    @endforeach

                    <form action="{{ route('admin.fisheries.store')}}" method="post" enctype="multipart/form-data" class="row mx-5">
                        @csrf

                        <x-input type="text" name="location" placeholder="Input the type of fish" class="w-full col-sm-12 my-3" autocomplete="off"></x-input>
                        @error('location')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-textarea name="dock" rows="10" placeholder="Description" class="w-full my-3 col-sm-12"></x-textarea>
                        @error('dock')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-file-input type="file" name="photo" placeholder="Fish" class="w-full mx-5 my-3" field="photo"></x-file-input>

                        <button class="mx-5 my-3 col-sm-12 border border-3 colours-bg"> Save Fish</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
