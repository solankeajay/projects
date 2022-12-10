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

    <form class="row" action="{{ route('UpdateTeacherData') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $teacher->id }}">
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Update teacher Data</h3>
        </div>
        <hr>
        <div class="col-4 mt-2">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" name="fname" value="{{ $teacher->f_name }}" placeholder="First Name" class="form-control" id="fname">
        </div>
        <div class="col-4 mt-2">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" name="lname" value="{{ $teacher->l_name }}" placeholder=" Last Name" class="form-control" id="lname">
        </div>
        <div class="col-4 mt-2">
            <label for="father name" class="form-label">Father Name</label>
            <input type="text" name="father_name" value="{{ $teacher->father_name }}" placeholder=" Father Name" class="form-control" id="father name">
        </div>
        <div class="col-4 mt-2">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" name="email" value="{{ $teacher->email }}" placeholder=" Email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-4 mt-2">
            <label for="mobile number" class="form-label">Mobile Number</label>
            <input type="text" name="mobile_number" value="{{ $teacher->mobile_number }}" placeholder=" Mobile Number" class="form-control" id="mobile number">
        </div>
        <div class="col-4 mt-2">
            <label for="address" class="form-label">Address</label>
            <textarea type="text" name="address" placeholder=" Address" class="form-control" id="address">{{ $teacher->address }}</textarea>
        </div>

        <div class="col-3 mt-2">
            <label for="dob" class="form-label">Date Of Birth</label>
            <input type="date" name="dob" value="{{ $teacher->DOB }}" class="form-control" id="dob">
        </div>

        <div class="col-2 mt-2">
            <label for="Category" class="form-label">Category</label>
            <select class="form-select" name="category" aria-label="Default select example" id="Category">
                <option {{ ($teacher->category) == '' ? 'selected' : '' }}>Select Category</option>
                <option {{ ($teacher->category) == 'General' ? 'selected' : '' }} value="General">General</option>
                <option {{ ($teacher->category) == 'Sebc' ? 'selected' : '' }} value="Sebc">Sebc</option>
                <option {{ ($teacher->category) == 'Sc' ? 'selected' : '' }} value="Sc">Sc</option>
                <option {{ ($teacher->category) == 'St' ? 'selected' : '' }} value="St">St</option>
            </select>
        </div>

        <div class="col-2 mt-2">
            <label for="gander" class="form-label">Gander</label>
            <select class="form-select" name="gander" aria-label="Default select example" id="gander">
                <option {{ ($teacher->gander) == '' ? 'selected' : '' }}>Select Gander</option>
                <option {{ ($teacher->gander) == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                <option {{ ($teacher->gander) == 'Female' ? 'selected' : '' }} value="Female">Female</option>
            </select>
        </div>
        <div class="col-3 mt-2">
            <label for="image" class="form-label">teacher Image</label>
            <input type="file" name="newimg" class="form-control" id="image">
            <input type="hidden" name="old_image" value="{{ $teacher->photo}}">
            <img src="http://localhost/laravel/blog/public/images/{{ $teacher->photo}}" name="oldimg" alt="" height="150px">
        </div>
        <div class="col-12 mt-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@include("footer")