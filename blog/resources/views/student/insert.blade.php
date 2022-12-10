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

    <form class="row" action="./Add" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Add Student Data</h3>
        </div>
        <hr>
        <div class="col-4 mt-2">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" name="fname" value="{{old('fname')}}" placeholder="First Name" class="form-control" id="fname">
        </div>
        <div class="col-4 mt-2">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" name="lname" value="{{old('lname')}}" placeholder="Last Name" class="form-control" id="lname">
        </div>
        <div class="col-4 mt-2">
            <label for="father name" class="form-label">Father Name</label>
            <input type="text" name="father_name" value="{{old('father_name')}}" placeholder="Father Name" class="form-control" id="father name">
        </div>
        <div class="col-4 mt-2">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-4 mt-2">
            <label for="inputpass" class="form-label">Password</label>
            <input type="password" name="password" value="{{old('password')}}" placeholder="Password" class="form-control" id="inputpass">
        </div>
        <div class="col-4 mt-2">
            <label for="mobile number" class="form-label">Mobile Number</label>
            <input type="text" name="mobile_number" value="{{old('mobile_number')}}" placeholder="Mobile Number" class="form-control" id="mobile number">
        </div>
        <div class="col-4 mt-2">
            <label for="address" class="form-label">Address</label>
            <textarea type="text" name="address" value="{{old('address')}}" placeholder="Address" class="form-control" id="address"></textarea>
        </div>

        <div class="col-4 mt-2">
            <label for="dob" class="form-label">Date Of Birth</label>
            <input type="date" name="dob" class="form-control" id="dob">
        </div>

        <div class="col-4 mt-2">
            <label for="Category" class="form-label">Category</label>
            <select class="form-select" name="category" aria-label="Default select example" id="Category">
                <option selected>Select Category</option>
                <option value="General">General</option>
                <option value="Sebc">Sebc</option>
                <option value="Sc">Sc</option>
                <option value="St">St</option>
            </select>
        </div>
        <!-- <div class="col-2 mt-2">
            <label for="class" class="form-label">Class</label>
            <select class="form-select" name="class" aria-label="Default select example" id="class">
                <option selected>Select Class</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div> -->
        <div class="col-4 mt-2">
            <label for="class" class="form-label">Class</label>
            @if($class->count() > 0 )
            <select class="form-select" name="class" aria-label="Default select example" id="class">
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
        <div class="col-4 mt-2">
            <label for="gander" class="form-label">Gander</label>
            <select class="form-select" name="gander" aria-label="Default select example" id="gander">
                <option selected>Select Gander</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="col-4 mt-2">
            <label for="image" class="form-label">Student Image</label>
            <input type="file" name="student_img" class="form-control" id="image">
        </div>
        <div class="col-12 mt-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@include("footer")