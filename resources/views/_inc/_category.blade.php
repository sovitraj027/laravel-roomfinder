<h3 class="text-center title">Categories</h3>

<div class="row mb-3">
    <div class="container-fluid mx-5">
        <div class="card-group">

            @foreach ($categories as $category)

            <div class="card">
                <div class="card-body py-5">
                    <a href="{{route('category_room',$category->id)}}">    
                        <h5 class="card-title text-center">{{$category->name}}</h5>
                    </a>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>