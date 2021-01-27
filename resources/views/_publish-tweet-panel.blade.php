@push('css-script')
    <style>
        .tweetImage-container input {
            display: none;
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
            width: 25%;
            display: none;
            margin-top: 10px;
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

        .tribute-container {
            top: 20px !important;
        }

        .tweet-textarea:empty:before {
            content: attr(data-placeholder);
            color: #5B7183
        }

        .tweet-textarea span {
            color: #2563EB;
        }

        .tweet-body a {
            color: #2563EB;
        }

        .tweet-body a:hover {
            color: #3B82F6;
        }

        .tribute-container ul {
            background: #EFF6FF !important;
        }

        .tribute-container ul .highlight {
            background: #93C5FD !important;
        }

        .tweet-btn:disabled {
            cursor: default;
            opacity: .5;
            background-color: #3B82F6;
        }
    </style>
@endpush
<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="{{ route('home') }}" class="" style="border: none !important; padding: 0"
          enctype="multipart/form-data">
        @csrf
        <div class="tweet-textarea-container" style="position: relative">
            <div
                class="w-full h-20 tweet-textarea overflow-y-auto mb-2"
                data-placeholder="What's happening?"
                style="resize: none; outline: none"
            >{!! old('body') !!}</div>
        </div>

        <textarea id="textarea-body" name="body" required style="resize: none; outline: none" hidden></textarea>

        <div class="flex justify-between">
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

            <div class="tweet-char-count text-blue-400">0</div>
        </div>

        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <a href="{{ route('profile', auth()->user()) }}">
                <img
                    src="{{ auth()->user()->avatarUrl() }}"
                    alt="your avatar"
                    class="rounded-full mr-2"
                    width="50"
                    height="50"
                >

            </a>
            <button
                type="submit"
                class="tweet-btn bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-5 text-base text-white h-8 justify-self-end"
            >
                Tweet <i class="fas fa-feather-alt fa-fw"></i>
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
        function showPreview(event) {
            if (event.target.files.length > 0) {
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let tweetTextarea = document.querySelector(".tweet-textarea")
            let tweetCharCount = document.querySelector(".tweet-char-count");
            let tweetBtn = document.querySelector('.tweet-btn')
            //set the tweet counter when page loaded
            tweetCharCount.innerHTML = tweetTextarea.innerText.length;

            //change the tweet counter text color depends on the length
            if (tweetTextarea.innerText.length > 255) {
                tweetCharCount.classList.remove('text-blue-400')
                tweetCharCount.classList.add('text-red-400')
                tweetBtn.disabled = true;
            } else {
                tweetBtn.disabled = false;
                tweetCharCount.classList.remove('text-red-400')
                tweetCharCount.classList.add('text-blue-400')
            }

            tweetTextarea.onkeyup = function () {

                let textareaBody = document.getElementById('textarea-body');
                textareaBody.value = this.innerText


                //set the tweet counter when on key up
                tweetCharCount.innerHTML = this.innerText.length;

                //change the tweet counter text color depends on the length
                if (this.innerText.length > 255) {
                    tweetCharCount.classList.remove('text-blue-400')
                    tweetCharCount.classList.add('text-red-400')
                    tweetBtn.disabled = true;
                } else {
                    tweetBtn.disabled = false;
                    tweetCharCount.classList.remove('text-red-400')
                    tweetCharCount.classList.add('text-blue-400')
                }
            };

        });

    </script>
@endpush

@push('css-asset')
    <!-- Tribute CSS -->
    <link href="{{ asset('css/tribute.css') }}" rel="stylesheet">
@endpush
@push('js-asset')
    <!-- Tribute JS -->
    <script src="{{ asset('js/tribute.js') }}"></script>
@endpush

@push('js-script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            var tributeAttributes = {
                values: function (text, cb) {
                    remoteSearch(text, users => cb(users));

                },
                selectTemplate: function (item) {
                    return (
                        "<span>" + item.original.value + "</span>"
                    );

                }
            };

            function remoteSearch(text, cb) {
                var URL = "{{ route('mention') }}";
                let xhr = new XMLHttpRequest(),
                    token = document.querySelector('meta[name="csrf-token"]').content;

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            cb(data);
                        } else if (xhr.status === 403) {
                            cb([]);
                        }
                    }
                };
                xhr.open("POST", URL, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                xhr.send("text=" + text);
            }

            var tributeAutocompleteTestArea = new Tribute(
                Object.assign(
                    {
                        menuContainer: document.querySelector(
                            ".tweet-textarea-container"
                        )
                    },
                    tributeAttributes
                )
            );
            tributeAutocompleteTestArea.attach(
                document.querySelector(".tweet-textarea")
            );
        });
    </script>
@endpush
