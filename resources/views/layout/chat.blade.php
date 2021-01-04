{{--<div class="col-md-8 col-xl-6 chat" id="mess" style="bottom: 0px;position: fixed;right: 0px;width: 320px;height: 50px">--}}
{{--    <div class="card"  style="border: 1px solid black;border-radius:0px;!important;">--}}
{{--        <div class="row card-body" id="live" style="background-color: blue;height: 40px;width: 295px;margin-left: 0px">--}}
{{--            <div class="col-md-6" style="margin-top: -10px;display: flex">--}}
{{--                <span style="color: white">--}}
{{--                    Live Chat--}}
{{--                </span>--}}
{{--            </div>--}}
{{--            <div class="col-md-6" style="margin-top: -6px;color: white">--}}
{{--                <i  class="fas fa-angle-up" id="smallmess"></i>--}}
{{--                <i  id="closemess" class="fas fa-times"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card-body msg_card_body" id="data" style="display: none">--}}
{{--            @foreach($data1 as $item)--}}
{{--                <div class="d-flex justify-content-start mb-4">--}}
{{--                    <div class="msg_cotainer" style="width: 50%">--}}
{{--                        <span style="color: #ff0000">{{$item->author}} :</span>--}}
{{--                    </div>--}}
{{--                    <div id="contentshow" class="msg_cotainer1">--}}
{{--                        {{$item->content}}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div id="send" style="display: none">--}}
{{--            <form method="post" action="{{route('chat.store')}}">--}}
{{--                @csrf--}}
{{--                <input id="token" type="hidden" name="token" value="{{$data->token}}"/>--}}
{{--                <input id="action" type="hidden" value="none">--}}
{{--                <div class="input-group" style="background-color: white">--}}
{{--                    <textarea id="text" name="content" class="form-control type_msg"--}}
{{--                              placeholder="Type your message..."></textarea>--}}
{{--                    <div class="input-group-append">--}}
{{--                        <input type="button" name="chat " id="chat" style="height: 60px" value="send"--}}
{{--                               class="form-control input-group-text send_btn">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<script--}}
{{--    src="https://code.jquery.com/jquery-3.5.1.js"--}}
{{--    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="--}}
{{--    crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>--}}
{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $('#chat').click(function () {--}}
{{--            var messager = $('#text').val();--}}
{{--            var token=$('#token').val();--}}
{{--            $.ajax({ //Process the form using $.ajax()--}}
{{--                type: 'POST', //Method type--}}
{{--                // url: 'http://localhost/api/sentmessage', //Your form processing file URL--}}
{{--                url: window.location.origin+'/api/sentmessage',--}}
{{--                data: 'content='+messager+'&token='+token, //Forms name--}}
{{--                dataType: 'json',--}}
{{--                success: function (data) {--}}
{{--                    if (data.status) { //If fails--}}
{{--                       $('#text').val('');--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        $('#closemess').click(function () {--}}
{{--            $('#mess').css('width','0px');--}}
{{--            $('#mess').css('height','0px');--}}
{{--        });--}}
{{--        $('#smallmess').click(function () {--}}
{{--            if($('#action').val()=='block') {--}}
{{--                $('#data').css('display', 'none');--}}
{{--                $('#send').css('display', 'none');--}}
{{--                $('#mess').css('height', '50px');--}}
{{--                $('#action').val('none');--}}
{{--                $('#smallmess').removeClass();--}}
{{--                $('#smallmess').addClass('fas fa-angle-up');--}}
{{--            }else{--}}
{{--                $('#data').css('display', 'block');--}}
{{--                $('#send').css('display', 'block');--}}
{{--                $('#mess').css('height','350px');--}}
{{--                $('#action').val('block');--}}
{{--                $('#smallmess').removeClass();--}}
{{--                $('#smallmess').addClass('fas fa-angle-down');--}}
{{--            }--}}
{{--        })--}}

{{--    });--}}

{{--    </script>--}}
{{--    <script >--}}
{{--      var socket = io("http://127.0.0.1:6001");--}}
{{--    socket.on('laravel_database_chat:message', function (data) {--}}
{{--        console.log(data);--}}
{{--        if ($('#' + data.id).length == 0) {--}}
{{--            // var dates = new Date(data.created_at);--}}
{{--            // var day = dates.getDate();--}}
{{--            $('#data').append(' <div class="d-flex justify-content-start mb-4"><div class="msg_cotainer"><span  style="color: red">'--}}
{{--                + data.author +':'+--}}
{{--                '</span></div><div class="msg_cotainer">' + data.content +'</div></div>');--}}
{{--        } else {--}}
{{--            console.log('Đã có tin nhắn');--}}
{{--        }--}}
{{--    })--}}
{{--</script>--}}
