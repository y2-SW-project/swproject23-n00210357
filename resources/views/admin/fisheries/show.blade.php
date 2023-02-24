<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$fishery->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$fishery->updated_at->diffForHumans()}}
                </p>

                <a href="{{ route('admin.fisheries.edit', $fishery) }}" class="btn-link ml-auto">Edit Fishery</a>

                <form action="{{ route('admin.fisheries.destroy', $fishery) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure')">Delete Fishery</button>
                </form>
                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                                 The Fishery is
                            </h2>

                            <h2>
                                {{$fishery->first_name}}
                                {{$fishery->last_name}}
                            </h2>

                            <div class="flex">
                            <p>
                                <img src="{{asset('storage/images/fishery/' . $fishery->photo)}}" width="200"/>
                            </p>

                            <div>
                            <p>
                               Their certification is {{$fishery->certification}}
                            </p>

                             <p>
                                They are paid €{{$fishery->salary}} yearly
                             </p>
                            </div>
                            </div>
                            </tbody>
                             <table>
                        </div>
            </div>
                    </div>
                </div>
        </x-app-layout>
