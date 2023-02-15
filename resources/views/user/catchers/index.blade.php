<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catchers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

                @forelse ($catchers as $catcher)
                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg flex">
                    <div>
                    <p class="whitespace-pre-wrap">
                        <img src="{{asset('storage/images/catcher/' . $catcher->photo)}}" width="200"/>
                    </p>
                    </div>

                    <div>
                    <h2>
                        <a href="{{ route('customer.catchers.show', $catcher) }}"> {{$catcher->first_name}}</a>
                    </h2>

                    <p class="mt-2">
                        {{Str::limit($catcher->certification), 200}}
                    </p>

                    <p class="mt-2">
                        Owned by {{$catcher->user->name}}
                    </p>

                    </div>

                    <span class="block mt-4 text-sm opacity-70"> {{$catcher->updated_at->diffForHumans()}}</span>
                </div>
                @empty
                <p>You have no catchers</p>
                @endforelse
                {{$catchers->links()}}
            </div>
        </div>
</x-app-layout>