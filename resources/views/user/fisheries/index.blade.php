<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="header row">
                <div class="col-sm-0 col-lg-1"></div>
                <!-- header -->
                <h1 class="size1 col-lg-4">
                    Fisheries that are currently in use Store
                </h1>

                <div class="col-sm-0 col-lg-2"></div>
                <div class="col-sm-10 col-lg-4 text-center">
                </div>
                <div class="col-sm-0 col-lg-1"></div>
            </div>

            <!-- displays on creating a new fishery -->
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class="row align-items-center">
                @forelse ($fisheries as $fishery)
                <div class="col-sm-12 col-lg-4">
                    <div class="border border-4 card m-5 p-0" style="width: 390px">
                        
                        <!-- displays fisheries photo and functions as the link to its show page -->
                        <a href="{{ route('user.fisheries.show', $fishery) }}" class="whitespace-pre-wrap text-center p-0 m-0">
                            <img src="{{asset('storage/images/fisheries/' . $fishery->photo)}}" width="382" height="150"/>
                        </a>

                        <div class="noWrap">

                            <?php
                        //    <h5 class="size5">
                        //         Caught by <span class="size6">{{$fishery->user->name}}</span>
                        //    </h5>
                            ?>

                            <h1>
                                {{$fishery->fishType}}
                            </h1>

                            <!-- displays the locations -->
                            <h4 class="size4">
                                <span>{{$fishery->location}} </span> fishery
                            </h4>

                            <!-- displays the dockmasters -->
                            <h5 class="size5">
                                Dock master <span class="size6">{{$fishery->dock}}</span>
                            </h5>

                        </div>
                    </div>
                </div>
                @empty
                <p>Their are no fishery on the market</p>
                @endforelse

                <div class="row">
                    <div class="col-10"></div>

                    <div class="col-2">
                    {{$fisheries->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
