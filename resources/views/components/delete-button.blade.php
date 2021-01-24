@if($tweet->isTweetedBy(current_user()))
    <div class="ml-auto">
        <form method="POST"
              action="/home/{{ $tweet->id }}"
        >
            @csrf
            @method('DELETE')

            <div class="flex items-center text-gray-500">
                <button type="submit" class="text-xs flex" onclick="return confirm('Confirm deleting a tweet?')">
                    <i class="far fa-trash-alt w-4"></i>
                </button>
            </div>
        </form>

    </div>
@endif
