<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <table>
                <tbody>
                    <div class="text-center">
                        <h1>
                            Basket of {{$user->name}}
                        </h1>
                    </div>

                <div class="row align-items-center">

                @forelse ($fishs as $fish)
                @forelse ($baskets as $basket)
                    @if($user->id == $basket->user_id && $fish->id == $basket->fish_id)
                    <div class="col-sm-12 col-lg-4">
                    <div class="border border-4 card m-5 p-0" style="width: 390px">
                    <div class="row">
                        <div class="col-4">
                        <a href="{{ route('admin.fishs.show', $fish) }}" class="whitespace-pre-wrap text-center p-0 m-0">
                            <img src="{{asset('storage/images/fish/' . $fish->image)}}" width="150" height="150"/>
                        </a>
                        </div>

                        <div class="col-1"></div>

                        <div class="noWrap col-6">
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
                    @endif
                </div>
                
                @empty
                <p>Their are no fish in the basket</p>
                @endforelse

                @empty
                <p>Their are no fish in the basket</p>
                @endforelse

                <div class="row">
                    <div class="col-10"></div>

                    <div class="col-2">
                    {{$fishs->links()}}
                    </div>
                </div>

            </div>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>