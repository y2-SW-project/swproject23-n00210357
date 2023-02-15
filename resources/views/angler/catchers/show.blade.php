<x-app-layout>
    <x-slot location="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catchers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$catcher->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$catcher->updated_at->diffForHumans()}}
                </p>

                <a href="{{ route('angler.catchers.edit', $catcher) }}" class="btn-link ml-auto">Edit Catcher</a>

                <form action="{{ route('angler.catchers.destroy', $catcher) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure')">Delete Catcher</button>
                </form>
                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                                 The Catcher is
                            </h2>

                            <h2>
                                {{$catcher->first_name}}
                                {{$catcher->last_name}}
                            </h2>

                            <div class="flex">
                            <p>
                                <img src="{{asset('storage/images/catcher/' . $catcher->photo)}}" width="200"/>
                            </p>

                            <div>
                            <p>
                               Their certification is {{$catcher->certification}}
                            </p>

                             <p>
                                They are paid €{{$catcher->salary}} yearly
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
