@section('title', 'Followers')
<x-app :unreadNotifications="$unreadNotifications">

    <h1 class="text-blue-500 text-2xl">Followers</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-5">
        @foreach ($users as $user)
            <a href="{{ $user->path() }}" class="flex items-center mb-5">
                <img src="{{ $user->avatar }}"
                     alt="{{ $user->username }}'s avatar"
                     width="60"
                     class="mr-4 rounded"
                >

                <div>
                    <h4 class="font-bold">{{ $user->username }}</h4>
                </div>
            </a>
        @endforeach

    </div>
    {{ $users->links() }}

</x-app>
