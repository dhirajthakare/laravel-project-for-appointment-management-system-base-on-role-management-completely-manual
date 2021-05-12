<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    
    <div class="container" style="margin-top:15px;">
        
      @include('comman..navbar') 
        
        <div class="col-4 offset-4 card p-5"  style="margin-top:45px">
                <h4>Login Here</h4><br>
                <form action="{{route('auth.check')}}" method="POST">

                    @if (Session::get('fail'))
                        
                    <div class="alert alert-danger alert">
                        {{Session::get('fail')}}
                    </div>
                        
                    @endif
                    <div class="form-group">
                        @csrf
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" value="{{old('email')}}">
                        <span class="text-danger"> @error('email'){{$message}}@enderror </span>

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="text-danger"> @error('password'){{$message}}@enderror </span>

                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary form-control">Submit </button>
                    </div>
                    <br>
                    <span><a href="{{ route('auth.register')}}"> If You Don't Have Account Then Create Account .. </a></span>
                </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>