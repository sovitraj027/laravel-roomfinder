@extends('layouts.master')

@section('content')

    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page">Create Application</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('_partialstest._messages')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row welcomecard">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">About Room</div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <tbody>
                                            @forelse($applicants as $applicant)
                                                <tr>
                                                    <td>
                                                        <img src="{{$applicant->user->avatar($applicant->user->role)}}"
                                                             class="rounded-circle mb-4 mx-auto d-block" alt=""
                                                             style="width:100px;height:100px;object-fit:cover; border: 1px solid #cccccc">
                                                    </td>

                                                    <td>
                                                        <h6 class="h6 text-muted pb-2">
                                                            <b><i class="fas fa-user-astronaut"></i> Name</b>
                                                            : {{$applicant->user->name}}
                                                        </h6>

                                                        <h6 class="h6 text-muted pb-2">
                                                            <b><i class="fas fa-at"></i> Email</b>
                                                            : {{$applicant->user->email}}
                                                        </h6>

                                                        <a href="{{route('seeker.show',$applicant->user_id)}}"
                                                           class="btn btn-sm btn-outline-info">visit profile</a>
                                                    </td>

                                                    @if($applicant->status == 'hired')
                                                        <td>
                                                            <h4><span class="badge badge-success w-100"><i
                                                                        class="text-white fas fa-check"></i>
                                                        <strong>HIRED</strong></span></h4>
                                                        </td>
                                                    @elseif($applicant->status == 'rejected')
                                                        <td>
                                                            <h4><span class="badge badge-danger w-100"><i
                                                                        class="text-white fas fa-times"></i>
                                                        <strong>REJECTED</strong></span></h4>
                                                    @elseif($applicant->status == 'pending')
                                                        @if($hired_status == 0)
                                                            <td>
                                                                <a href="{{route('applicant.hire',['user_id'=>$applicant->user_id,'room_id' =>$room_id])}}"
                                                                   class="btn btn-sm btn-outline-success mb-3">
                                                                    <i class="fas fa-thumbs-up"></i> Hire Candidate
                                                                </a>

                                                                <a href="{{route('applicant.reject',['user_id'=>$applicant->user_id,'room_id' =>$room_id])}}"
                                                                   class="btn btn-sm btn-outline-danger mb-3">
                                                                    <i class="far fa-thumbs-down"></i> Reject Candidate
                                                                </a>
                                                            </td>
                                                        @endif

                                                    @endif
                                                </tr>
                                            @empty
                                                <p>No replies</p>
                                            @endforelse

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
    </div>
@endsection

