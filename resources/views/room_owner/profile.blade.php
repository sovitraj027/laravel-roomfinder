@extends('layouts.master')

@section('content')

<div class="container-fluid pl-3 pr-3">
    <div class="row">
        <div class="col-12 p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 nodecorationlist">
                    <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="breadcrumb-item active gray" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    @include('_partialstest._messages')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span> Your Profile</span>
                        <!-- Button trigger modal -->
                        @if(empty($owner))
                        <button type="button" class="btn btn-sm btn-green float-right" data-toggle="modal"
                            data-target="#addProfile{{$user->id}}">
                            <i class="fas fa-plus"></i> Create Profile
                        </button>
                        @else

                        <form action="{{route('owner.destroy',$owner->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger float-right ml-3"
                                onclick="return confirm('All your posts will also be deleted')">
                                <i class="fas fa-trash"></i> Delete Profile
                            </button>
                        </form>

                        <button type="button" class="btn btn-sm btn-green float-right " data-toggle="modal"
                            data-target="#updateProfile{{$user->id}}">
                            <i class="fas fa-editfas fa-edit"></i> Update Profile
                        </button>
                        @endif
                    </div>

                    <div class="card-body">

                        {{-- ***********************************  PROFILE MODAL SECTION ************************************   --}}
                        @if(empty($owner))
                        <div class="modal fade " id="addProfile{{$user->id}}" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                            <form action="{{route('owner.store')}}" method="post" enctype="multipart/form-data">
                                @else
                                <div class="modal fade" id="updateProfile{{$user->id}}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">

                                    <form action="{{route('owner.update',$owner->id)}}" method="post"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        @endif
                                        @csrf
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                        Profile</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                </div>
                                                <div class="modal-body">

                                                    {{--  Modal Inputs   --}}

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Avatar</span>
                                                        </div>
                                                        <input type="file" id="avatar" class="form-control"
                                                            name="avatar" accept="image/*">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Name</span>
                                                        </div>
                                                        <input type="text" id="name" class="form-control" name="name"
                                                            value="{{$user !== null ? $user->name : old('name')}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Email</span>
                                                        </div>
                                                        <input type="text" id="email" class="form-control" name="email"
                                                            value="{{$user !== null ? $user->email : old('email')}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Phone</span>
                                                        </div>
                                                        <input type="text" id="phone" class="form-control" name="phone"
                                                            placeholder="7 or 10 digits"
                                                            value="{{$owner !== null ? $owner->phone : old('phone')}}"
                                                            pattern="^\d{7,10}$">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <label class="input-group-text"
                                                                        for="city">City</label>
                                                                </div>
                                                                <select class="custom-select" name="city_id" id="city"
                                                                    onchange="selectCity(this);">
                                                                    <option value="0" disabled selected>
                                                                        Select City
                                                                    </option>
                                                                    @foreach($cities as $city)
                                                                    <option value="{{$city->id}}" id="{{$city->id}}"
                                                                        @if(!empty($owner->city_id))
                                                                        @if($city->id == $owner->city_id)
                                                                        selected
                                                                        @endif
                                                                        @endif
                                                                        >{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <label class="input-group-text"
                                                                        for="select_place">Place</label>
                                                                </div>
                                                                <select class="custom-select" id="select_place">
                                                                    <option value="0" disabled selected>
                                                                        Select City First
                                                                    </option>
                                                                </select>
                                                                @foreach($cities as $city)
                                                                <select class="places custom-select" name="place_id"
                                                                    id="{{'pid'.$city->id}}" style="display: none;">
                                                                    <option value="0" disabled selected>
                                                                        Select place
                                                                    </option>
                                                                    @foreach($city->places as $place)
                                                                    <option value="{{$place->id}}" id="{{$place->id}}"
                                                                        @if(!empty($owner->place_id))
                                                                        @if($place->id == $owner->place_id)
                                                                        selected
                                                                        @endif
                                                                        @endif
                                                                        >{{$place->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Link to Social Media</span>
                                                        </div>
                                                        <input type="url" id="link" class="form-control" name="link"
                                                            value="{{$owner !== null ? $owner->link : old('link')}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <span class="input-group-text">Description</span>
                                                        <textarea class="form-control" id="article-ckeditor"
                                                            name="description"
                                                            rows="3">{{$owner !== null ? $owner->description : old('description')}}</textarea>
                                                    </div>


                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-dismiss="modal"><i
                                                            class="fas fa-times-circle"></i></button>
                                                    <button type="submit" class="btn btn-outline-success btn-sm"><i
                                                            class="fas fa-check-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                        </div>


                        {{-- ***********************************  PROFILE DISPLAY SECTION ************************************   --}}

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{$user->avatar(auth()->user()->role)}}"
                                        class="rounded-circle mb-4 mx-auto d-block" alt=""
                                        style="width:200px;height:200px;object-fit:cover; border: 1px solid #cccccc">
                                </div>

                                <div class="col-md-9">

                                    <h4 class="h4 text-muted pb-2">
                                        <b><i class="fas fa-user-astronaut"></i> Name</b>
                                        : {{$user->name}}
                                    </h4>

                                    <h4 class="h4 text-muted pb-2">
                                        <b><i class="fas fa-at"></i> Email</b>
                                        : {{$user->email}}
                                    </h4>

                                    @if(!empty($owner))

                                    <h4 class="h4 text-muted pb-2">
                                        <b><i class="fas fa-phone"></i> Contact Number</b>
                                        : {{$owner->phone}}
                                    </h4>

                                    <h4 class="h4 text-muted pb-2">
                                        <b><i class="fas fa-map-marker-alt"></i> Location</b>
                                        : {{$owner->place->name}}, {{$owner->city->name}}, Nepal.
                                    </h4>

                                    <h4 class="h4 text-muted pb-2">
                                        <b><i class="fab fa-twitter"></i> Social Site : </b>
                                        <a href="{{$owner->link}}" target="_blank"
                                            class="btn btn-sm btn-outline-success">link to site</a>
                                    </h4>


                                    <h4 class="h4 text-muted pb-2">
                                        <b><i class="fab fa-font-awesome-flag"></i> About Me</b>: <br>
                                        <br>
                                        <span style="text-align: justify">{!!$owner->description !!}</span>
                                    </h4>

                                    <h4 class="h4 text-muted pb-2">
                                        <b><i class="fas fa-stopwatch"></i> Joined at</b>:
                                        {{$owner->created_at->diffForHumans()}}
                                    </h4>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');

        window.onload = function () {
            selectCity(document.getElementById('city'));
        }

        function selectCity(city) {
            //Not displaying places before selecting city
            places = document.getElementsByClassName('places');
            for (var i = 0; i < places.length; i++) {
                places[i].style.display = "none";
            }
            //city is selected
            if (city) {
                //(first/default) select is removed
                document.getElementById('select_place').style.display = "none";
            }
            //places according to city is displayed
            document.getElementById('pid' + city.value).setAttribute("name", "place_id")
            document.getElementById('pid' + city.value).style.display = "block";
        }
</script>
@endsection