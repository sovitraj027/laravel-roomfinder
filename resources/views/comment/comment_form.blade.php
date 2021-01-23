
{{--  add comment form--}}
<div class="comment-form">
    <form action="{{route('room.comment',$room->id)}}" method="post">
        @csrf
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="add comment here ....."
                       value="{{old('body')}}" name="body">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-green" type="submit" id="button-addon2">Post comment
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
