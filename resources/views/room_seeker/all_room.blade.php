@extends('layouts.master')

@section('content')

<div class="container-fluid pl-3 pr-3">
    <div class="row">
        <div class="col-12 p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 nodecorationlist">
                    <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="breadcrumb-item active gray" aria-current="page">Search Room</li>
                </ol>
            </nav>
        </div>
    </div>

    @include('_partialstest._messages')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <label for="title" class="gray">City</label>
                                <select class="custom-select" name="city_id" id="city" onchange="selectCity(this);">
                                    <option value="0" disabled selected>Select City</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" id="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="title" class="gray">Place</label>
                                    <select class="custom-select" id="select_place">
                                        <option value="0" disabled selected>Select City First</option>
                                    </select>
                                    @foreach($cities as $city)
                                    <select class="places custom-select" name="place_id" id="{{'pid'.$city->id}}"
                                        style="display: none;">
                                        <option value="0" disabled selected>Select place</option>
                                        @foreach($city->places as $place)
                                        <option value="{{$place->id}}" id="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                    </select>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="title" class="gray">Category</label>
                                <select class="form-control float-right" name="category_id" id="category" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                    <option class="dropdown-item" type="button" value="{{$category->id}}"
                                        id="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select></div>

                            <div class="col-12 col-md-2">
                                <button class="btn btn-sm btn-info px-3" style="margin-top: 2.5em" type="submit"
                                    id="searchBtn">Search</button>
                            </div>
                        </div>

                    </div>

                    <div class="card-body mt-0">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-hover table-responsive-sm table-sm">
                                <thead class="bg-green">
                                    <tr>
                                        <th>Room</th>
                                        <th>City</th>
                                        <th>Location</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{$room->title}}</td>
                                        <td>{{$room->city->name}}</td>
                                        <td>{{$room->place->name}}</td>
                                        <td>{{$room->created_at}}</td>
                                        <td class="d-inline-flex">
                                            <a href="{{route('room.show',$room->id)}}" class="pt-1 pl-1"><i
                                                    class="far fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$rooms->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    window.sms =<?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;

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


        $(document).ready(function () {
            var cat_id = 0;
            var city_id = 0;
            var place_id = 0;

            $('#city').change(function () {
                city_id = $("#city option:selected").val();
            });

            $('#category').change(function () {
                cat_id = $("#category option:selected").val();
            });

          /*  $('.places').change(function () {
                place_id = $("#places option:selected").val();
                console.log('o->'+place_id)
            });*/

            $("select.places").change(function(){
                 place_id = $(this).children("option:selected").val();
            });


            $('#searchBtn').click(function () {
                $.ajax({
                    url: "{{route('ajax.all_room')}}",
                    type: 'POST',
                    data: {
                        _token: window.sms.csrfToken,
                        cityId: city_id,
                        placeId: place_id,
                        categoryId: cat_id
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success == true) {
                            let rooms = data.data;
                            console.log(rooms);
                            console.log(city_id,place_id,cat_id);
                            $.each(rooms, function (key, room) {

                                $("tbody tr").hide();
                                $.each(rooms, function (key, room) {

                                    var my_row = $('<tr>');
                                    console.log(room)
                                    var resulttag = '<td>' + room.title + '</td>' +
                                        '<td>' + room.city.name + '</td>' +
                                        '<td>' + room.place.name + '</td>' +
                                        '<td>' + room.created_at + '</td>' +
                                        '<td class="d-inline-flex">' +
                                        '<a href="/room/show/' + room.id +'"'+ 'class="pt-1 pl-1""><i class="far fa-eye"></i></a>'
                                        + '</td>';

                                    resulttag +='<td>';

                                    var resultstag = '<span>' + this.title + ' </span>' +
                                        '<span>' + this.id + ' </span>';

                                    my_row.html(resulttag);
                                    $("#myTable tbody").append(my_row);

                                });
                            });
                        }
                    }
                });
            });



        });


</script>
@endsection