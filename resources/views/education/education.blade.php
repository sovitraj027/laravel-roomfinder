{{-- ***********************************  EDUCATION DISPLAY SECTION ************************************   --}}

<div class="card">
    <div class="card-header">
        <h5 class="green d-inline-block">Education</h5>
        @if(auth()->user()->role == 2)
            {{--WORK Modal Button --}}
            <button type="button" class="btn btn-sm btn-default float-right"
                    data-toggle="modal"
                    data-target="#addEducation{{$user->id}}">
                <i class="fas fa-plus green"></i> <span
                    class="green h6">Add Education</span>
            </button>
        @endif
    </div>

    <div class="card-body">
        @forelse($educations as $education)
            @if(auth()->user()->role == 2)
                <p class="float-right text-danger">
                    <i class="fas fa-trash-alt" data-toggle="modal"
                       data-target="#deleteEducation{{$education->id}}"
                       data-id="{{$education->id}}"></i>
                </p>
                <p class="float-right text-info mr-4">
                    <i class="fas fa-pencil-alt" data-toggle="modal"
                       data-target="#editEducation{{$education->id}}"
                       data-id="{{$education->id}}"></i>
                </p>
            @endif
            <h5 class="h5 text-dark "><i class="fas fa-graduation-cap"></i>&nbsp;Course/Level:
                <b>{{$education->course}}</b></h5>
            <h5 class="h5 text-dark"><i class="fas fa-synagogue"></i>&nbsp;Institution:
                <b>{{$education->institution}}</b></h5>
            <h5 class="h5 mb-2 text-dark"><i class="fas fa-calendar"></i>&nbsp;
                Completed Year:
                <b>{{ $education->completed_year }}</b></h5>
            <hr>

            {{--delete Education Modal Display --}}
            @if(auth()->user()->role == 2)
                <div class="modal fade" id="deleteEducation{{$education->id}}">
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
                                <h6 class="modal-title h6">Are you sure you want to delete
                                    <span
                                        class="text-info">"{{$education->course}}"</span>
                                    from your
                                    profile?</h6>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-danger btn-sm text-white px-5"
                                        data-dismiss="modal"><i
                                        class="fas fa-times-circle"></i></button>
                                <button type="button"
                                        class="btn btn-green btn-sm deleteEducation px-5"
                                        data-dismiss="modal" data-id="{{$education->id}}"><i
                                        class="fas fa-check-circle"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            {{--editWORK Modal Display --}}
            @if(auth()->user()->role == 2)
                <div class="modal fade" id="editEducation{{$education->id}}" tabindex="-1"
                     role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Works and
                                    Experiences
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
                                                                class="fas fa-graduation-cap"></i>&nbsp;Course</span>
                                    </div>
                                    <input type="text" id="editCourse" class="form-control"
                                           name="position" value="{{ $education->course }}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-synagogue"></i>&nbsp;Institution</span>
                                    </div>
                                    <input type="text" id="editInstitution"
                                           class="form-control"
                                           name="company"
                                           value="{{ $education->institution }}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-calendar"></i>&nbsp; Completed Year</span>
                                    </div>
                                    <input type="text" id="editCompletedyear"
                                           class="form-control"
                                           name="year"
                                           value="{{ $education->completed_year }}">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal"><i
                                        class="fas fa-times-circle"></i></button>
                                <button type="submit"
                                        class="btn btn-green btn-sm editEducationButton"
                                        data-id="{{$education->id}}"><i
                                        class="fas fa-check-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @empty
            <h4 class="text-center">No Education posted</h4>
        @endforelse

    </div>

    {{--addEducation Modal Display --}}
    @if(auth()->user()->role == 2)
        <div class="modal fade" id="addEducation{{$user->id}}" tabindex="-1" role="dialog"
             aria-labelledby="EducationModel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EducationModel">Add Education</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-graduation-cap"></i>&nbsp;Course/Level</span>
                            </div>
                            <input type="text" id="addCourse" class="form-control"
                                   name="course"
                                   placeholder="Ex: CSIT, Grade 10" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-synagogue"></i>&nbsp;Institution</span>
                            </div>
                            <input type="text" id="addInstitution" class="form-control"
                                   name="institution" placeholder="Ex: Caltech ">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar"></i>&nbspCompleted Year</span>
                            </div>
                            <input type="number" id="addCompletedyear" class="form-control"
                                   name="year" placeholder="Ex: 2011" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm"
                                data-dismiss="modal"><i
                                class="fas fa-times-circle"></i></button>
                        <button type="submit"
                                class="btn btn-green btn-sm addEducationButton"><i
                                class="fas fa-check-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


{{--  END OF EDUCATION SECTION  --}}
