@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page">Notice</li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="row pb-2">
            <div class="col-md-12">
                <a href="{{ route('notice.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Notice
                </a>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0 m-0">
                        <table class="table table-striped table-hover m-0">
                            <thead class="bg-green">
                            <tr>
                                <th>Name</th>

                                <th width="25%">Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($notices as $notice)
                                <tr>
                                    <td>
                                        {{$notice->title}}
                                    </td>

                                    <td class="d-inline-flex">

                                        <a type="button" class="btn btn-sm btn-default float-right"
                                           href="{{route('notice.edit',$notice->id)}}">
                                            <i class="fas fa-edit" style="color: #1abb9c"></i>
                                        </a>

                                        <form action="{{route('notice.destroy',$notice->id)}}"
                                              method="post" class="form-delete"
                                              style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-default"
                                                    onclick="return confirm('Are you sure?');"><i
                                                    class="fas fa-trash" style="color: #dc1201"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('notice.show',$notice->id)}}" class="pt-1 pl-1"><i
                                                class="far fa-eye"></i></a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No Type found!</td>
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
