@section('title', 'Home')
<x-app :unreadNotifications="$unreadNotifications">
{{-- Tweet Published popup message --}}
<x-popup-message></x-popup-message>

<div>
    @include ('_publish-tweet-panel')

    @include('_timeline')
</div>

<x-popup-message-script/>

</x-app>
