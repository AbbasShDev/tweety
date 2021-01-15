@if(Session::has('Message'))
    <div class="notify-message">
        {{ Session::get('Message') }}
    </div>
@endif
