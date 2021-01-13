
<div class="flex p-4 border-b border-b-gray-400">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('profile', $tweet->user) }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
        </a>
    </div>

    <div>
        <a href="{{ $tweet->user->path() }}">
            <h5 class="font-bold mb-2">{{ $tweet->user->name }}</h5>
        </a>

        <p class="text-sm mb-4">
            {{ $tweet->body }}
        </p>
        @if($tweet->image)
            <img
                src="{{ $tweet->getImage() }}"
                 alt="Tweet image"
                 class="rounded-l mb-4"
            >
        @endif

        <x-like-buttons :tweet="$tweet"/>
    </div>
</div>
