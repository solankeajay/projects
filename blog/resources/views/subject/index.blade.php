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
                <h1 class="admin-heading">All Subject</h1>
            </div>
            @if(session()->get('user.position') == 'Admin')
            <div class="col-2">
                <a id="flex" class="btn btn-primary" href="./AddSubject">Add Subject</a>
            </div>
            @endif
            <div class="col-12">
                <table class="content-table">
                    <thead>
                        <th>Id</th>
                        <th>Class</th>
                        <th>Subject Name</th>
                        <th>Subject Teacher</th>
                        @if(session()->get('user.position') == 'Admin')
                        <th>Edit</th>
                        <th>Delete</th>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($subject as $subjects)
                        <tr>
                            <td>{{ $subjects->id }}</td>
                            <td>{{ $subjects->class_title }}</td>
                            <td>{{ $subjects->subject_name }}</td>
                            <td>{{ $subjects->f_name .' '. $subjects->l_name}}</td>
                            @if(session()->get('user.position') == 'Admin')
                            <td><a href="./EditSubject/{{ $subjects->id }}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="./DeleteSubject/{{ $subjects->id }}"><i class="fa-solid fa-trash-can"></i></a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $subject->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@include("footer")