@push('js-script')
<script>
    window.addEventListener("load", function(){
        let notifyMessage = document.querySelector('.notify-message');

        if (notifyMessage) {
            notifyMessage.classList.add('show')

            setTimeout(()=>{
                notifyMessage.classList.remove('show')
            },3500)
        }
    });
</script>
@endpush
