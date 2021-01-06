<div class="border border-gray-300 rounded-lg">
    @forelse($tweets as $tweet)
        @include('_tweet')
    @empty
        <p class="p-4 text-blue-500">No tweets to show</p>
    @endforelse
</div>
