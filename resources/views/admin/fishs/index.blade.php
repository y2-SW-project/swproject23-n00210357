<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="header row">
                <div class="col-sm-0 col-lg-5"></div>
                <h1 class="size1 col-lg-2">
                    Fish Store
                </h1>
                <div class="col-sm-0 col-lg-5"></div>

                <div class="col-sm-0 col-lg-4"></div>
                <h4 class="size4 col-lg-4">
                    Purchase fish based on location or by angler
                </h4>
                <div class="col-sm-0 col-lg-4"></div>

                <div class="col-lg-1"></div>

                <div class="col-lg-3">
                    <x-nav-link :href="route('home.fishery.index')" :active="request()->routeIs('home.fishery.index')" class="text-decoration-none">
                        <button class="dropbtn colours-bg border-radius my-2 px-xs-2 px-sm-2 px-lg-5">
                            <h2 class="size2 px-xs-2 px-lg-5">Fisheries</h2>
                        </button>
                    </x-nav-link>
                </div>

                <div class="col-lg-4"></div>

                <div class="col-lg-3">
                    <x-nav-link :href="route('home.basket.index')" :active="request()->routeIs('home.basket.index')" class="text-decoration-none">
                        <button class="dropbtn colours-bg border-radius my-2 px-xs-2 px-sm-2 px-lg-5">
                            <h2 class="size2 px-xs-2 px-sm-2 px-lg-5">Anglers</h2>
                        </button>
                    </x-nav-link>
                </div>

                <div class="col-lg-1"></div>
            </div>

            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class="row align-items-center">
                <div class="col-sm-1 col-lg-4"></div>
                    <div class="col-sm-10 col-lg-4 text-center">
                        <x-nav-link :href="route('admin.fishs.create')" :active="request()->routeIs('admin.fishs.create')" class="text-decoration-none">
                            <button class="dropbtn colours-bg border-radius my-2 px-xs-2 px-sm-2 px-lg-5">
                                <h2 class="size2 px-xs-2 px-lg-5">Add fish to market</h2>
                            </button>
                        </x-nav-link>
                    </div>
                <div class="col-sm-1 col-lg-4"></div>

                @forelse ($fishs as $fish)
                <div class="col-sm-12 col-lg-4">
                    <div class="border border-4 card m-5 p-0" style="width: 390px">

                        <a href="{{ route('admin.fishs.show', $fish) }}" class="whitespace-pre-wrap text-center p-0 m-0">
                            <img src="{{asset('storage/images/fish/' . $fish->image)}}" width="382" height="150"/>
                        </a>

                        <div class="noWrap">
                            <h5 class="size5">
                                Caught by <span class="size6">{{$fish->user->name}}</span>
                            </h5>

                            <h1>
                                {{$fish->fishType}}
                            </h1>

                            <h4 class="size4">
                                Caught at <span>{{$fish->fishery->location}} </span>
                            </h4>

                            <h5 class="size5">
                                Price €<span class="size6">{{$fish->price}}</span>
                            </h5>

                        </div>
                    </div>
                </div>
                @empty
                <p>Their are no fish on the market</p>
                @endforelse
                {{$fishs->links()}}

            </div>
        </div>
    </div>
</x-app-layout>
