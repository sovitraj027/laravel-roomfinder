{{--@section('reply')
    <span class="float-right">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                data-target="#comment_{{$comment->id}}">Edit</button>
         --}}{{--  edit reply modal--}}{{--
          <div class="modal fade" id="comment_{{$comment->id}}" tabindex="-1" role="dialog"
               aria-labelledby="editComment" aria-hidden="true">
          <div class="modal-dialog" role="document">

               <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editComment">Edit Reply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{route('room.comment_update',$reply->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       placeholder="add comment here ....."
                                       value="{{$reply->body}}" name="body">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-green" type="submit"
                                            id="button-addon2">
                                        Post Reply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
               </div>
          </div>
</div>

 </span>
@endsection--}}


































@foreach($comment->comments as $reply)
    <li class="list-group-item">{{$reply->body}}
        <span class="float-right">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#comment_{{$comment->id}}">Edit</button>
                                     {{--  add comment modal--}}
                                    <div class="modal fade" id="comment_{{$comment->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="editComment" aria-hidden="true">
                                <div class="modal-dialog" role="document">
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
                                    </div>
                                </div>
                            </div>

                                </span>
        <span class="float-right">
             <form action="{{route('room.comment_delete',$reply->id)}}" method="post">
                 @csrf
                 @method('delete')
                <button type="submit" class="btn btn-sm btn-danger float-right ml-3">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </span>
        <br><br>
        <span>
        </span>
    </li>
@endforeach
