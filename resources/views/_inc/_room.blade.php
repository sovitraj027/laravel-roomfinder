<h3 class="text-center title">Rooms</h3>
<div class="container-fluid mx-4">
    <div class="row mb-3">

        <div class="col-md-6 mr-5">
            <div class="card">
                <div class="card-header">
                    <h4> Recent Rooms</h4>
                </div>
                <div class="card-body">
                    @foreach ($recentRooms as $recentRoom)
                    <div class="card mb-3">
                        <h5 class="h5 card-header"><span class="text-info">{{$recentRoom->title}}</span>
                            <a href="{{route('category_room_show',$recentRoom->id)}}"
                                class="btn btn-sm btn-outline-dark float-right"><span>View</span></a>
                        </h5>

                        <div class="card-body">
                            <p class="small">
                                <span><span class="text-success">Price</span>: &#36; {{$recentRoom->price}}</span>
                                <br>
                                <span><span class="text-success"><i class="fas fa-briefcase"></i> Total Rooms
                                    </span> {{ ucwords($recentRoom->total_rooms) }}</span>
                                <br>
                                <span><span class="text-success"><i class="fas fa-hourglass-end"></i> Location:
                                    </span> {{ $recentRoom->city->name }}, {{$recentRoom->place->name}}</span>
                                <br>
                                <span><span class="text-success"><i class="fas fa-tags"></i> Category:</span>
                                    {{ ucwords($recentRoom->category->name) }}</span>

                                <span class="float-right"><small>Posted:
                                        {{$recentRoom->created_at}}</small></span>
                            </p>
                        </div>

                    </div>
                    @endforeach
                    <div class="card-body text-center">
                        <a href="{{route('seeker_room')}}" class="btn btn-sm btn-outline-info">See More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- side column -->
        <div class="col-md-5">

            <div class="card">
                <div class="card-header">
                    <h4>Highlighted Job </h4>
                </div>
                <div class="card-body">
                    @foreach ($mostViewedRooms as $mostViewedRoom)
                    <div class="card mb-3">
                        <h5 class="h5 card-header"><span class="text-info">{{$mostViewedRoom->title}}</span>
                            <a href="{{route('category_room_show',$mostViewedRoom->id)}}"
                                class="btn btn-sm btn-outline-dark float-right"><span>View</span></a>
                        </h5>


                        <div class="card-body">
                            <p class="small">
                                <span><span class="text-success">Price</span>: &#36; {{$mostViewedRoom->price}}</span>
                                <br>
                                <span><span class="text-success"><i class="fas fa-briefcase"></i> Total Rooms
                                    </span> {{ ucwords($mostViewedRoom->total_rooms) }}</span>
                                <br>
                                <span><span class="text-success"><i class="fas fa-hourglass-end"></i> Location:
                                    </span> {{ $mostViewedRoom->city->name }}, {{$mostViewedRoom->place->name}}</span>
                                <br>
                                <span><span class="text-success"><i class="fas fa-tags"></i> Category:</span>
                                    {{ ucwords($mostViewedRoom->category->name) }}</span>

                                <span class="float-right"><small>Posted:
                                        {{$mostViewedRoom->created_at}}</small></span>
                            </p>
                        </div>

                    </div>

                    @endforeach
                    <div class="card-body text-center">
                        <a href="{{route('seeker_room')}}" class="btn btn-sm btn-outline-info">See More</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>