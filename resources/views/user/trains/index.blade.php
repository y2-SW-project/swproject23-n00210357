<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fishs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            @forelse ($fishs as $fish)
                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg flex">
                    <div>
                    <p class="whitespace-pre-wrap">
                        <img src="{{asset('storage/images/fish/' . $fish->image)}}" width="200"/>
                    </p>
                    </div>

                    <div>
                    <h2>
                        <a href="{{ route('customer.fishs.show', $fish) }}"> {{$fish->name}}</a>
                    </h2>

                    <p class="mt-2">
                        {{Str::limit($fish->cargo), 200}}
                    </p>

                    <p class="mt-2">
                        Owned by {{$fish->user->name}}
                    </p>

                    </div>

                    <span class="block mt-4 text-sm opacity-70"> {{$fish->updated_at->diffForHumans()}}</span>
                </div>
                @empty
                <p>You have no fishs</p>
                @endforelse
                {{$fishs->links()}}
            </div>
        </div>
</x-app-layout>
