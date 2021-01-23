<div class="small card text-info reply-list mb-2" style="margin-left: 40px">
    <li class="list-group-item">
        <h6>{{$reply->body}}</h6>
        <br>
        By <strong>{{$reply->user_id == auth()->id() ? 'You' : $reply->user->name}}</strong>,
        <i>{{$reply->created_at->diffForHumans()}}</i>
        @if($reply->user_id == auth()->id())
            <span class="float-right">
              <a class="float-right" data-toggle="modal" href="#reply_{{$reply->id}}"><i class="fas fa-edit"
                                                                                         style="color: #1abb9c"></i></a>
        </span>

            {{--//delete form--}}
            <span class="float-right">
         <form action="{{route('room.comment_delete',$reply->id)}}" method="POST">
            @csrf
             @method('DELETE')
            <button class="btn btn-sm btn-default"
                    onclick="return confirm('Are you sure?');">
                 <i class="fas fa-trash" style="color: #dc1201"></i>
             </button>
        </form>
        @endif

    </span>
    </li>


    <div class="actions">
        {{--<a href="{{route('thread.edit',$thread->id)}}" class="btn btn-info btn-sm">Edit</a>--}}

        <div class="modal fade" id="reply_{{$reply->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editComment">Edit Reply</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="comment-form">
                            <form action="{{route('room.comment_update',$reply->id)}}" method="post" role="form">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control"
                                               value="{{$reply->body}}" name="body">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-green" type="submit"
                                                    id="button-addon2">
                                                Post comment
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>
</div>
