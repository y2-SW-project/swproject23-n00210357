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

                <x-nav-link :href="route('admin.fishs.edit', $fish)" :active="request()->routeIs('admin.fishs.edit', $fish)" class="text-decoration-none col-3">
                    <button class="dropbtn colours-bg border-radius">
                        <h4 class="size4">Edit Fish</h4>
                    </button>
                </x-nav-link>

                <form action="{{ route('admin.fishs.destroy', $fish) }}" method="post" class="col-3 py-1">
                    @method('delete')
                    @csrf
                    <button class="dropbtn colours-bg border-radius" onclick="return confirm('Are you sure')">
                        <h4 class="size4">Delete Fish</h4>
                    </button>
                </form>
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
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
