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
                <h1 class="admin-heading">All Class</h1>
            </div>
            @if(session()->get('user.position') == 'Admin')
            <div class="col-2">
                <a id="flex" class="btn btn-primary" href="./AddClass">Add Class</a>
            </div>
            @endif
            <div class="col-12">
                <table class="content-table">
                    <thead>
                        <th>Class Title</th>
                        <th>Class Code</th>
                        <th>Student Amount</th>
                        <th>Attendance</th>
                        @if(session()->get('user.position') == 'Admin')
                        <th>Edit</th>
                        <th>Delete</th>
                        @endif
                    </thead>

                    <tbody>
                        @foreach ($class as $clas)
                        <tr>
                            <td> <a style="text-decoration: none;" href="./ClassDetails/{{$clas->id}}"> {{ $clas->class_title }}</a></td>
                            <td>{{ $clas->class_code }}</td>
                            <td>{{ $clas->total_student }}</td>
                            <td>{{ $clas->attendance }}</td>
                            @if(session()->get('user.position') == 'Admin')
                            <td><a href="./EditClass/{{ $clas->id }}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="./DeleteClass/{{ $clas->id }}"><i class="fa-solid fa-trash-can"></i></a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $class->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@include("footer")