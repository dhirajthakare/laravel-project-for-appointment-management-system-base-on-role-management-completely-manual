<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advisor home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    option{ 
    background-color: color; 
    border-radius: value; 
    font-size: value 
}
</style>

</head>
<body>
    <div class="container">
       @include('comman.advisornavbar')
            <div class="m-3">

                    <h4> Appointment Status </h4>
        
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
                    <div id="changests" style="display: none" class="  alert alert-success">
                        status change successfully 
                        </div> 
                 </div>

                 <div>

                    <table class="table table-bordered table-striped table-hover text-center">

                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Booking Date</th>
                                <th>Number of Persons </th>
                                <th>Appointment Status</th>
                                {{-- <th>Action</th> --}}

                            </thead>
                            <tbody>
                                
                                
                                @foreach ($appointments as $appointment )
                                
                                <tr>
                                    <td> {{ucwords($appointment->Advisor->name)}} </td>
                                    <td> {{$appointment->Advisor->email}} </td>
                                    <td> {{$appointment->Advisor->mobile}} </td>
                                    <td> {{$appointment->bookingDate}} </td>
                                    <td> {{$appointment->noPerson}} </td>
                                    
                                         {{-- <form action="{{Route('update')}}" method="POST"> --}}
                                             <td>
                                                 {{-- @csrf --}}
                                                 {{-- <input type="hidden" name="token" value="{{$appointment->id}}"> --}}
                                                 @if ($appointment->status=="Approved" )
                                                     <h5 class="text-success"> Approved </h5>
                                                 @elseif ($appointment->status=="Declined")
                                                 <h5 class="text-danger"> Declined </h5>
                                                 @else
                                                 <select  class="form-select" data-style="btn-success" name="status" id="status" onchange="changeStatus({{$appointment->id}},this.value)">
                                            
                                                    @if ($appointment->status!="Waiting")
                                                    <option class="btn btn-warning" value="Waiting">Waiting</option>
                                                    @else 
                                                    <option class="btn btn-warning" value="Waiting" selected>Waiting</option>
                                                    @endif
    
                                                    @if ($appointment->status!="Declined")
                                                    <option class="btn btn-danger" value="Declined">Declined</option>
                                                    @else
                                                    <option class="btn btn-danger" value="Declined" selected>Declined</option>
                                                    @endif
    
                                                    @if ($appointment->status!="Approved")
                                                    <option class="btn btn-success" value="Approved">Approved</option>
                                                    @else
                                                    <option class="btn btn-success" value="Approved" selected>Approved</option>
                                                 @endif
        
                                                 </select>
                                                 @endif
                                            
                                            </td>
                                        

                                    {{-- <td> <button class="btn btn-warning" type="submit"> Change status </button> </td> --}}
                                         {{-- </form> --}}
                                </tr>
                                @endforeach
                                
                            </tbody>
                    </table>
                 </div>
                 
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

        
        function changeStatus(id,status){

        // var status = $('#status').val();
        // alert(status);

        $.ajax({
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        type:'POST',
        url:"{{Route('update')}}",
        data:{token:id, status:status},
        success:function(data){
        
        document.getElementById('changests').style.display='block';
        location.href = "{{Route('appointment')}} ";
    }
});

}
    </script>

</body>
</html>