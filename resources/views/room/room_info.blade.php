<div class="card-body mb-2">
    <h5 class="text-muted pb-2">
        <b><i class="fas fa-home"></i> Room Title</b>
        : {{$room->titlelimit}}
    </h5>

    <h5 class="text-muted pb-2">
        <b><i class="fas fa-globe-americas"></i> Location</b>
        : {{$room->place->name}}, {{$room->city->name}}, Nepal
    </h5>

    <h5 class="text-muted pb-2">
        <b><i class="fab fa-cuttlefish"></i> Room Category</b>
        : {{$room->category->name}}
    </h5>

    <h5 class="text-muted pb-2">
        <b><i class="fas fa-hand-holding-usd"></i> Price</b>
        : <i class="fas fa-rupee-sign"></i> {{$room->price}}
    </h5>

    <h5 class="text-muted pb-2">
        <b><i class="fas fa-street-view"></i> No of Rooms</b>
        : {{$room->total_rooms}}
    </h5>

    @auth
    <h5 class="text-muted pb-2">
        <b><i class="fas fa-user-astronaut"></i> Property Owner</b>
        : @if(auth()->user()->role == 2)
        <a href="{{route('owner.show',$room->owner->id)}}" class="btn btn-outline-info btn-sm"><i
                class="fas fa-external-link-alt"></i> {{$room->user->name}}</a>
        @else
        {{$room->user->name}}
        @endif
    </h5>
    @endauth

    <h5 class="text-muted pb-2">
        <b><i class="fas fa-user-lock"></i> Room Facilities</b>
    </h5>
    <h6>@foreach($room->facilities as $facility)
        <span class="badge badge-pill badge-success"> {{$facility->name}}</span>
        @endforeach
    </h6>

</div>