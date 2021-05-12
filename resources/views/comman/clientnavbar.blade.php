<div class=" card " style="margin-top: 45px">
<div class="pt-3">
    <div  class=" float-left p-1">
        <a href="/upload/{{$LoggedUserInfo['image']}}"><img style="height:60px;width:60px;object-fit: cover; border-radius:30px" src="/upload/{{$LoggedUserInfo['image']}}" alt="LOGo"></a>
    </div>
    <div class="nav-item dropdown float-right">
        <h6 class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Client {{ $LoggedUserInfo['name'] }}</h6>
        <div class="dropdown-menu">
            <a href="{{route('/')}}" class="dropdown-item" >Home </a>
            <a href="{{route('dashboard')}}" class="dropdown-item" >Dashboard </a>
            <a href="{{route('appointment')}}" class="dropdown-item" >Take a Appointment </a>
            <a href="{{route('appointmentInfo')}}" class="dropdown-item" >Yours Appointments </a>
          <a class="dropdown-item" >{{ $LoggedUserInfo['name'] }} </a>
          <a class="dropdown-item" >{{ $LoggedUserInfo['email'] }}</a>
          <a href="{{route('client.edit')}}" class="dropdown-item" >Update Profile</a>
          <a class="dropdown-item" onclick="return confirm('Are you sure ?')" href="{{route('auth.logout')}}">Logout </a>
          
    </div>
</div>
<h4 class="text-center ">Client Dashboard</h4>
</div>
</div>