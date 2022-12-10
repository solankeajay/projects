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

    <form class="row" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $student->id }}">
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Update Student Data</h3>
        </div>
        <hr>
        <div class="col-4 mt-2">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" name="fname" value="{{ $student->f_name }}" placeholder="First Name" class="form-control" id="fname">
        </div>
        <div class="col-4 mt-2">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" name="lname" value="{{ $student->l_name }}" placeholder=" Last Name" class="form-control" id="lname">
        </div>
        <div class="col-4 mt-2">
            <label for="father name" class="form-label">Father Name</label>
            <input type="text" name="father_name" value="{{ $student->father_name }}" placeholder=" Father Name" class="form-control" id="father name">
        </div>
        <div class="col-4 mt-2">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" name="email" value="{{ $student->email }}" placeholder=" Email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-4 mt-2">
            <label for="mobile number" class="form-label">Mobile Number</label>
            <input type="text" name="mobile_number" value="{{ $student->mobile_number }}" placeholder=" Mobile Number" class="form-control" id="mobile number">
        </div>
        <div class="col-4 mt-2">
            <label for="address" class="form-label">Address</label>
            <textarea type="text" name="address" placeholder=" Address" class="form-control" id="address">{{ $student->address }}</textarea>
        </div>

        <div class="col-3 mt-2">
            <label for="dob" class="form-label">Date Of Birth</label>
            <input type="date" name="dob" value="{{ $student->DOB }}" class="form-control" id="dob">
        </div>

        <div class="col-2 mt-2">
            <label for="Category" class="form-label">Category</label>
            <select class="form-select" name="category" aria-label="Default select example" id="Category">
                <option {{ ($student->category) == '' ? 'selected' : '' }}>Select Category</option>
                <option {{ ($student->category) == 'General' ? 'selected' : '' }} value="General">General</option>
                <option {{ ($student->category) == 'Sebc' ? 'selected' : '' }} value="Sebc">Sebc</option>
                <option {{ ($student->category) == 'Sc' ? 'selected' : '' }} value="Sc">Sc</option>
                <option {{ ($student->category) == 'St' ? 'selected' : '' }} value="St">St</option>
            </select>
        </div>
        <div class="col-2 mt-2">
            <label for="class" class="form-label">Class</label>
            <select class="form-select" name="class" aria-label="Default select example" id="class">
                <option {{ ($student->class) == '' ? 'selected' : '' }}>Select Class</option>
                <option {{ ($student->class) == '1' ? 'selected' : '' }} value="1">1</option>
                <option {{ ($student->class) == '2' ? 'selected' : '' }} value="2">2</option>
                <option {{ ($student->class) == '3' ? 'selected' : '' }} value="3">3</option>
                <option {{ ($student->class) == '4' ? 'selected' : '' }} value="4">4</option>
                <option {{ ($student->class) == '5' ? 'selected' : '' }} value="5">5</option>
                <option {{ ($student->class) == '6' ? 'selected' : '' }} value="6">6</option>
                <option {{ ($student->class) == '7' ? 'selected' : '' }} value="7">7</option>
                <option {{ ($student->class) == '8' ? 'selected' : '' }} value="8">8</option>
                <option {{ ($student->class) == '9' ? 'selected' : '' }} value="9">9</option>
                <option {{ ($student->class) == '10' ? 'selected' : '' }} value="10">10</option>
            </select>
        </div>
        <div class="col-2 mt-2">
            <label for="gander" class="form-label">Gander</label>
            <select class="form-select" name="gander" aria-label="Default select example" id="gander">
                <option {{ ($student->gander) == '' ? 'selected' : '' }}>Select Gander</option>
                <option {{ ($student->gander) == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                <option {{ ($student->gander) == 'Female' ? 'selected' : '' }} value="Female">Female</option>
            </select>
        </div>
        <div class="col-3 mt-2">
            <label for="image" class="form-label">Student Image</label>
            <input type="file" name="newimg" class="form-control" id="image">
            <input type="hidden" name="old_image" value="{{ $student->student_image}}">
            <img src="http://localhost/laravel/blog/public/images/{{ $student->student_image}}" name="oldimg" alt="" height="150px">
        </div>
        <div class="col-12 mt-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@include("footer")