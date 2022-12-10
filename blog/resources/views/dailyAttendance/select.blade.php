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

    <form class="row" action="./SelectClass" method="POST">
        @csrf
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Select Class For Attendance</h3>
        </div>
        <hr>

        <div class="col-12 d-flex justify-content-center">
            <label for="class_id" class="col-form-label p-2">Class</label>
            @if($class->count() > 0 )
            <select class="form-select" name="class_id" value="{{old('class_id')}}" aria-label="Default select example" id="class_id">
                <option selected>Select Class</option>
                @foreach ($class as $class)
                <option value="{{ $class->id }}">{{ $class->class_title }}</option>
                @endforeach
            </select>
            @else
            <select disabled class="form-select" name="class" aria-label="Default select example" id="class">
                <option selected>No Class Available</option>
            </select>
            <span>Please Add Class <a href="./AddClass">here</a></span>
            @endif
        </div>

        <div class="col-12 mt-5 d-flex justify-content-center">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@include("footer")