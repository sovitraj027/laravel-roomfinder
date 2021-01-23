@extends('layouts.master')

@section('content')

    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item green"><a href="{{route('room.index')}}" class="green">All Room</a>
                        </li>
                        <li class="breadcrumb-item active gray" aria-current="page">Create Room</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('_partialstest._messages')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row welcomecard">
                                <div class="col-12">
                                    <h5 class="pb-2">Add Room Details</h5>

                                    <form class="custom-hover" action="{{route('room.store')}}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="title" class="gray">Title</label>
                                                    <input type="text" class="form-control" id="title" required
                                                           placeholder="Great Room Available here"
                                                           name="title" value="{{old('title')}}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="title" class="gray">City</label>
                                                    <select class="custom-select" name="city_id" id="city"
                                                            onchange="selectCity(this);">
                                                        <option value="0" disabled selected>Select City</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}"
                                                                    id="{{$city->id}}">{{$city->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="title" class="gray">Place</label>
                                                    <select class="custom-select" id="select_place">
                                                        <option value="0" disabled selected>Select City First</option>
                                                    </select>
                                                    @foreach($cities as $city)
                                                        <select class="places custom-select" name="place_id"
                                                                id="{{'pid'.$city->id}}"
                                                                style="display: none;">
                                                            <option value="0" disabled selected>Select place</option>
                                                            @foreach($city->places as $place)
                                                                <option value="{{$place->id}}"
                                                                        id="{{$place->id}}">{{$place->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="price" class="gray">Price</label>
                                                    <input type="number" class="form-control" id="price" required
                                                           placeholder="Rs. 5000"
                                                           name="price" value="{{old('price')}}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="total_rooms" class="gray">Total Number of Room</label>
                                                    <input type="number" class="form-control" id="total_rooms" required
                                                           placeholder="5"
                                                           name="total_rooms" value="{{old('total_rooms')}}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="category" class="gray">Select Room Type</label>
                                                    <select class="custom-select" name="category_id" id="category">
                                                        <option disabled selected>Select Category</option>
                                                        @foreach($categories as $categories)
                                                            <option value="{{$categories->id}}"
                                                                    id="{{$categories->id}}">{{$categories->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12 p-2">
                                                <div class="form-group">
                                                    <label for="article-ckeditor" class="gray">Description</label>
                                                    <textarea class="form-control" id="article-ckeditor"
                                                              name="description" rows="3"
                                                              required>{{old('description')}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="room_images" class="gray">Upload
                                                                Images of Your Rooms</label><br>
                                                            <input type="file" name="images[]"
                                                                   class="btn form-control pt-0 pl-0"
                                                                   id="room_images" multiple accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="role" class="gray">Facilities</label>
                                                    <br>
                                                    @foreach($facilities as $facility)
                                                        <div class="form-check form-check-inline">
                                                            <input class="custom-checkbox form-check-input "
                                                                   name="facilities[]" type="checkbox"
                                                                   id="{{$facility->name}}" value="{{$facility->id}}">
                                                            <label class="form-check-label"
                                                                   for="{{$facility->name}}">{{$facility->name}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pl-3">
                                            <div class="col-12 ">
                                                <button type="submit" id="checkBtn" class="btn btn-green float-right">
                                                    Create
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
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
        function selectCity(city) {
            //Not displaying places before selecting city
            places = document.getElementsByClassName('places');
            for (var i = 0; i < places.length; i++) {
                places[i].style.display = "none";
            }
            //city is selected
            if (city) {
                //(first/default) select is removed
                document.getElementById('select_place').style.display = "none";
            }
            //places according to city is displayed
            document.getElementById('pid' + city.value).setAttribute("name", "place_id")
            document.getElementById('pid' + city.value).style.display = "block";
        }
    </script>

    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>
@endsection
