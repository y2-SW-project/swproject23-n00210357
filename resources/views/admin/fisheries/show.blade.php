<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="row text-center py-3">
                <h4 class="size-4 col-3">
                    <strong>Created: </strong> {{$fishery->created_at->diffForHumans()}}
                </h3>

                <h4 class="size-4 ml-8 col-3">
                    <strong>Updated at: </strong> {{$fishery->updated_at->diffForHumans()}}
                </h3>

                <x-nav-link :href="route('admin.fisheries.edit', $fishery)" :active="request()->routeIs('admin.fisheries.edit', $fishery)" class="text-decoration-none col-3">
                    <button class="dropbtn colours-bg border-radius">
                        <h4 class="size4">Edit Fishery</h4>
                    </button>
                </x-nav-link>

                <form action="{{ route('admin.fisheries.destroy', $fishery) }}" method="post" class="col-3 py-1">
                    @method('delete')
                    @csrf
                    <button class="dropbtn colours-bg border-radius" onclick="return confirm('Are you sure')">
                        <h4 class="size4">Delete Fishery</h4>
                    </button>
                </form>
            </div>

            <table>
                <tbody>
                    <div class="row p-5">
                        <h2 class="col-12 text-center">
                            The {{$fishery->location}} Fishery
                        </h2>

                        <div class="col-6">
                            <div>
                                <img src="{{asset('storage/images/fisheries/' . $fishery->photo)}}" width="380"/>
                             </div>
                        </div>

                        <div class="col-6">
                            <p>
                                Its dock is {{$fishery->dock}}
                            </p>
                        </div>
                    </div>

                    <h3 class="size3">
                        Some of the Fish on sale that have been caught at this fishery.
                    </h3>

                    <div class="text-center align-items-center blackBox">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <?php $counter = 0; ?>
                            <div class="carousel-inner">
                            @forelse ($fish as $fish)
                                <div class="carousel-item active">
                                    <div class="row">
                                            @if($fish->fishery_id == $fishery->id)    
                                            @if($counter <= 2)   
                                                <?php $counter += 1; ?>                     
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
                                                @endif                                             
                                            @endif                                                                             
                                        </div>  
                                    @empty
                                    <p>Their are no fish in the fishery</p>
                                    </div>

                                @endforelse
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
