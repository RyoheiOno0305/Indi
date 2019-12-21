@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

        </div>
    </div>

    <!-- チャットルーム -->
    <div id="room">
        @foreach($messages as $key => $message)
            <!-- 送信したメッセージ -->
            @if($message->send == $loginId)
                <div class="send" style="text-align: right">
                    <p>{{$message->message}}</p>
                </div>
            @endif

            <!-- 受信したメッセージ -->
            @if($message->recieve == $loginId)
                <div class="recieve" style="text-align: left">
                    <p>{{$message->message}}</p>
                </div>
            @endif
        @endforeach
    </div>

    <form action="{{ url('/chat/send')}}" >
        <textarea name="message" style="width:100%"></textarea>
        <input type="hidden" name="send" value="{{$param['send']}}">
        <input type="hidden" name="recieve" value="{{$param['recieve']}}">
        <input type="hidden" name="login" value="{{ $loginId }}">
        <button type="submit" id="btn-send">送信</button>
    </form>
</div>
    


<script type="text/javascript">
    Pusher.logToConsole = true;

    var pusher = new Pusher('6463ec249929928c34dc', {
        cluster : 'ap3',  
        encryped: true
    })

    // 購読するチャンネル
    var pusherChannel = pusher.subscribe('chat');

    // イベント受診後下記の処理
    pusherChannel.bind('chat_event', fucntion (data){
        let appendText;
        let login = $('input[name="login"]').val();

        if(data.send === login){
            appendText = '<div class="send" style="text-align:right"><p>' + data.message + '</p></div>'
        }else if(data.revieve === login){
            appendText = '<div class="recieve" style="text-align:left"><p>' +  
        }else{
            return false;
        }

        // メッセージを表示
        $("#room").append(appendText);

        if(data.recieve === login){
            Push.create("新着メッセージ",{
                body: data.message,
                timeout: 8000,
                onClick: function(){
                    window.focus();
                    this.close();
                }
            })
        }

    });

    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
        }});
    // メッセージ送信
    $('#btn_send').on('click', function(){
        $.ajax({
            type : 'POST', 
            url : '/chat/send',
            data : {
                message : $('textaea[name="message"]').val(),
                send: $('input[name="send"]').val(),
                recieve : $('input[name="recieve"]').val(),
            }
        }).done(function(result){
            $('textarea[name="message"]').val('');
        }).fail(function(result){

        });
    })
</script>

@endsection



@extends('layouts.app')
@section('content')
<div id="chat">
    <textarea v-model="message"></textarea>
    <br>
    <button type="button" @click="send()">送信</button>

    <div v-for="m in messages">
        <span v-text="m.created_at"></span>
        <span v-text="m.body"></span>
    </div>
</div>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    new Vue({
        el: '#chat',
        data: {
            message: '',
            messages: []
        },
        methods: {
            getMessages() {
                const url = '/ajax/chat';
                axios.get(url).then((response) => {

                    this.messages = response.data;

                });
            },
            send() {
                
                const url = '/ajax/chat';
                const params = { message: this.message };
                axios.post(url, params).then((response) => {
                    // 成功したらメッセージをクリア
                    this.message = '';
                });
            },
            mounted(){
                this.getMessages();
            }
        }
    });
</script>
@endsection


