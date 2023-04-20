<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                <!-- form to update the database -->
                    <form action="{{ route('admin.fisheries.update', $fishery)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="row mx-5">
                        <div class="col-8">
                            <div class="my-3 row">
                                <!-- input for the fisherys changed name -->
                                <div class="col-3 size4">
                                    <h4> Fishery name</h4>
                                </div>

                                <div class="col-2">
                                    <x-input type="text" name="location" placeholder="location" class="w-full" autocomplete="off" :value="@old('title', $fishery->location)"></x-input>
                                </div>
                            </div>

                            <div class="mt-3 row">
                                <!-- input for the fisheries changed dock master -->
                                <div class="col-3 size4">
                                    <h4> Dock Master</h4>
                                </div>

                                <div class="col-2">
                                    <x-input type="text" name="dock" placeholder="dock" class="w-full" autocomplete="off" :value="@old('title', $fishery->dock)"></x-input>
                                </div>
                            </div>

                            <div class="my-3 row">
                                <!-- input for the fisheries change photo -->
                                <div class="col-2">
                                    <h4> The fishery's photo</h4>
                                </div>

                                <div class="col-3">
                                    <x-file-input type="file" name="photo" placeholder="photo" class="w-full mt-6" field="image" value="{{@old('photo', $fishery->photo)}}"></x-file-input>
                                </div>
                            </div>

                        </div>

                        <div class="col-3"></div>
                        <div class="col-3 my-3">
                            <!-- button to confirm inputs -->
                        <button class="mx-5 my-6 dropbtn colours-bg border-radius"> Save Fishery</button>
                        </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
