@extends('layouts.master')
@section('content')
<div class="container-fluid pr-3 pl-3 pt-0">
    <div class="row">
        <div class="col-12 p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 nodecorationlist">
                    <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="breadcrumb-item green"><a href="{{route('request_report.index')}}" class="green">Request
                            Report</a></li>
                    <li class="breadcrumb-item active gray" aria-current="page">View</li>
                </ol>
            </nav>
        </div>
    </div>

    @include('_partialstest._messages')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Report

                    <div class="text-muted float-right">
                        <b>Created At:</b> {{date('dS F Y', strtotime($request_report->created_at))}}
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 pl-3">

                            <h4 class="h4 text-muted pb-2">
                                <b> Sent by</b>
                                : {{$request_report->user->name}}
                            </h4>

                            <h4 class="h4 text-muted pb-2">
                                <b> Title</b>
                                : {{$request_report->title}}
                            </h4>

                            <h4 class="h4 text-muted pb-2">
                                <b>Justification</b>
                                : <p>{!!$request_report->justification!!}</p>
                            </h4>

                            @if ($request_report->reported_user_id != null && auth()->user()->admin)
                                @if ($reported_user->role == 2)
                                    <h5 class="h5 text-muted pb-2">
                                        <b>Report Against User</b>
                                    </h5>
                                    <a href="{{route('seeker.show',$reported_user->id)}}">
                                        <strong>{{$reported_user->name}}</strong> <small><b>(Goto Profile)</b></small>
                                    </a>
                                @else
                                    <a href="{{route('owner.show',$reported_user->owner->id)}}">
                                        <strong>{{$reported_user->name}}</strong> <small><b>(Goto Profile)</b></small>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<br><br>
@endsection