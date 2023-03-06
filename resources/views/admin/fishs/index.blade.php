<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <a href="{{ route('admin.fishs.create') }}" class="btn-link btn-lg mb-2">+ New Fish</a>
            @forelse ($fishs as $fish)
                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg flex">
                    <div>
                    <p class="whitespace-pre-wrap">
                        <img src="{{asset('storage/app/public/images/fish/' . $fish->image)}}" width="200"/>
                    </p>
                    </div>

                    <div>
                    <h2>
                        <a href="{{ route('admin.fishs.show', $fish) }}"> {{$fish->name}}</a>
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
