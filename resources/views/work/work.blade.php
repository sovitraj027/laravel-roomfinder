<div class="card">
    <div class="card-header">
        <h5 class="green d-inline-block">Works</h5>
        {{--WORK Modal Button --}}
        @if(auth()->user()->role == 2)
            <button type="button" class="btn btn-default btn-sm float-right" data-toggle="modal"
                    data-target="#addWork{{$user->id}}">
                <i class="fas fa-plus green"></i> <span class="green h6">Add Work</span>
            </button>
        @endif
    </div>

    <div class="card-body">
        @forelse($works as $work)
            @if(auth()->user()->role == 2)
                <p class="float-right text-danger">
                    <i class="fas fa-trash-alt" data-toggle="modal"
                       data-target="#deleteWork{{$work->id}}" data-id="{{$work->id}}"></i>
                </p>
                <p class="float-right text-info mr-4">
                    <i class="fas fa-pencil-alt" data-toggle="modal"
                       data-target="#editWork{{$work->id}}" data-id="{{$work->id}}"></i>
                </p>
            @endif

            <h5 class="h5 text-dark "><i class="fas fa-level-up-alt"></i> &nbsp; Position:
                <b>{{$work->position}}</b></h5>
            <h5 class="h5 text-dark"><i class="fas fa-building"></i>&nbsp; Company:
                <b>{{$work->company}}</b></h5>
            <h5 class="h5 mb-2 text-dark"><i class="fas fa-calendar"></i>&nbsp; Year:
                <b>{{ $work->year }}</b></h5>
            <hr>

            {{--editWORK Modal Display --}}
            @if(auth()->user()->role == 2)
                <div class="modal fade" id="editWork{{$work->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Works and Experiences
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-level-up-alt"></i>&nbsp;Position</span>
                                    </div>
                                    <input type="text" id="editPosition" class="form-control"
                                           name="position" value="{{ $work->position }}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-building"></i>&nbsp;Company</span>
                                    </div>
                                    <input type="text" id="editCompany" class="form-control"
                                           name="company" value="{{ $work->company }}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-calendar"></i>&nbspYear</span>
                                    </div>
                                    <input type="number" id="editYear" class="form-control" name="year"
                                           value="{{ $work->year }}">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger btn-sm"
                                        data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                                <button type="submit" class="btn btn-green btn-sm editWorkButton"
                                        data-dismiss="modal" data-id="{{$work->id}}"><i
                                        class="fas fa-check-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{--delete WORK Modal Display --}}
            @if(auth()->user()->role == 2)
                <div class="modal fade" id="deleteWork{{$work->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4>Remove work experience</h4>
                                <button type="button" class="close"
                                        data-dismiss="modal">&times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <h6 class="modal-title h6">Are you sure you want to delete <span
                                        class="text-info">"{{$work->company}}"</span> from your profile?
                                </h6>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm text-white px-5"
                                        data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                                <button type="button" class="btn btn-green btn-sm deleteWork px-5"
                                        data-dismiss="modal" data-id="{{$work->id}}"><i
                                        class="fas fa-check-circle"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @empty
            <h4 class="text-center">No Work Posted</h4>
        @endforelse
    </div>

    {{--addWORK Modal Display --}}
    @if(auth()->user()->role == 2)
        <div class="modal fade" id="addWork{{$user->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Works and Experiences</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-level-up-alt"></i>&nbsp;Position</span>
                            </div>
                            <input type="text" id="addPosition" class="form-control" name="position"
                                   placeholder="Ex: Senior dev">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-building"></i>&nbsp;Company</span>
                            </div>
                            <input type="text" id="addCompany" class="form-control" name="company"
                                   placeholder="Ex: CodeAlchemy ptv ltd">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar"></i>&nbspYear</span>
                            </div>
                            <input type="number" id="addYear" class="form-control" name="year"
                                   placeholder="Ex: 2011">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i
                                class="fas fa-times-circle"></i></button>
                        <button type="submit" class="btn btn-green btn-sm addWorkButton"><i
                                class="fas fa-check-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
