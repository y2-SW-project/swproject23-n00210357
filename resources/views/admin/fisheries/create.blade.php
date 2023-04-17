<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    @foreach ($errors->all() as $error)
                    <p> {{$error}}</p>
                    @endforeach

                    <form action="{{ route('admin.fisheries.store')}}" method="post" enctype="multipart/form-data" class="row mx-5">
                        @csrf

                        <div class="row mx-5">
                            <div class="col-8">
                                <div class="my-3 row">
                                    <div class="col-3 size4">
                                        <h4> Fishery name</h4>
                                    </div>

                                    <div class="col-9">
                                        <x-input type="text" name="location" placeholder="Input the type of fish" class="w-full col-sm-12" autocomplete="off"></x-input>
                                        @error('location')
                                        <div class="text-red-600 text-sm">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3 row">
                                    <div class="col-3 size4">
                                        <h4> Dock Master</h4>
                                    </div>

                                    <div class="col-9">
                                        <x-input type="text" name="dock" placeholder="Input the type of fish" class="w-full col-sm-12" autocomplete="off"></x-input>
                                        @error('dock')
                                        <div class="text-red-600 text-sm">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="my-3 row">
                                    <div class="col-3">
                                        <h4> The fishery's photo</h4>
                                    </div>

                                    <div class="col-9">
                                        <x-file-input type="file" name="photo" placeholder="Fish" class="w-full mx-5" field="photo"></x-file-input>
                                    </div>
                                </div>

                        <button class="my-3 col-sm-4 border border-3 colours-bg"> Save Fishery</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
