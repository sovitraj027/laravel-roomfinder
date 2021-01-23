@extends('layouts.master')

@section('content')

<div class="container-fluid pl-3 pr-3">
    <div class="row">
        <div class="col-12 p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 nodecorationlist">
                    <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="breadcrumb-item active gray" aria-current="page">Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="d-inline-block green">Testimonial</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Testimonial</th>
                                    <th>Date Posted</th>
                                    <th>Posted By</th>
                                    <th>Actions</th>
                                    <th></th>
                                    @if(auth()->user()->admin)
                                    <th>Approve</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($testimonials as $testimonial)
                                <tr>
                                    <td><a href="">{{$testimonial->title}}</a></td>
                                    <td>{{$testimonial->created_at->diffForHumans()}}</td>
                                    <td>{{$testimonial->user->name}}</td>
                                    @if(!auth()->user()->admin)
                                    <td>
                                        <a href="{{route('testimonial.edit',$testimonial->id)}}"><i
                                                class="far fa-edit text-info"></i></a>
                                    </td>
                                    @endif
                                    <td colspan="2">
                                        <form action="{{ route('testimonial.destroy', $testimonial->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-default"><i
                                                    class="fas fa-trash-alt text-danger"></i></button>
                                        </form>
                                    </td>

                                    @if(auth()->user()->admin)
                                    @if($testimonial->approved)
                                    <td>
                                        <a href="{{route('testimonial.disapprove',$testimonial->id)}}"
                                            class="btn btn-sm btn-outline-success">Disapprove</a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{route('testimonial.approve',$testimonial->id)}}"
                                            class="btn btn-sm btn-green">Approve</a>
                                    </td>
                                    @endif
                                    @endif
                                </tr>

                                @empty
                                <td colspan="4" class="mt-5 text-center mb-5">You don't have any testimonial post
                                <td>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection