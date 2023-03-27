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

                <x-nav-link :href="route('admin.fishs.edit', $fishery)" :active="request()->routeIs('admin.fishs.edit', $fishery)" class="text-decoration-none col-3">
                    <button class="dropbtn colours-bg border-radius">
                        <h4 class="size4">Edit Fishery</h4>
                    </button>
                </x-nav-link>

                <form action="{{ route('admin.fishs.destroy', $fishery) }}" method="post" class="col-3 py-1">
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

                    <div class="text-center align-items-center">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="{{asset('storage/images/fisheries/P1.jpg')}}" class="d-block w-25" alt="...">
                              </div>

                              <div class="carousel-item">
                                <img src="{{asset('storage/images/fisheries/P2.jpg')}}" class="d-block w-25" alt="...">
                              </div>

                              <div class="carousel-item">
                                <img src="{{asset('storage/images/fisheries/P3.jpg')}}" class="d-block w-25" alt="...">
                              </div>

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
