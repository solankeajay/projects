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

    <form class="row" action="./AddSubject" method="POST">
        @csrf
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Add Subject</h3>
        </div>
        <hr>
        <div class="col-5 mt-2">
            <label for="subject_title" class="form-label">Subject Title</label>
            <input type="text" name="subject_title" value="{{old('subject_title')}}" placeholder="Subject Title" class="form-control" id="subject_title">
        </div>

        <div class="col-12 mt-2">
            <label for="class_id" class="form-label">Class</label>
            @if($class->count() > 0 )
            <select class="form-select" name="class_id" aria-label="Default select example" id="class_id">
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@include("footer")