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
                                <a href="{{route('report.user_form',$seeker->user_id)}}" class="btn btn-sm btn-outline-info float-right">
                                    Report User
                                </a>
                            @else
                                <a href="{{route('admin.ban_seeker',$seeker->user_id)}}" class="btn btn-sm btn-outline-danger float-right">Ban</a>
                            @endif

                            @if($seeker->user->isOnline())
                                <i class="far fa-dot-circle text-success"></i>
                                Online
                            @else
                                <i class="far fa-dot-circle text-muted"></i>
                                offline
                            @endif

                            <div class="card-body">

                                {{-- ***********************************  PROFILE DISPLAY SECTION ************************************   --}}

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">

                                            <img src="{{$seeker->user->avatar($seeker->user->role)}}"
                                                 class="rounded-circle mb-4 mx-auto d-block" alt=""
                                                 style="width:200px;height:200px;object-fit:cover; border: 1px solid #cccccc">
                                        </div>

                                        <div class="col-md-8">

                                            <h4 class="h4 text-muted pb-2">
                                                <b><i class="fas fa-user-astronaut"></i> Name</b>
                                                : {{$seeker->user->name}}
                                            </h4>

                                            <h4 class="h4 text-muted pb-2">
                                                <b><i class="fas fa-at"></i> Email</b>
                                                : {{$seeker->user->email}}
                                            </h4>

                                            @if(!empty($seeker))
                                                <h4 class="h4 text-muted pb-2">
                                                    <b><i class="fas fa-phone"></i> Contact Number</b>
                                                    : {{$seeker->phone}}
                                                </h4>

                                                <h4 class="h4 text-muted pb-2">
                                                    <b><i class="fas fa-map-marker-alt"></i> Location</b>
                                                    : {{$seeker->place->name}}, {{$seeker->city->name}}, Nepal.
                                                </h4>

                                                <h4 class="h4 text-muted pb-2">
                                                    <b><i class="fab fa-twitter"></i> Social Site : </b>
                                                    <a href="{{$seeker->link}}" target="_blank"
                                                       class="btn btn-sm btn-outline-success">link to site</a>
                                                </h4>


                                                <h4 class="h4 text-muted pb-2">
                                                    <b><i class="fab fa-font-awesome-flag"></i> About Me</b>: <br>
                                                    <br>
                                                    <span style="text-align: justify">{!!$seeker->description !!}</span>
                                                </h4>

                                                <h4 class="h4 text-muted pb-2">
                                                    <b><i class="fas fa-stopwatch"></i> Joined at</b>:
                                                    {{$seeker->created_at->diffForHumans()}}
                                                </h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- ***********************************  EDUCATION DISPLAY SECTION ************************************   --}}
                                @include('education.education')

                                {{-- ***********************************  WORK DISPLAY SECTION ************************************   --}}
                                @include('work.work')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


