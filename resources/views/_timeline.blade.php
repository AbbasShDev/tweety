<div class="border border-gray-300 rounded-lg">
    @forelse($tweets as $tweet)
        @include('_tweet')
    @empty
    @endforelse
</div>
