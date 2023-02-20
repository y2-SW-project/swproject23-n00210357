<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fishs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    @foreach ($errors->all() as $error)
                    <p> {{$error}}</p>
                    @endforeach

                    <form action="{{ route('admin.fishs.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <x-input type="text" name="name" placeholder="Title" class="w-full" autocomplete="off"></x-input>
                        @error('name')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-textarea name="cargo" rows="10" placeholder="Start typing" class="w-full mt-6"></x-textarea>
                        @error('cargo')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-file-input type="file" name="image" placeholder="Fish" class="w-full mt-6" field="image"></x-file-input>

                        <x-input type="number" name="cost" placeholder="price" class="w-full" autocomplete="off"></x-input>
                        @error('cost')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <label for="basket">Basket</label>
                        <select name="basket_id">
                        @foreach($basket as $basket)
                        <option value="{{$basket->id}}" {{(old('basket_id') == $basket->id) ? "selected" : ""}}>
                            {{$basket->location}}
                        </option>
                        @endforeach
                        </select>

                        <div class="form-group">
                            <label for="fisheries"> <strong> Fisheries</strong> <br> </label>
                            @foreach ($fisheries as $fishery)
                            <input type="checkbox", value="{{$fishery->id}}" name="fisheries[]">
                            {{$fishery->first_name}}

                            @endforeach

                        </div>

                        <button class="my-6"> Save Fish</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
