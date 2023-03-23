<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    <form action="{{ route('admin.fishs.update', $fish)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <x-input type="text" name="name" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $fish->name)"></x-input>

                        <x-textarea name="description" rows="10" placeholder="Start typing" class="w-full mt-6" value="{{@old('description', $fish->description)}}"></x-textarea>

                        <x-file-input type="file" name="image" placeholder="Fish" class="w-full mt-6" field="image" value="{{@old('image', $fish->image)}}"></x-file-input>

                        <x-input type="number" name="price" placeholder="price" class="w-full" autocomplete="off" :value="@old('price', $fish->price)"></x-input>

                        <select name="fisheries">
                        @foreach($fisheries as $fishery)
                        <option value="{{$fishery->id}}" {{(old('fisheries_id') == $fishery->id) ? "selected" : ""}}>
                            {{$fishery->location}}
                        </option>
                        @endforeach
                        </select>

                        <button class="my-6"> Save Fish</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
