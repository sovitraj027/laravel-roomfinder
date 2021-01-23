@extends('layouts.master')

@section('content')

    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('_partialstest._messages')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">All Users</div>

                        <div class="card-body">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                       href="#nav_owner" role="tab" aria-controls="nav-home"
                                       aria-selected="true">Room Owners</a>

                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                       href="#nav_seeker"
                                       role="tab" aria-controls="nav-contact" aria-selected="false">Room Seekers</a>
                                </div>
                            </nav>


                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav_owner" role="tabpanel"
                                     aria-labelledby="nav-home-tab">

                                    <table class="table table-striped table-hover table-responsive-sm table-sm">
                                        <thead class="bg-green">
                                        <tr>
                                            <th>status</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Member Since</th>
                                            <th>Permission</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($owners as $owner)
                                            <tr>
                                                <td>
                                                    @if($owner->isOnline())
                                                        <li class="text-success">Online</li>
                                                    @else
                                                        <li class="text-muted">Offline</li>
                                                    @endif
                                                </td>
                                                <td>{{$owner->name}}</td>
                                                <td> {{ $owner->email }} </td>
                                                <td> {{ $owner->created_at->format('M j, Y') }} </td>

                                                <td>
                                                    @if($owner->role == 3)
                                                        <a href="{{route('admin.unban_owner',$owner->id)}}"
                                                           class="btn btn-block btn-sm btn-outline-success">UnBan</a>
                                                    @elseif($owner->role == 1)
                                                        <a href="{{route('admin.ban_owner',$owner->id)}}"
                                                           class="btn btn-block btn-sm btn-outline-danger">Ban</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>


                                </div>

                                <div class="tab-pane fade" id="nav_seeker" role="tabpanel"
                                     aria-labelledby="nav-contact-tab">


                                    <table class="table table-striped table-hover table-responsive-sm table-sm">
                                        <thead class="bg-green">
                                        <tr>
                                            <th>status</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Member Since</th>
                                            <th>Permission</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($seekers as $seeker)
                                            <tr>
                                                <td>
                                                    @if($seeker->isOnline())
                                                        <li class="text-success">Online</li>
                                                    @else
                                                        <li class="text-muted">Offline</li>
                                                    @endif
                                                </td>
                                                <td>{{$seeker->name}}</td>
                                                <td> {{ $seeker->email }} </td>
                                                <td> {{ $seeker->created_at->format('M j, Y') }} </td>

                                                <td>
                                                    @if($seeker->role == 4)
                                                        <a href="{{route('admin.unban_seeker',$seeker->id)}}"
                                                           class="btn btn-block btn-sm btn-outline-success">UnBan</a>

                                                    @elseif($seeker->role == 2)
                                                        <a href="{{route('admin.ban_seeker',$seeker->id)}}"
                                                           class="btn btn-block btn-sm btn-outline-danger">Ban</a>
                                                    @endif

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
        </div>
    </div>
@endsection
