<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="row text-center py-3">
                <h4 class="size-4 col-3">
                    <strong>Created: </strong> {{$fish->created_at->diffForHumans()}}
                </h3>

                <h4 class="size-4 ml-8 col-3">
                    <strong>Updated at: </strong> {{$fish->updated_at->diffForHumans()}}
                </h3>
            </div>

            <table>
                <tbody>
                    <div class="row p-5">
                        <h2 class="col-12 text-center">
                            The Fish is {{$fish->fishType}}
                        </h2>

                        <div class="col-6">
                            <p>
                                <img src="{{asset('storage/images/fish/' . $fish->image)}}" width="380"/>
                            </p>
                        </div>

                        <div class="col-6">
                            <p>
                                {{$fish->description}}
                            </p>

                            <p>
                                The price of this fish is €{{$fish->price}}
                            </p>
                        </div>

                        <div class="col-6">
                            <div>
                                <img src="{{asset('storage/images/fisheries/' . $fish->fishery->photo)}}" width="380"/>
                             </div>
                        </div>

                        <div class="col-6">
                            <p>
                                Fishery is {{$fish->fishery->location}}
                            </p>

                            <p>
                                Its dock is {{$fish->fishery->dock}}
                            </p>

                            <x-nav-link :href="route('admin.fishs.add', $fish)" :active="request()->routeIs('admin.fishs.add', $fish)" class="text-decoration-none col-3">
                                <button class="dropbtn colours-bg border-radius">
                                    <h4 class="size4">Add to basket</h4>
                                </button>
                            </x-nav-link>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>