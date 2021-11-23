@extends('layouts.master')
@section('css')
	<link rel="stylesheet" href="/css/index.css">
@endsection
@include('layouts.header')
@section('body')
   <div class="row">
    <div class="col-md-12">
      <form action="" method="POST">
        <h1> Send Api </h1>
        
        <fieldset>  
          <a href="javascript::void(0)" target="popup" onclick="window.open('https://auth.tdameritrade.com/auth?response_type=code&redirect_uri=https://App_bearer.localhost/callback&client_id=DGHJRW6FSYTBG15MSPLMEW4VKXKPM0GW%40AMER.OAUTHAP','name','width=600,height=400')">Set api</a>
         
             <div class="form-group" style="margin-top: 20px">
              <label >Account</label>
                <select  class="form-control " name="category" id ="select_change">
                    <option selected>Select All account</option>
                    @foreach($user as $s)
                        <option data-name ="{{$s['name']}}" data-access_token="{{$s['remember_token']}}">{{$s['name']}}</option>
                    @endforeach
                </select>
                 
              </div>
          
         </fieldset>
       
        <button type="submit" id="getInfo">Get Info</button>
        
       </form>
        </div>
      </div>

@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <script type="text/javascript">
         $(document).ready(function(){
           $('#select_change').change(function(){
              name = $(this).children('option:selected').attr('data-name');
              remember_token = $(this).children('option:selected').attr('data-access_token');
              console.log(remember_token);
             
            });

           $('#getInfo').click(function(e) {
             e.preventDefault();
              name = $('#select_change').children('option:selected').attr('data-name');
              remember_token =$('#select_change').children('option:selected').attr('data-access_token');
                 $.ajax({
                    url: "{{route('listAccount')}}",
                    method: 'GET',
                    data: {
                      name: name,
                      remember_token :remember_token,
                    },
                     error: function() {
                      alert("lỗi");
                    },
                    success: function(data) {
                      console.log(data);
                   
                    }
              });
           });


            
            
              

          });
       </script> 
@endsection