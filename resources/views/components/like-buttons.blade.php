
    <form method="POST"
          action="/tweets/{{ $tweet->id }}/like"
    >
        @csrf

        <div class="flex items-center mr-4 {{ $tweet->isLikedBy(current_user()) ? 'text-blue-500' : 'text-gray-500' }}">
            <button type="submit"
                    class="text-xs flex"
            >
                <i class="fas fa-thumbs-up mr-1 w-3"></i>
                {{ $tweet->likes ?: 0 }}
            </button>
        </div>
    </form>

    <form method="POST"
          action="/tweets/{{ $tweet->id }}/like"
    >
        @csrf
        @method('DELETE')

        <div class="flex items-center {{ $tweet->isDisLikedBy(current_user()) ? 'text-blue-500' : 'text-gray-500' }}">
            <button type="submit" class="text-xs flex">
                <i class="fas fa-thumbs-down mr-1 w-3"></i>
                {{ $tweet->dislikes ?: 0 }}
            </button>
        </div>
    </form>
