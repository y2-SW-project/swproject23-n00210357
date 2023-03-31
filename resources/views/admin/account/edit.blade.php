<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    <form action="{{ route('admin.fishs.update', $fishery)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <x-input type="text" name="location" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $fishery->location)"></x-input>

                        <x-textarea name="dock" rows="10" placeholder="Start typing" class="w-full mt-6" value="{{@old('dock', $fishery->dock)}}"></x-textarea>

                        <x-file-input type="file" name="photo" placeholder="Fish" class="w-full mt-6" field="photo" value="{{@old('photo', $fishery->photo)}}"></x-file-input>

                        <button class="my-6"> Save Fish</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
