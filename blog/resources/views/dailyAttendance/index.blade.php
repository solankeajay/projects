@include("header")
@include("subheader")

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
@if(session()->has('message-danger'))
<div class="alert alert-danger">
    {{ session()->get('message-danger') }}
</div>
@endif

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h1 class="admin-heading">All Attendance</h1>
            </div>
            @if(session()->get('user.position') == 'Teacher')
            <div class="col-2">
                <a id="flex" class="btn btn-primary" href="./SelectClass">Add Attendance</a>
            </div>
            @endif
            <div class="col-12">
                <table class="content-table">
                    <thead>
                        <th>Class</th>
                        <th>Date</th>
                        <th>Role Number</th>
                        <th>Student</th>
                        <th>Email</th>
                        <th>Attend Status</th>
                        <th>Teacher</th>
                        <th>Attendence %</th>
                    </thead>
                    <tbody>
                        @foreach ($attendance as $attendances)
                        <tr>
                            <td>{{ $attendances->class_title }}</td>
                            <td>{{ $attendances->date }}</td>
                            <td>{{ $attendances->role_no }}</td>
                            <td>{{ $attendances->student_name }}</td>
                            <td>{{ $attendances->email }}</td>
                            <td>{{ $attendances->present_or_absent }}</td>
                            <td>{{ $attendances->f_name .' '. $attendances->l_name }}</td>
                            <td>{{ $attendances->attend_amount_yearly }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $attendance->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@include("footer")