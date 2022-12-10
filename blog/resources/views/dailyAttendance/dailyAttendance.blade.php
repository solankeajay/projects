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

    <div class="col-12 d-flex justify-content-center">
        <h3 class="admin-heading">{{ $class->class_title }} Attendance Information</h3>
    </div>

    <hr>
    <form action="./AddAttendance" method="POST">
        @csrf
        <div id="admin-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="content-table">
                            <thead>
                                <div class="col-3 mt-2">
                                    <th>Action</th>
                                </div>
                                <div class="col-3 mt-2">
                                    <th>Role Number</th>
                                </div>
                                <div class="col-3 mt-2">
                                    <th>Name</th>
                                </div>
                                <div class="col-3 mt-2">
                                    <th>Date Of Birth</th>
                                </div>
                                <div class="col-3 mt-2">
                                    <th>Email</th>
                                </div>
                                <div class="col-3 mt-2">
                                    <th>Attendence %</th>
                                </div>
                                <div class="col-3 mt-2">
                            </thead>

                            <tbody>

                                @foreach ($student as $student)
                                <tr>
                                    <td><input type="checkbox" class="checkmark" name="action_{{$student->role_number}}" value="{{$student->id}}"></td>

                                    <td>{{ $student->role_number }}</td>

                                    <td>{{ $student->f_name .' '. $student->l_name }}</td>

                                    <td>{{ $student->DOB}}</td>

                                    <td>{{ $student->email}}</td>

                                    <td>0</td>

                                </tr>
                                <input type="hidden" name="s_id_{{$student->role_number}}" value="{{$student->id}}">
                                <input type="hidden" name="class_title" value="{{$student->class}}">
                                <input type="hidden" name="role_no_{{$student->role_number}}" value="{{$student->role_number}}">
                                @endforeach




                            </tbody>
                        </table>
                        <div class="col-12 mt-5 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

@include("footer")