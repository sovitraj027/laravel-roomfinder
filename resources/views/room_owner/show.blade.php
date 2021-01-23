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

                            @if (! auth()->user()->admin)
                                <a href="{{route('report.user_form',$owner->user_id)}}" class="btn btn-sm btn-outline-info float-right">
                                    Report User
                                </a>
                            @else
                                <a href="{{route('admin.ban_owner',$owner->user_id)}}" class="btn btn-sm btn-outline-danger float-right">
                                    Ban
                                </a>
                            @endif

                            @if($owner->user->isOnline())
                                <i class="far fa-dot-circle text-success"></i>
                                Online
                            @else
                                <i class="far fa-dot-circle text-muted"></i>
                                offline
                            @endif
                        </div>

                        <div class="card-body">

                            {{-- ***********************************  PROFILE DISPLAY SECTION ************************************   --}}
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{$owner->user->avatar($owner->user->role)}}"
                                             class="rounded-circle mb-4 mx-auto d-block" alt=""
                                             style="width:200px;height:200px;object-fit:cover; border: 1px solid #cccccc">
                                    </div>

                                    <div class="col-md-9">

                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fas fa-user-astronaut"></i> Name</b>
                                            : {{$owner->user->name}}
                                        </h4>

                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fas fa-at"></i> Email</b>
                                            : {{$owner->user->email}}
                                        </h4>


                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fas fa-phone"></i> Contact Number</b>
                                            : {{$owner->phone}}
                                        </h4>

                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fas fa-map-marker-alt"></i> Location</b>
                                            : {{ucfirst($owner->address)}}
                                        </h4>

                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fab fa-twitter"></i> Social Site : </b>
                                            <a href="{{$owner->link}}" target="_blank"
                                               class="btn btn-sm btn-outline-success">link to site</a>
                                        </h4>

                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fas fa-hand-point-right"></i> Total Rooms {{$owner->user->name}}</b>:
                                            {{count($owner->rooms)}} Rooms
                                        </h4>


                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fab fa-font-awesome-flag"></i> About Owner</b>: <br>
                                            <br>
                                            <span style="text-align: justify">{!!$owner->description !!}</span>
                                        </h4>

                                        <h4 class="h4 text-muted pb-2">
                                            <b><i class="fas fa-stopwatch"></i> Joined Since</b>:
                                            {{$owner->created_at->diffForHumans()}}
                                        </h4>
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
    </script>
@endsection
