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
                    <div class="card-header text-center bg-danger text-white h3">Oops !! Something went wrong ?!?</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <h3 class="text-center text-danger">
                            Sorry, You have been banned from using our services
                            <a href="{{route('read_more')}}">See more here</a>

                            <a href="{{route('request_report.create')}}" class="btn btn-sm btn-outline-danger mt-5">
                                Justfy your actions
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection