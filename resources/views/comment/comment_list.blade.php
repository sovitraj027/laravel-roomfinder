<li class="list-group-item">
    <h5 class="text-primary">{{$comment->body}}</h5>


    By <strong>{{$comment->user->id == auth()->id() ? 'You' : $comment->user->name}}</strong>,
    <i>{{$comment->created_at->diffForHumans()}}</i>
    @if($comment->user_id == auth()->id())
        <span class="float-right">
            <a class="float-right" data-toggle="modal" href="#comment_{{$comment->id}}">
                <i class="fas fa-edit" style="color: #1abb9c"></i>
            </a>
        </span>

        <span class="float-right">
         <form action="{{route('room.comment_delete',$comment->id)}}" method="POST">
            @csrf
             @method('delete')
             <button class="btn btn-sm btn-default"
                     onclick="return confirm('Are you sure?');">
                 <i class="fas fa-trash" style="color: #dc1201"></i>
             </button>
        </form>
    </span>
    @endif
</li>


<div class="actions">
    {{--<a href="{{route('thread.edit',$thread->id)}}" class="btn btn-info btn-sm">Edit</a>--}}

    <div class="modal fade" id="comment_{{$comment->id}}">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editComment">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{route('room.comment_update',$comment->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       placeholder="add comment here ....."
                                       value="{{$comment->body}}" name="body">
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</div>

