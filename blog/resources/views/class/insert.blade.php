@include("header")
<div class="container p-5">

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems.
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="row" action="./AddClass" method="POST">
        @csrf
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Add Class</h3>
        </div>
        <hr>
        <div class="col-6 mt-2">
            <label for="Classname" class="form-label">Class Title</label>
            <input type="text" name="Class_title" value="{{old('Class_title')}}" placeholder="Class 1,Class 2 OR 1 , 2" class="form-control" id="Classname">
        </div>
        <div class="col-6 mt-2">
            <label for="class_code" class="form-label">Class Code</label>
            <input type="text" name="class_code" value="{{old('class_code')}}" placeholder="Class Code" class="form-control" id="class_code">
        </div>

        <div class="col-12 mt-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-dark" href="http://localhost/laravel/blog/public/Class">Cancel</a>
        </div>

    </form>

</div>

@include("footer")