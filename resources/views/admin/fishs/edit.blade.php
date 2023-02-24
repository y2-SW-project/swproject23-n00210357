<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    <form action="{{ route('admin.fishs.update', $fish)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <x-input type="text" name="name" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $fish->name)"></x-input>

                        <x-textarea name="cargo" rows="10" placeholder="Start typing" class="w-full mt-6" value="{{@old('cargo', $fish->cargo)}}"></x-textarea>

                        <x-file-input type="file" name="image" placeholder="Fish" class="w-full mt-6" field="image" value="{{@old('image', $fish->image)}}"></x-file-input>

                        <x-input type="number" name="cost" placeholder="price" class="w-full" autocomplete="off" :value="@old('cost', $fish->cost)"></x-input>

                        <label for="basket">Basket</label>
                        <select name="basket_id">
                        @foreach($basket as $basket)
                        <option value="{{$basket->id}}" {{(old('basket_id') == $basket->id) ? "selected" : ""}}>
                            {{$basket->location}}
                        </option>
                        @endforeach
                        </select>

                        <button class="my-6"> Save Fish</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
