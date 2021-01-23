@extends('layouts.master')

@section('content')
    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page">All Task</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        @include('_partialstest._messages')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="">
                        <div class="card-header">
                            All Tasks
                            <a class="btn btn-sm btn-green float-right" href="{{route('tasks.create')}}">Add Task</a>
                        </div>
                    </div>
                    <div class="card-body mt-0">
                        <div class="table-responsive">
                            {{-- tables --}}
                            <table id="myTable" class="table table-striped table-hover table-responsive-sm table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Description</th>
                                    <th scope="col">Last Run</th>
                                    <th scope="col">Average Runtime</th>
                                    <th scope="col">Next Run</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse ($tasks as $task)
                                    <tr class="table-{{$task->is_active ? 'success' : 'danger'}}">
                                        <th><a href="{{route('tasks.edit',$task->id)}}">{{$task->description}}</a></th>
                                        <td>{{$task->last_run}}</td>
                                        <td>{{$task->average_runtime}} seconds</td>
                                        <td>{{$task->next_run}}</td>
                                        <td>
                                            <form id="task-id-{{$task->id}}"
                                                  action="{{route('tasks.toggle',$task->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('put')
                                                <input type="checkbox" {{$task->is_active ? 'checked' : ''}}
                                                onChange="getElementById('task-id-{{$task->id}}').submit(); ">
                                            </form>
                                        </td>

                                        <td>
                                            <form action="{{route('tasks.destroy',$task->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-default"
                                                        onclick="return confirm('Are you sure?');"><i
                                                        class="fas fa-trash" style="color: #dc1201"></i>
                                                </button>
                                                {{--                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>--}}
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th class="text-center">No Values available</th>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('js')
            <script>
                $(document).ready(function () {
                    $('#myTable').DataTable();

                });

            </script>
@endsection
