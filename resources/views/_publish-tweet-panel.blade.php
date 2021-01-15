@section('css-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.css" integrity="sha512-CmjeEOiBCtxpzzfuT2remy8NP++fmHRxR3LnsdQhVXzA3QqRMaJ3heF9zOB+c1lCWSwZkzSOWfTn1CdqgkW3EQ==" crossorigin="anonymous" />

<style>
    .tweetImage-container input {
        display:none;
    }

    .tweetImage-container label {
        color: #3a3434;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
    }

    .tweetImage-container label img {
        width: 20px;
    }

    .tweetImage-container .preview {
        position: relative;
        width:25%;
        display:none;
        margin-top:10px;
    }

    .tweetImage-container .preview span {
        position: absolute;
        top: 3px;
        right: 3px;
        cursor: pointer;
        padding: 2px;
        border-radius: 50%;
        color: #f3f4f6;
        font-size: 10px;
    }

</style>
@endsection
    <div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets" class="" style="border: none !important; padding: 0" enctype="multipart/form-data">
        @csrf
        <textarea
            name="body"
            class="w-full h-20"
            placeholder="What's up doc?"
            required
            autofocus
            style="resize: none; outline: none"
        >{{ old('body') }}</textarea>

        <div class="tweetImage-container">
            <label for="tweetImage">
                <img src="{{ asset('images/upload-image-icon.svg') }}" alt="">
            </label>
            <input type="file" id="tweetImage" name="tweetImage" onchange="showPreview(event);">
            <div class="preview" id="tweetImage-preview">
                <span onclick="removeImage()">&#10006;</span>
                <img src="">
            </div>
        </div>

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
                class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-5 text-base text-white h-8 justify-self-end"
            >
                Tweet!
            </button>
        </footer>
    </form>

    @error('body')
        <p class="text-red-700 text-sm mt-2">{{ $message }}</p>
    @enderror
    @error('tweetImage')
        <p class="text-red-700 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
@push('js-script')
<script>
    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("tweetImage-preview");
            var img = document.querySelector("#tweetImage-preview img");
            preview.style.display = "block";
            img.src = src;
        }
    }

    function removeImage() {
        var preview = document.getElementById("tweetImage-preview");
        preview.style.display = "none";
        var input = document.querySelector(".tweetImage-container input");
        input.value = '';
    }

</script>
@endpush
