<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>

{{--<textarea name="" id="caaanDo" cols="30" rows="10"><a href="">kkkk</a></textarea>--}}


{{--<div id="caaanDo">Some more text over here.</div>--}}

<div id="test-autocomplete-textarea-container">
            <textarea
                id="test-autocomplete-textarea"
                cols="40"
                rows="10"
                placeholder="States of USA"
            ></textarea>
</div>


<script src="{{ asset('js/tribute.js') }}"></script>
<script>
    var tributeAttributes = {
        values: function (text, cb) {
            remoteSearch(text, users => cb(users));

        },

        selectTemplate: function(item) {
            if (typeof item === "undefined") return null;
            if (this.range.isContentEditable(this.current.element)) {
                return (
                    '<span contenteditable="false"><a>' +
                    item.original.key +
                    "</a></span>"
                );
            }

            return item.original.value;
        },
        menuItemTemplate: function(item) {
            return item.string;
        }
    };


    function remoteSearch(text, cb) {
        var URL = "http://tweety.to/test";
        let xhr = new XMLHttpRequest(),
            token = document.querySelector('meta[name="csrf-token"]').content;

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    cb(data);
                    // console.log(xhr.responseText)
                } else if (xhr.status === 403) {
                    cb([]);
                }
            }
        };
        xhr.open("POST", URL , true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        xhr.send("text="+text);
    }

    var tributeAutocompleteTestArea = new Tribute(
        Object.assign(
            {
                menuContainer: document.getElementById(
                    "test-autocomplete-textarea-container"
                )
            },
            tributeAttributes
        )
    );
    tributeAutocompleteTestArea.attach(
        document.getElementById("test-autocomplete-textarea")
    );
</script>
</body>
</html>
