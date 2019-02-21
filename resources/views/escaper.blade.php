@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        function convert(source) {
            var re = /(.*)/gm;
            var output = source.replace(re, "\@\<$&\>\@");
            output = output.replace (/>@@<>@/g, ">@"); // I have no fucking idea why I have to do this. Regex. ¯\_(ツ)_/¯
            document.getElementById("output").innerHTML = output;
        }
    </script>
    <div class="container">
        <div class="card">
            <h3 class="card-header">Wikidot Source Code Escaper</h3>
            <div class="card-body">
                <h5 class="card-title">
                    Paste Wikidot code below to have each line properly escaped to send in a message.
                </h5>
                <form method="POST" action="/escaper">
                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="source" placeholder="Paste your stuff here." oninput="convert(this.value)" onchange="convert(this.value)"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-primary btn" id="submit">Do the thing.</button>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="output" readonly>Formatted text will go here.</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection