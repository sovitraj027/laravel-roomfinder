<!-- ********************HEADER - SECTION************************ -->

 @include('_inc._header')

<!-- *******************CATEGORY_ROOM-SECTION************************ -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-5 ">
                <div class="card-header text-center h4 py-5">All Rooms</div>

                <div class="card-body mt-2">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-green">
                                <tr>
                                    <th>Room</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category_rooms as $room)
                                <tr>
                                    <td>{{$room->titleLimit}}</td>
                                    <td>{{$room->created_at}}</td>
                                    <td>
                                        <a href="{{route('category_room_show',$room->id)}}" class="pt-1 pl-1">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- *******************FOOTER-SECTION************************ -->

@include('_inc._footer')