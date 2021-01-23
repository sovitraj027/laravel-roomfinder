@extends('layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item green"><a href="{{route('notice.index')}}" class="green">Notice</a>
                        </li>
                        <li class="breadcrumb-item active gray" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('_partialstest._messages')

        <div class="card mb-2">
            <div class="card-body">
                <div class="row welcomecard">
                    <div class="col-12">
                        <h5 class="pb-2">Create Notice</h5>

                        <form class="custom-hover" action="{{route('notice.store')}}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="gray">Title</label>
                                        <input type="text" class="form-control" id="title" required placeholder="Title"
                                               name="title" value="{{old('title')}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 p-2">
                                    <div class="form-group">
                                        <label for="editor" class="gray">Description</label>
                                        <textarea class="form-control" id="article-ckeditor" name="description" rows="3"
                                                  required>{{old('description')}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">

                                        <label for="role" class="gray">Send Notice To</label>
                                        <br>
                                        @foreach($roles as $role)
                                            <div class="form-check form-check-inline">
                                                <input class="custom-checkbox form-check-input " name="roles[]"
                                                       type="checkbox" id="{{$role->name}}" value="{{$role->id}}">
                                                <label class="form-check-label"
                                                       for="{{$role->name}}">{{$role->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row pl-3">
                                <div class="col-12 ">
                                    <button type="submit" id="checkBtn" class="btn btn-green float-right">Create
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>
@endsection
