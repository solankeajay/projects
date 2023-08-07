
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

    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-4">
                    <div class="bg-white shadow rounded">
                        <div class="">
                            <div class="">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="{{url('/user_update')}}" class="row g-4" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="uid" value="{{$user['id']}}">
                                        <div class="col-12">
                                            <label>Name<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user['name']}}" placeholder="Enter Full Name" required>
                                            </div>
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label>Username<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user['email']}}" placeholder="Enter Username" required>
                                            </div>
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label>User Image<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                            </div>
                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <img src="{{ asset('storage/user_img/'. $user['image'] ) }}" alt="" width="280px" srcset="">
                                            <input type="hidden" name="old_image" value="{{$user['image']}}">
                                        </div>

                                        <div class="col-sm-4">
                                         
                                        </div>

                                        <div class="col-sm-8">
                                           
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">Submit</button>
                                            <a href="{{url('/dashboard')}}" class="btn btn-primary px-4 mt-4">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
     
</body>
</html>