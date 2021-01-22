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
    @if($unread->type == 'App\Notifications\UserMentioned')
        <div class="{{ $loop->last ? '' : 'border-b border-b-gray-400' }} p-4 bg-blue-50">
            <a class="text-blue-500 hover:text-blue-700" href="{{ route('profile', $unread->data['username']) }}">{{ $unread->data['username'] }}</a>
            mentioned you in a tweet
            <div class="mt-2 px-4 py-2 bg-white rounded-lg">
                <p>{{ $unread->data['tweet'] }}</p>
                @if($unread->data['tweetImage'])
                    <img class="pt-2" src="{{ asset("storage/".$unread->data['tweetImage']) }}" alt="">
                @endif
            </div>
        </div>
    @endif
@endforeach
