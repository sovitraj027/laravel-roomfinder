@extends('layouts.master')

@section('content')

<div class="container-fluid pl-3 pr-3">
    <div class="row">
        <div class="col-12 p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 nodecorationlist">
                    <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="breadcrumb-item active gray" aria-current="page">Request and Report</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="d-inline-block green">Request and Report</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Title</th>
                                <th>Type</th>
                                <th>justification</th>
                                <th colspan="2">Action</th>
                            </thead>

                            <tbody>
                                @foreach ($request_reports as $request_report)
                                <tr>
                                    <td><a href="{{route('request_report.show',$request_report->id)}}">{{$request_report->title}}</a></td>
                                    <td>{{$request_report->report_category->name}}</td>
                                    <td>{{$request_report->justification}}</td>

                                    @if (auth()->id() == $request_report->user_id || auth()->user()->admin)
                                    <td>
                                        <form action="{{route('request_report.destroy',$request_report->id)}}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-default"
                                                onclick="return confirm('Are you sure?');"><i class="fas fa-trash"
                                                    style="color: #dc1201"></i>
                                            </button>
                                        </form>
                                    </td>

                                    <td>
                                        <a href="{{route('request_report.edit',$request_report->id)}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    @endif

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
@endsection