<x-app :unreadNotifications="$unreadNotifications">

    <h1 class="text-blue-500 text-2xl">Notifications</h1>

    <div class="border border-gray-300 rounded-lg mt-5 overflow-hidden">

        @foreach($unreadNotifications as $unread)
            @if($unread->type == 'App\Notifications\UserFollowed')
            <div class="{{ $loop->last ? '' : 'border-b border-b-gray-400' }} p-4 bg-blue-50">
                <a class="text-blue-500 hover:text-blue-700" href="{{ route('profile', $unread->data['username']) }}">
                    {{ $unread->data['username'] }}
                </a>
                followed you
            </div>
            @endif

            @if($unread->type == 'App\Notifications\TweetLiked')
                <div class="{{ $loop->last ? '' : 'border-b border-b-gray-400' }} p-4 bg-blue-50">
                    <a class="text-blue-500 hover:text-blue-700" href="{{ route('profile', $unread->data['username']) }}">{{ $unread->data['username'] }}</a>
                    liked your tweet
                    <div class="mt-2 px-4 py-2 bg-white rounded-lg">
                        <p>{{ $unread->data['tweet'] }}</p>
                        @if($unread->data['tweetImage'])
                            <img class="pt-2" src="{{ asset("storage/".$unread->data['tweetImage']) }}" alt="">
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

        @foreach($readNotifications as $read)
            @if($read->type == 'App\Notifications\UserFollowed')
                <div class="{{ $loop->last ? '' : 'border-b border-b-gray-400' }} p-4">
                    <a class="text-blue-500 hover:text-blue-700" href="{{ route('profile', $read->data['username']) }}">
                        {{ $read->data['username'] }}
                    </a>
                    followed you
                </div>
            @endif
            @if($read->type == 'App\Notifications\TweetLiked')
                <div class="{{ $loop->last ? '' : 'border-b border-b-gray-400' }} p-4">
                    <a class="text-blue-500 hover:text-blue-700" href="{{ route('profile', $read->data['username']) }}">{{ $read->data['username'] }}</a>
                    liked your tweet
                    <div class=" mt-2 px-4 py-2 bg-blue-50 rounded-lg">
                        <p>{{ $read->data['tweet'] }}</p>
                        @if($read->data['tweetImage'])
                            <img class="pt-2" src="{{ asset("storage/".$read->data['tweetImage']) }}" alt="">
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

    </div>

</x-app>
