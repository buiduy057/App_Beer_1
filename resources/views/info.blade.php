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

    
@endsection