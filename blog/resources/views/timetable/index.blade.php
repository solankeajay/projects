@include("header")

@if(session()->get('user.position') != 'Student')
@include("subheader")
@endif

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
                <h1 class="admin-heading">All Data</h1>
            </div>
            @if(session()->get('user.position') == 'Admin')
            <div class="col-2">
                <a id="flex" class="btn btn-primary" href="./AddTimetable">Add Timetable</a>
            </div>
            @endif
            <div class="col-12">
                <table class="content-table">
                    <thead>
                        <th>Id</th>
                        <th>Class</th>
                        <th>Day</th>
                        <th>Subject</th>
                        <th>Subject Teacher</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Classromm Number</th>
                        @if(session()->get('user.position') == 'Admin')
                        <th>Edit</th>
                        <th>Delete</th>
                        @endif
                    </thead>
                    <tbody>
                        <?php
                        foreach ($timetable as $timetables) {
                        ?>
                            <tr>
                                <td><?= $timetables->id ?></td>
                                <td><?= $timetables->class_title ?></td>
                                <td><?= $timetables->day_title ?></td>
                                <td><?= $timetables->subject ?></td>
                                <td><?= $timetables->f_name . ' ' . $timetables->l_name ?></td>
                                <td><?= $timetables->start_time ?></td>
                                <td><?= $timetables->end_time ?></td>
                                <td><?= $timetables->classroom_number ?></td>
                                @if(session()->get('user.position') == 'Admin')
                                <td><a href="./EditTimetable/<?= $timetables->id ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="./DeleteTimetable/<?= $timetables->id ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                                @endif
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                {{ $timetable->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@include("footer")