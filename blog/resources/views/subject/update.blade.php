@include("header")


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
<div class="container p-5">

    <form class="row" action="{{ route('UpdateSubject') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $subject->id }}">
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Add Subject</h3>
        </div>
        <hr>
        <div class="col-5 mt-2">
            <label for="subject_title" class="form-label">Subject Title</label>
            <input type="text" name="subject_title" value="{{ $subject->subject_name }}" placeholder="Subject Title" class="form-control" id="subject_title">
        </div>

        <div class="col-12 mt-2">
            <label for="class_id" class="form-label">Class</label>
            @if($class->count() > 0 )
            <select class="form-select" name="class_id" aria-label="Default select example" id="class_id">
                <option>Select Class</option>
                @foreach ($class as $class)
                @if($class->id == $subject->class_id)
                <option selected value="{{ $class->id }}">{{ $class->class_title }}</option>
                @else
                <option value="{{ $class->id }}">{{ $class->class_title }}</option>
                @endif
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