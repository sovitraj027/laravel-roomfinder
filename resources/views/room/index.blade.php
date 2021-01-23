@extends('layouts.master')

@section('content')

    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page">Room</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('_partialstest._messages')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">All Rooms
                            <a href="{{route('room.create')}}" type="button" class="btn btn-sm btn-green float-right">
                                <i class="fas fa-plus"></i> Add Room
                            </a>
                        </div>

                        <div class="card-body mt-0">
                            <div class="table-responsive">
                                <table id="myTable"
                                       class="table table-striped table-hover table-responsive-sm table-sm">
                                    <thead class="bg-green">
                                    <tr>
                                        <th>Room</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>{{$room->title}}</td>
                                            <td>{{$room->created_at}}</td>
                                            <td class="d-inline-flex">

                                                <a type="button" class="btn btn-sm btn-default float-right" href="{{route('room.edit',$room->id)}}">
                                                    <i class="fas fa-edit" style="color: #1abb9c"></i>
                                                </a>

                                                <form action="{{route('room.destroy',$room->id)}}"
                                                      method="post" class="form-delete"
                                                      style="display: inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-default"
                                                            onclick="return confirm('Are you sure?');"><i
                                                            class="fas fa-trash" style="color: #dc1201"></i>
                                                    </button>
                                                </form>
                                                <a href="{{route('room.show',$room->id)}}" class="pt-1 pl-1"><i class="far fa-eye"></i></a>
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
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });


    </script>
@endsection
