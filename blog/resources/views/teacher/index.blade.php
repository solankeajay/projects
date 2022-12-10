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
                <a id="flex" class="btn btn-primary" href="./AddTeacher">Add Teacher</a>
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
                        @if(session()->get('user.position') == 'Admin')
                        <th>Edit</th>
                        <th>Delete</th>
                        @endif
                    </thead>
                    <tbody>
                        <?php
                        foreach ($teacher as $teachers) {
                        ?>
                            <tr>
                                <td><?= $teachers->id ?></td>
                                <td><?= $teachers->f_name . " " . $teachers->l_name ?></td>
                                <td><?= $teachers->gander ?></td>
                                <td><?= $teachers->email ?></td>
                                <td><?= $teachers->address ?></td>
                                <td><?= $teachers->DOB ?></td>
                                <td><?= $teachers->mobile_number ?></td>
                                <td><?= $teachers->category ?></td>
                                @if(session()->get('user.position') == 'Admin')
                                <td><a href="./EditTeacherData/<?= $teachers->id ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="./DeleteTeacherData/<?= $teachers->id ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                                @endif
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                {{ $teacher->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@include("footer")