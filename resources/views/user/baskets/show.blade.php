<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$basket->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$basket->updated_at->diffForHumans()}}
                </p>

                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                             The Basket is {{$basket->location}}
                            </h2>

                            <div class="flex">
                            <p>
                                <img src="{{asset('storage/images/basket/' . $basket->picture)}}" width="200"/>
                            </p>

                            <div>
                            <p>
                               The station master consists of {{$basket->station_master}}
                            </p>

                             <p>
                                Checked for dock {{$basket->has_dock}}
                             </p>

                             <p>
                                Checked for airport {{$basket->has_airport}}
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
