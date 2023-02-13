<x-app-layout>
    <x-slott name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Anglers')}}
        </h2>
    </x-slott>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('anglers.create) }}" class="btn-link btn_lg mb-2">+ New Fish</a>
            @forelse ($anglers as $angler)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2x1">
                    <a href="{{ route('notes.show', $angler->uuid) }}"> {{$angler->title}} </a>
                </h2>

                <p class="mt-2">
                    {{Str::limit($angler->text, 200) }}
                </p>
                <span class="block mt-4 text-sm opacity-70"> {{$angler->updated_at-diffForHumans() }} </span>
            </div>
            @empty
            <p>You have no anglers</p>
            @endforelse
            {{$anglers->links()}}
        </div>
    </div>
</x-app-layout>