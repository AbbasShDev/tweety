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
