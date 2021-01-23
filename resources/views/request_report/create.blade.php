@extends('layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 nodecorationlist">
                    <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="breadcrumb-item green"><a href="{{route('request_report.index')}}" class="green">Request
                            and Report</a></li>
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
                    <h5 class="pb-2">Create Request or Report</h5>

                    <form class="custom-hover" action="{{route('request_report.store')}}" method="POST">
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
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="report_category_id">Request
                                        Type</label>
                                    <select class="custom-select" name="report_category_id" id="report_category_id">
                                        <option value="0" disabled>
                                            Select Type
                                        </option>                                
                                            @if (auth()->user()->role == 3 || auth()->user()->role == 4)
                                                <option value="3" selected>
                                                    UnBan 
                                                </option>
                                            @endif
                                        <option value="2">Request Feature</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 p-2">
                                <div class="form-group">
                                    <label for="article-ckeditor" class="gray">Justification</label>
                                    <textarea class="form-control" id="article-ckeditor" name="justification" rows="3"
                                         required>{{old('justification')}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
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

@section('js')

<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>
@endsection