<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$fish->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$fish->updated_at->diffForHumans()}}
                </p>

                <a href="{{ route('admin.fishs.edit', $fish) }}" class="btn-link ml-auto">Edit Fish</a>

                <form action="{{ route('admin.fishs.destroy', $fish) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure')">Delete Fish</button>
                </form>
                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                             The Fish is {{$fish->name}}
                            </h2>

                            <div class="flex">
                            <p>
                            <img src="{{asset('storage/app/public/images/fish/' . $fish->image)}}" width="200"/>
                            </p>

                            <p>
                               The Cargo consists of {{$fish->cargo}}
                            </p>

                             <p>
                                Cost of €{{$fish->cost}}
                             </p>
                            </div>

                        <div class="p-6"></div>

                             <h2>
                                Basket
                             </h2>

                             <div class="flex">
                             <div>
                                <img src="{{asset('storage/images/basket/' . $fish->basket->picture)}}" width="200"/>
                             </div>

                             <div>
                             <p>
                                {{$fish->basket->location}}
                             </p>

                             <p class="">
                                Station Master {{$fish->basket->station_master}}
                             </p>
                             </div>
                             </div>

                             <div class="p-6"></div>

                        <div>
                            @foreach ($fish->fishery as $fishery)
                            <tr>
                                <td class="font-bold">Fishery</td>
                                <td> {{$fishery->first_name}} </td>
                                <td> {{$fishery->last_name}} </td>
                            </tr>
                            @endforeach
                        </div>
                            </tbody>
                             <table>
                        </div>
            </div>
                    </div>
                </div>
        </x-app-layout>
