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

    <form class="row" action="./AddTimetable" method="POST">
        @csrf
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Add Timetable</h3>
        </div>
        <hr>

        <div class="col-3 mt-2">
            <label for="class" class="form-label">Class</label>

            <input type="hidden" name="c_id" value="{{ request()->route('id') }}">
            @if($class->count() > 0 )
            <select class="form-select" name="class" aria-label="Default select example" id="class" onchange="location = this.value;">
                <option value="" {{ ($c_id) == '' ? 'selected' : 'disabled' }}>Select Class</option>
                @foreach ($class as $class)
                @if($c_id == '')
                <option value="{{ route('AddTimetable', [$class->id]) }}"> {{ $class->class_title }} </option>
                @elseif( count($subject) == 0)
                <option selected value="{{ route('AddTimetable', [$class->id]) }}"> {{ $class->class_title }} </option>
                @else
                <option {{ ($class->id) == ($subject[0]['class_id']) ? 'selected' : '' }} value="{{ route('AddTimetable', [$class->id]) }}"> {{ $class->class_title }} </option>
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
        <div class="col-3 mt-2">
            <label for="day" class="form-label">Day</label>
            <select class="form-select" name="day" aria-label="Default select example" id="day">
                <option value="" selected>Select Day</option>
                <!-- <option  value="Sunday">Sunday</option> -->
                <option {{old('day') == 'Monday' ? 'selected' : ''}} value="Monday">Monday</option>
                <option {{old('day') == 'Tuesday' ? 'selected' : ''}} value="Tuesday">Tuesday</option>
                <option {{old('day') == 'Wednesday' ? 'selected' : ''}} value="Wednesday">Wednesday</option>
                <option {{old('day') == 'Thursday' ? 'selected' : ''}} value="Thursday">Thursday</option>
                <option {{old('day') == 'Friday' ? 'selected' : ''}} value="Friday">Friday</option>
                <option {{old('day') == 'Saturday' ? 'selected' : ''}} value="Saturday">Saturday</option>
            </select>
        </div>
        <div class="col-3 mt-2">
            <label for="subject" class="form-label">Subject</label>
            @if(count($subject) > 0 )
            <select class="form-select" name="subject" aria-label="Default select example" id="subject">
                <option value="" selected>Select Subject</option>
                @foreach ($subject as $subject)
                <option {{old('subject') == $subject['subject_id'] ? 'selected' : ''}} value="{{ $subject['subject_id'] }}">{{ $subject['subject_name'] }}</option>
                @endforeach
            </select>
            @else
            <select disabled class="form-select" name="subject" aria-label="Default select example" id="subject">
                <option selected>No Subject Available</option>
            </select>
            <span>Please Add Subject <a href="./AddSubject">here</a></span>
            @endif
        </div>
        <div class="col-3 mt-2">
            <label for="teacher" class="form-label">Teachers</label>
            @if($teacher->count() > 0 )
            <select class="form-select" name="teacher" aria-label="Default select example" id="teacher">
                <option value="" selected>Select Teacher</option>
                @foreach ($teacher as $teacher)
                <option {{old('teacher') == $teacher->id ? 'selected' : ''}} value="{{ $teacher->id }}">{{ $teacher->f_name .' '. $teacher->l_name }}</option>
                @endforeach
            </select>
            @else
            <select disabled class="form-select" name="teacher" aria-label="Default select example" id="teacher">
                <option selected>No Teachers Available</option>
            </select>
            <span>Please Add Teacher <a href="./AddTeacher">here</a></span>
            @endif
        </div>

        <div class="col-3 mt-2">
            <label for="start_time" class="form-label">Start time</label>
            <input type="time" name="start_time" value="{{old('start_time')}}" placeholder="start time" class="form-control" id="start_time">
        </div>

        <div class="col-3 mt-2">
            <label for="end_time" class="form-label">End time</label>
            <input type="time" name="end_time" value="{{old('end_time')}}" placeholder="end time" class="form-control" id="end_time">
        </div>

        <div class="col-3 mt-2">
            <label for="class_no" class="form-label">Class No</label>
            <input type="text" name="class_no" value="{{old('class_no')}}" placeholder="Class No" class="form-control" id="class_no">
        </div>

        <div class="col-12 mt-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@include("footer")