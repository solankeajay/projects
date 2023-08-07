
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">   
     
 
</head>
<body>
    <div class="user-table">
        <div class="container">

            <div class="d-flex justify-content-end">
                <a href="{{url('logout')}}" class="btn btn-primary justify-content-end">Logout</a>
            </div>
            
            <div class="row">
    
                <div class="col-12">
    
                    <table class="table">
                
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">UserName</th>
                                <th scope="col">Image</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($users))
                                
                            @foreach ($users as $user)
                                
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td><img src="{{ asset('storage/user_img/'. $user->image ) }}" alt="" width="56px" srcset=""></td>
                                <td><a href="{{ url('editUser/'. $user->id) }}">Edit</a></td>
                                <td><a href="{{ url('delete/'. $user->id) }}">Delete</a></td>
                            </tr>
                            
                            @endforeach
                                
                            @else

                            <span>No Data avelible</span>
                                
                            @endif
                        </tbody>
                    </table>
                </div>
    
            </div>
        </div>
    </div>

</div>

     
</body>
</html>