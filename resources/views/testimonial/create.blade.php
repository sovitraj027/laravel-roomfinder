@extends('layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item green"><a href="{{route('testimonial.index')}}" class="green">Testimonial</a></li>
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
                        <h5 class="pb-2">Add Testimonial</h5>

                        <form class="custom-hover" action="{{route('testimonial.store')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">

                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="gray">Title</label>
                                        <input type="text" class="form-control" id="title" required placeholder="Title" name="title" value="{{old('title')}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 p-2">
                                    <div class="form-group">
                                        <label for="article-ckeditor" class="gray">Description</label>
                                        <textarea class="form-control" id="article-ckeditor" name="description" rows="3" required>{{old('description')}}</textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="row pl-3">
                                <div class="col-12 ">
                                    <button type="submit" id="checkBtn" class="btn btn-green float-right">Create</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
