<div class="container"> 
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Trang chủ</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">API</a></li>
        @if(Auth::check())
          <li><a href=""></a>{{Auth::user()->name}}</li>
          <li><a href=""></a>Đăng xuất</li>
         @endif
        <li><a href="#">Login</a></li>
       
      </ul>
    </div>
  </nav>
</div>