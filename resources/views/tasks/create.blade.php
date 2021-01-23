@extends('layouts.master')

@section('content')

    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item green"><a href="{{route('tasks.index')}}" class="green">All Tasks</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page">Create Task</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @include('_partialstest._messages')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Create Task</div>

                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>

                            <div class="form-group">
                                <label for="command">Command</label>
                                <input type="text" class="form-control" id="command" name="command">
                            </div>

                            <div class="form-group">
                                <label for="notification_email">Notification Email</label>
                                <input type="text" class="form-control" id="notification_email"
                                       name="notification_email" value="admin@admin.com">
                            </div>

                            <div class="form-group">
                                <label for="expression">Cron Expression</label>
                                <input type="text" class="form-control" id="expression" name="expression"
                                       value="* * * * *">
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="dont_overlap" name="dont_overlap"
                                       value="1">
                                <label class="form-check-label" for="dont_overlap">Don't Overlap</label>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="run_in_maintenance"
                                       name="run_in_maintenance" value="1">
                                <label class="form-check-label" for="run_in_maintenance">Run in Maintenance</label>
                            </div>

                            <div class="float-right">
                                <button type="submit" class="btn btn-sm btn-outline-dark">Submit</button>
                                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
