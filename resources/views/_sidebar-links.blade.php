<ul>
    <li><a
            class="font-bold text-lg mb-4 block"
            href="/tweets"
        >Home</a></li>
    <li><a
            class="font-bold text-lg mb-4 block"
            href="{{ route('explore') }}"
        >Explore</a></li>
    <li><a
            class="font-bold text-lg mb-4 block"
            href="{{ route('notifications') }}"
        >Notifications
            @if(count($unreadNotifications))
                <span class="bg-blue-400 rounded-full px-2 text-sm text-white">
                        {{ count($unreadNotifications) }}
                </span>
            @endif
        </a>
    </li>
    <li><a
            class="font-bold text-lg mb-4 block"
            href="#"
        >Messages</a></li>
    <li><a
            class="font-bold text-lg mb-4 block"
            href="#"
        >Bookmarks</a></li>
    <li><a
            class="font-bold text-lg mb-4 block"
            href="#"
        >Lists</a></li>
    <li><a
            class="font-bold text-lg mb-4 block"
            href="{{ route('profile', auth()->user()) }}"
        >Profile</a></li>
    <li>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="font-bold text-lg block">Logout</button>
        </form>

    </li>
</ul>
