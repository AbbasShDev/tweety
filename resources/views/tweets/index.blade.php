<x-app :unreadNotifications="$unreadNotifications">
    {{-- Tweet Published popup message --}}
    <x-popup-message></x-popup-message>

    <div>
        @include ('_publish-tweet-panel')

        @include('_timeline')
    </div>

@push('js-script')
<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<script>
$('document').ready(function () {
    //showing notification message
    $('.notify-message').each(function () {

        $(this).animate({
                right:'10px'
            },1000,
            function () {
                $(this).delay(3000).fadeOut();
            })
    })
})
</script>
@endpush
</x-app>
