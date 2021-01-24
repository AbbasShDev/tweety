<ul class="text-center lg:text-left">
    <li><a
{{--            bg-gray-300 rounded-lg--}}
            class="font-bold text-lg mb-4 block hover:text-gray-500 pl-0 lg:pl-2 @if(Request::is('home')) bg-gray-300 rounded-lg @endif"
            href="{{ route('home') }}"
        >
            <i class="fa fa-home fa-fw"></i>
            Home
        </a>
    </li>
    <li><a
            class="font-bold text-lg mb-4 block hover:text-gray-500 pl-0 lg:pl-2 @if(Request::is(auth()->user()->username)) bg-gray-300 rounded-lg @endif"
            href="{{ route('profile', auth()->user()) }}"
        >
            <i class="fas fa-user fa-fw"></i>
            Profile
        </a>
    </li>
    <li><a
            class="font-bold text-lg mb-4 block hover:text-gray-500 pl-0 lg:pl-2 @if(Request::is('notifications')) bg-gray-300 rounded-lg @endif"
            href="{{ route('notifications') }}"
        >
            <i class="fas fa-bell fa-fw"></i>
            Notifications
            @if(count($unreadNotifications))
                <span class="bg-blue-400 rounded-full px-2 text-sm text-white">
                        {{ count($unreadNotifications) }}
                </span>
            @endif
        </a>
    </li>
    <li><a
            class="font-bold text-lg mb-4 block hover:text-gray-500 pl-0 lg:pl-2 @if(Request::is('explore')) bg-gray-300 rounded-lg @endif"
            href="{{ route('explore') }}"
        >
            <i class="fas fa-users fa-fw"></i>
            Explore
        </a>
    </li>
    <li>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="font-bold text-lg block mx-auto lg:mr-auto lg:ml-0 hover:text-gray-500  pl-0 lg:pl-2">
                <i class="fas fa-sign-out-alt fa-fw"></i>
                Logout
            </button>
        </form>

    </li>
</ul>
