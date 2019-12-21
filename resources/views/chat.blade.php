<!doctype html>
<html>
<head>
<!-- meta tag -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRFtokenの読み込み、bladeにデフォルトで埋め込まれていないため -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Indi') }}</title>

<!-- Pusher -->
<!-- <script src=“https://js.pusher.com/3.2/pusher.min.js“></script>
<script src=“https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js”></script> -->



<!-- Styles -->
<!-- Bootstrap CSS -->
<!-- swiper -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}" >
<link rel="stylesheet" href="{{ asset('css/app.css') }}" >
<link rel="stylesheet" href="{{ asset('css/styles.css') }}" >

</head>
<body>
    <div id="chat">
        <div class="offset-md-3 col-md-5 chat-display-box">
            <div v-for="m in messages">
                <div v-if="m.send === {{$loginId}}">
                    <div style="text-align: right">
                        <h3><span v-text="m.message"></span></h3>
                        <h5><span v-text="m.created_at"></span></h5>
                    </div> 
                </div>
                <br>
                <br>
                <div v-if="m.recieve === {{$loginId}}">
                    <div style="text-align: left">
                        <h3><span v-text="m.message"></span></h3>
                        <h5><span v-text="m.created_at"></span></h5>
                    </div> 
                </div>

            </div>
        </div>

        <div class="form-box">
            <hr>
            <textarea v-model="message" class="offset-md-2" rows="4" cols="100"></textarea>
            <input v-model="loginId" type="hidden" value={{$loginId}}>
            <input v-model="recieve" type="hidden" value={{$recieve}}>
            <br>
            <button type="button" class="btn btn-primary offset-md-9"  v-on:click="send()">送信</button>
        </div>
    </div>
    <script src="{{ asset('/js/app.js')}}"></script>
    <script>

        new Vue({
            el: '#chat',
            data: {
                message:'',
                loginId:'',
                recieve:'',
                messages: []
            },
            methods: {
                getMessages() {
                    const url = '/ajax/chat/{{$recieve}}';
                    axios.get(url).then((response) => {

                            this.messages = response.data;

                        });
                },
                send() {
                    
                    const url = '/ajax/chat/{{$recieve}}';

                    axios.post(url,{
                        message: this.message,
                        loginId: {{$loginId}},
                        recieve: {{$recieve}}
                    }).then((response) => {

                            // 成功したらメッセージをクリア
                            this.message = '';

                        });

                }
            },
            mounted() {

                this.getMessages();

                Echo.channel('chat')
                    .listen('MessageCreated', (e) => {

                        this.getMessages(); // メッセージを再読込

                    });

            }
        });
    
    </script>
</body>
</html>