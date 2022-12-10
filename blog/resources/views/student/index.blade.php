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

@if(session()->get('user.position') != 'Student')
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h1 class="admin-heading">All Data</h1>
            </div>
            @if(session()->get('user.position') == 'Admin')
            <div class="col-2">
                <a id="flex" class="btn btn-primary" href="./Add">Add Student</a>
            </div>
            @endif
            <div class="col-12">
                <table class="content-table">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Gander</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Date Of Birth</th>
                        <th>Phone</th>
                        <th>Category</th>
                        <th>Class</th>
                        @if(session()->get('user.position') == 'Admin')
                        <th>Edit</th>
                        <th>Delete</th>
                        @endif
                    </thead>
                    <tbody>
                        <?php
                        foreach ($student as $user) {
                        ?>
                            <tr>
                                <td><?= $user->sid ?></td>
                                <td><?= $user->f_name . " " . $user->l_name ?></td>
                                <td><?= $user->gander ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->address ?></td>
                                <td><?= $user->DOB ?></td>
                                <td><?= $user->mobile_number ?></td>
                                <td><?= $user->category ?></td>
                                <td><?= $user->class_title ?></td>
                                @if(session()->get('user.position') == 'Admin')
                                <td><a href="./edit/<?= $user->sid ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="./delete/<?= $user->sid ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                                @endif
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                {{ $student->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@else
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-9 pt-5 stuInfoTableBG">
                <div class="row">
                    <div class="col-md-12 profile-info">
                        <h1 class="teacherTitleFont">{{$student->f_name .' '. $student->l_name}}</h1>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Class
                                <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->class}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Roll Number <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->role_number}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Email <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->email}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Phone Number <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->mobile_number}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Date of Birth <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->DOB}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Gander <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->gander}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Father Name <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->father_name .' '. $student->l_name}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Address <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->address}}
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Category <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                {{$student->category}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</div>
@endif


@include("footer")