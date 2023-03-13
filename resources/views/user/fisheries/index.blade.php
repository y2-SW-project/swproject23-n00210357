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
                    Search for fish by directly looking fish or by looking at anglers
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

                @forelse ($fisheries as $fishery)
                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg flex">
                    <div>
                    <p class="whitespace-pre-wrap">
                        <img src="{{asset('storage/images/fishery/' . $fishery->photo)}}" width="200"/>
                    </p>
                    </div>

                    <div>
                    <h2>
                        <a href="{{ route('user.fisheries.show', $fishery) }}"> {{$fishery->first_name}}</a>
                    </h2>

                    <p class="mt-2">
                        {{Str::limit($fishery->certification), 200}}
                    </p>

                    <p class="mt-2">
                        Owned by {{$fishery->user->name}}
                    </p>

                    </div>

                    <span class="block mt-4 text-sm opacity-70"> {{$fishery->updated_at->diffForHumans()}}</span>
                </div>
                @empty
                <p>You have no fisheries</p>
                @endforelse
                {{$fisheries->links()}}
            </div>
        </div>
</x-app-layout>
