<x-app :unreadNotifications="$unreadNotifications">

    <h1 class="text-blue-500 text-2xl">Notifications</h1>

    <div class="border border-gray-300 rounded-lg mt-5 overflow-hidden">
        @if(count($readNotifications) || count($unreadNotifications))

            <x-unread-notifications :unreadNotifications="$unreadNotifications" />
            <x-read-notifications :readNotifications="$readNotifications" />

        @else
            <p class="p-4">There are no notifications to show</p>
        @endif

    </div>

</x-app>
