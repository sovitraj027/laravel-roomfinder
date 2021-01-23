<header>
    <nav class="navbar navbar-expand-lg  navbar-fixed">
        <a class="navbar-brand ml-2" href="#"><img src="./images/logo_raw.png" alt="logo" height="50px" width="50px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><img src="{{asset('app/images/icons/ham.png')}}" alt="ham" height="20px"
                    width=40px"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ml-auto">

                @auth
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link">Dashboard</a>
                </li>
                @else
                <li class="nav-item mx-2">
                    <a href="{{ route('login') }}" class="nav-link btn btn-sm btn-outline-info">Login</a>
                </li>

                @if (Route::has('register'))
                <li class="nav-item mx-2">
                    <a href="{{ route('register') }}" class="nav-link btn btn-sm btn-outline-primary">Register</a>
                </li>
                @endif
                @endauth
            </ul>

        </div>
    </nav>
</header>


<div class="hero mb-3">
    <form class="header-form " action="{{ route('search_room')}}" method="GET">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="city">City</label>
                <select class="custom-select" name="city_id" id="city" onchange="selectCity(this);">
                    <option value="0" disabled selected>Select City</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}" id="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-5">
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

        </div>
        <button type="submit" id="submit_btn" class="btn btn-sm buttons">Search</button>
    </form>
</div>




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
@endsection