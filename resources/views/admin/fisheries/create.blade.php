<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    @foreach ($errors->all() as $error)
                    <p> {{$error}}</p>
                    @endforeach

                    <form action="{{ route('admin.fisheries.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <x-input name="first_name" rows="10" placeholder="Start typing" class="w-full mt-6"></x-input>
                        @error('first_name')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-input name="last_name" rows="10" placeholder="Start typing" class="w-full mt-6"></x-input>
                        @error('last_name')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-textarea name="certification" rows="10" placeholder="Start typing" class="w-full mt-6"></x-textarea>
                        @error('certification')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-file-input type="file" name="photo" placeholder="Fish" class="w-full mt-6" field="image"></x-file-input>

                        <x-input type="number" name="salary" placeholder="yearly salary" class="w-full" autocomplete="off"></x-input>
                        @error('salary')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label for="fish"> <strong> Fishes</strong> <br> </label>
                            @foreach ($fishes as $fish)
                            <input type="checkbox", value="{{$fish->id}}" name="fish[]">
                            {{$fish->name}}

                            @endforeach
                        </div>

                        <button class="my-6"> Save Fishery</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
