<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Dashbord</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" />

</head>
<body>
    <div class="container">
        @include('comman.clientnavbar')
            <div class="m-3">

                    <h4>Your Appointments </h4>
        
                 </div>
                 <div class="m-3">
                    @if (session('success'))

                    <div class="alert alert-success">
                        {{session('success')}}
                        </div>    
                    
                        @elseif (session('fail'))
                
                    <div class="alert alert-danger">
                        {{session('fail')}}
                        </div>    
                  
                        
                    @endif
                 </div>
        
                 <div>

                    <table class="table table-bordered table-striped table-hover text-center">

                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Booking Date</th>
                                <th>Number of Persons </th>
                                <th>Advisor</th>
                                <th>Appointment Status</th>
                                <th>Action</th>

                            </thead>
                            <tbody>
                                

                                @foreach ($appointments as $appointment )
                                
                                <tr>
                                    <td> {{ucwords($appointment->Client->name)}} </td>
                                    <td> {{$appointment->Client->email}} </td>
                                    <td> {{$appointment->Client->mobile}} </td>
                                    <td> {{$appointment->bookingDate}} </td>
                                    <td> {{$appointment->noPerson}} </td>
                                    <td> {{ucwords($appointment->Advisor->name)}} </td>
                                    
                                         @if ($appointment->status=="Declined")
                                            <td class=" text-danger">{{$appointment->status}}</td>
                                            @elseif ($appointment->status=="Waiting")
                                            <td class=" text-warning">{{$appointment->status}}</td>
                                            @elseif ($appointment->status=="Approved")
                                            <td class=" text-success">{{$appointment->status}}</td>
                                         @endif

                                    <td> <a onclick="return confirm('Are you sure ?')" href="delete/{{$appointment->id}}" style="text-decoration: none" class="text-danger" href="">Delete</a> </td>

                                </tr>
                                @endforeach
                                
                            </tbody>
                    </table>
                 </div>
    
    </div>
<script type='text/javascript' src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

</body>
</html>
