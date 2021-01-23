<div class="message-wrapper">
    <ul class="messages">

        @foreach($messages as $message)
        <li class="message clearfix">
            {{--if message from id is equal to auth id then it is sent by logged in user --}}
            <div class="{{($message->from == auth()->id()) ? 'sent' : 'received'}}">
                <p>{{$message->message}}</p>
                {{-- <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p> --}}
                <p class="date">{{$message->created_at->diffForHumans()}}</p>
            </div>
        </li>
        @endforeach
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="submit">
</div>