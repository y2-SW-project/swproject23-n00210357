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
                    Purchase fish based on by angler or look look at the resent fish
                </h4>
                <div class="col-sm-0 col-lg-4"></div>

                <div class="col-lg-1"></div>

                <div class="col-lg-3">
                    <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')" class="text-decoration-none">
                        <button class="dropbtn colours-bg border-radius my-2 px-xs-2 px-sm-2 px-lg-5">
                            <h2 class="size2 px-xs-2 px-lg-5">Fish</h2>
                        </button>
                    </x-nav-link>
                </div>

                <div class="col-lg-4"></div>

                <div class="col-lg-3">
                    <x-nav-link :href="route('home.fishery.index')" :active="request()->routeIs('home.fishery.index')" class="text-decoration-none">
                        <button class="dropbtn colours-bg border-radius my-2 px-xs-2 px-sm-2 px-lg-5">
                            <h2 class="size2 px-xs-2 px-sm-2 px-lg-5">Fisheries</h2>
                        </button>
                    </x-nav-link>
                </div>

                <div class="col-lg-1"></div>
            </div>

            <div class="row">
                @forelse ($anglers as $angler)
                <div class="col-sm-12 col-lg-4">
                    <div class="border border-4 card m-5 p-0" style="width: 390px">

                        <a href="{{ route('admin.anglers.show', $angler) }}" class="whitespace-pre-wrap text-center p-0 m-0">
                            <img src="{{asset('storage/images/users/' . $angler->photo)}}" width="382" height="150"/>
                        </a>

                        <div class="noWrap">
                            <h1>
                                {{$angler->name}}
                            </h1>

                            <h4 class="size4">
                                <span>{{$angler->email}} </span>
                            </h4>
                        </div>
                    </div>
                </div>
                @empty
                <p>Their are no angler right know</p>
                @endforelse

                <div class="row">
                    <div class="col-10"></div>

                    <div class="col-2">
                    {{$anglers->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
