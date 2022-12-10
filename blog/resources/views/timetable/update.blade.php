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

    <form class="row" action="{{ route('UpdateTimetable') }}" method="POST">
        @csrf
        <div class="col-12 d-flex justify-content-center">
            <h3 class="admin-heading">Add Timetable</h3>
        </div>
        <hr>
        <input type="hidden" name="id" value="{{ $routine->id }}">
        <div class="col-3 mt-2">
            <label for="day" class="form-label">Day</label>
            <select class="form-select" name="day" aria-label="Default select example" id="day">
                <option {{ ($routine->day) == '' ? 'selected' : '' }} value="" disabled>Select Day</option>
                <!-- <option  value="Sunday">Sunday</option> -->
                <option {{ ($routine->day_title) == 'Monday' ? 'selected' : '' }} value="Monday">Monday</option>
                <option {{ ($routine->day_title) == 'Tuesday' ? 'selected' : '' }} value="Tuesday">Tuesday</option>
                <option {{ ($routine->day_title) == 'Wednesday' ? 'selected' : '' }} value="Wednesday">Wednesday</option>
                <option {{ ($routine->day_title) == 'Thursday' ? 'selected' : '' }} value="Thursday">Thursday</option>
                <option {{ ($routine->day_title) == 'Friday' ? 'selected' : '' }} value="Friday">Friday</option>
                <option {{ ($routine->day_title) == 'Saturday' ? 'selected' : '' }} value="Saturday">Saturday</option>
            </select>
        </div>
        <div class="col-3 mt-2">
            <label for="subject" class="form-label">Subject</label>
            @if($subject->count() > 0 )
            <select class="form-select" name="subject" aria-label="Default select example" id="subject">
                <option {{ ($routine->subject) == '' ? 'selected' : '' }} disabled value="">Select Subject</option>
                @foreach ($subject as $subject)
                <option {{ ($routine->subject) == $subject->subject_name ? 'selected' : '' }} value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>
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
                <option disabled value="">Select Teacher</option>
                @foreach ($teacher as $teacher)
                <option {{ ($routine->subject_teacher) == $teacher->id ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->f_name .' '. $teacher->l_name }}</option>
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
            <input type="time" name="start_time" value="{{ $routine->start_time }}" placeholder="start time" class="form-control" id="start_time">
        </div>

        <div class="col-3 mt-2">
            <label for="end_time" class="form-label">End time</label>
            <input type="time" name="end_time" value="{{ $routine->end_time }}" placeholder="end time" class="form-control" id="end_time">
        </div>

        <div class="col-3 mt-2">
            <label for="class_no" class="form-label">Class No</label>
            <input type="text" name="class_no" value="{{ $routine->classroom_number }}" placeholder="Class No" class="form-control" id="class_no">
        </div>

        <div class="col-12 mt-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@include("footer")