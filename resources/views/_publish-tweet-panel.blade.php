<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets">
        @csrf
        <textarea
            name="body"
            class="w-full h-20"
            placeholder="What's up doc?"
            required
            autofocus
            style="resize: none; outline: none"
        ></textarea>

        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <a href="{{ route('profile', auth()->user()) }}">
                <img
                    src="{{ auth()->user()->avatar }}"
                    alt="your avatar"
                    class="rounded-full mr-2"
                    width="50"
                    height="50"
                >

            </a>
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-5 text-base text-white h-8"
            >
                Tweet!
            </button>
        </footer>
    </form>

    @error('body')
        <p class="text-red-700 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
