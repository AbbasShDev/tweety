
<div class="grid grid-cols-4 sm:grid-cols-8 gap-0 pl-0 p-4 border-b border-b-gray-400">
    <div class="flex justify-center">
        <a href="{{ route('profile', $tweet->user) }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full object-center"
                width="50"
                height="50"
            >
        </a>
    </div>

    <div class="col-span-3 sm:col-span-7">
        <a href="{{ $tweet->user->path() }}">
            <h5 class="font-bold mb-2">{{ $tweet->user->name }}</h5>
        </a>

        <p class="text-sm mb-4 tweet-body">
            {!! $tweet->body !!}
        </p>
        @if($tweet->image)
            <img
                src="{{ $tweet->getImage() }}"
                 alt="Tweet image"
                 class="mb-4"
            >
        @endif
        <div class="flex">
            <x-like-buttons :tweet="$tweet"/>
            <x-delete-button :tweet="$tweet"/>
        </div>
    </div>
</div>
