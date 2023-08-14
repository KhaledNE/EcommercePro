<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <link href="build/assets/app-972d3a07.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .k {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 5px #eee;
        }

        b {
            color: #333;
            font-weight: bold;
        }

        p {
            color: #666;
            font-size: 14px;
        }

        .s {
            color: #2861ff;
            text-decoration: none;
        }

        textarea {
            width: 100%;
            height: 50px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #0099ff;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

        <!-- end header section -->
        <!-- slider section -->
        @include('home.slider')

        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('home.why')
    <!-- end why section -->

    <!-- arrival section -->
    <!-- end arrival section -->

    <!-- product section -->
    @include('home.product')
    <!-- end product section -->
    {{-- Comment and reply system starts here --}}
    {{-- <div style="text-align: center;padding-bottom:30px">
        <h1 style="font-size:65px; text-align:center; padding-top:20px; padding-bottom:20px;">Comments</h1>
        <form action="{{ url('add_comment') }}" method="post">
            @csrf
            <textarea style="height: 150px; width: 600px;" placeholder="Comment Something Here" name="comment"></textarea>
            <br>
            <input type="submit" class="btn btn-info" value="Comment">
        </form>
    </div> --}}
    {{-- <div style="" class="k">
        <h1 style="font-size:50px; padding-bottom:20px; text-align: center;">All Comments</h1>
        @foreach ($comment as $s)
        <div class="k">
            <b>{{ $s->name }}</b>
            <p>{{ $s->comment }}</p>
            <a href="javascript::void(0);"class="s" onclick="reply(this)" data-Commentid="{{ $s->id }}">Reply</a>
            @foreach($reply as $x)
            @if($x->comment_id==$s->id)
            <div class="k">
                <b>{{$x->name}}</b>
                <p>{{$x->reply}}</p>
                <a href="javascript::void(0);"class="s" onclick="reply(this)" data-Commentid="{{ $s->id }}">Reply</a>
            </div>
            @endif
            @endforeach
        </div>
        @endforeach
        {!! $comment->withQueryString()->links() !!}
        {{-- Replay Textbox
        <div class="replydiv" style="display: none">
        <form action="{{url('add_reply')}}" method="post">
            @csrf
            <input type="text" name="commentId" id="commentId" hidden="">
            <textarea placeholder="Write something here" name="reply"></textarea>
            <br>
            <input type="submit" value="Reply" class="btn btn-primary">
            <a href="javascript::void(0);" class="btn btn-outline-danger" onclick="reply_close(this)">Close</a>
        </form>
        </div>
    </div> --}}

    {{-- Comment and reply system ends here --}}
    <!-- subscribe section -->
    @include('home.client')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('home.subscribe')
    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© N.E  <a href="">Developed by developer Khaled Ibrahim</a><br>

            N.E <a href="https://themewagon.com/" target="_blank"></a>

        </p>
    </div>
    {{-- <script>
        function reply(caller) {
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
            $('.replydiv').insertAfter($(caller));
            $('.replydiv').show()
        }        
        function reply_close(caller) {
            $('.replydiv').hide()
        }
    </script>--}}
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            var scrollpos = sessionStorage.getItem('scrollpos');
            if (scrollpos) {
                window.scrollTo(0, scrollpos);
                sessionStorage.removeItem('scrollpos');
            }
        });

        window.addEventListener("beforeunload", function (e) {
            sessionStorage.setItem('scrollpos', window.scrollY);
        });
    </script>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
