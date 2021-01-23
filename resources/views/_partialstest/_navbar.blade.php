<nav class="navbar navbar-expand-md navbar-dark bg-gray-dark m-0">
    <button class="btn text-white mr-3" id="sidebarCollapse"><i class="fas fa-align-left"></i></button>
    <a class="navbar-brand m-0 p-0" href="#"><img src="{{asset('images/logo_name_large.png')}}" alt="Code Alchemy"
            height="50px" width="50px" class="m-0 p-0"></a>
    <button class="btn text-white d-lg-none d-md-none" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span><i class="fas fa-ellipsis-v"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto ">


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle info-number text-white" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell mr-2"></i>
                    <span class="badge badge-success">{{auth()->user()->unreadNotifications->count()}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" toggled>
                    <div class="list-group-flush">
                        <div class="scroller" id="notification_limit">
                            @if(auth()->user()->notifications->count())
                            @foreach(auth()->user()->notifications as $notification)

                            @if(!empty($notification->data['notice']))

                            <a href="{{route('notice.show',['id' => $notification->data['notice']['id'] ])}}"
                                class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="row">
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 pr-2 pr-1 ">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <span class="name">
                                                    Dear {{auth()->user()->name}}
                                                </span>
                                                <small
                                                    class="text-muted time pull-right pr-2">{{date('dS F Y', strtotime($notification->data['notice']['created_at']))}}</small><br>
                                            </div>
                                            <div class="col-sm-12 col-md-12 pr-1">
                                                <div class="message">
                                                    {!!$notification->data['notice']['description']!!}
                                                </div>
                                                <small class="text-muted"><b>Notice:</b>
                                                    {{$notification->data['notice']['title']}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                            @elseif(!empty($notification->data['room']))

                            <a href="{{route('room.show',['id' => $notification->data['room']['id'] ])}}"
                                class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="row">
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 pr-2 pr-1 ">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <span class="name">
                                                    Dear {{auth()->user()->name}}
                                                </span>
                                                <small
                                                    class="text-muted time pull-right pr-2">{{date('dS F Y', strtotime($notification->created_at))}}</small><br>
                                            </div>
                                            <div class="col-sm-12 col-md-12 pr-1">
                                                <div class="message">
                                                    The decision about the room that you have applied to has
                                                    been taken
                                                </div>
                                                <small class="text-muted"><b>Room
                                                        Title:</b> {!! $notification->data['room']['title'] !!}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            @elseif(!empty($notification->data['room_owner']))
                            <a href="{{route('applicants.view',['user_id' => $notification->data['room_owner']['user_id'], 'room_id' => $notification->data['room_owner']['id']] )}}"
                                class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="row">
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 pr-2 pr-1 ">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <span class="name">
                                                    Dear {{auth()->user()->name}}
                                                </span>
                                                <small
                                                    class="text-muted time pull-right pr-2">{{date('dS F Y', strtotime($notification->created_at))}}</small><br>
                                            </div>
                                            <div class="col-sm-12 col-md-12 pr-1">
                                                <div class="message">
                                                    A new Candidate is interested in your property !!
                                                </div>
                                                <small class="text-muted"><b>Room
                                                        Title:</b> {!! $notification->data['room_owner']['title'] !!}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endif

                            {{$notification->markAsRead()}}
                            @endforeach
                            @endif

                            <a href="#"
                                class="list-group-item list-group-item-action flex-column align-items-start nav-seemore">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                        @if(auth()->user()->notifications->count()>1)
                                        <span> <b> See All </b></span>
                                        @else
                                        <span> <b> No Notifications </b></span>
                                        @endif
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </li>


            <li class="nav-item dropdown profile-dropdown">
                <a class="nav-link dropdown-toggle info-number text-white" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
                <div class="dropdown-menu profile-dropdown-item dropdown-menu-right p-0"
                    aria-labelledby="navbarDropdown" toggled>
                    <a class="dropdown-item p-0 profile" href="#">
                        <img src="{{auth()->user()->avatar(auth()->user()->role)}}" alt="Profile Image" />
                    </a>

                    @if(!auth()->user()->admin)
                    <a class="dropdown-item mt-2" href="
                    @if(auth()->user()->role == 1)
                        {{route('owner_profile',auth()->user()->name)}}
                    @else
                        {{route('seeker_profile',auth()->user()->name)}}
                    @endif
                        "><i class="fas fa-user-edit mr-2"></i>Go to Profile</a>

                    @endif
                    <a class="dropdown-item" href="#">
                        @if(auth()->user()->isOnline())
                        <i class="far fa-dot-circle text-success"></i>
                        Online
                        @else
                        <i class="far fa-dot-circle text-muted"></i>
                        offline
                        @endif
                    </a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i>Log
                        Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </div>
</nav>