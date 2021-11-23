@extends('layouts.master')
@section('css')
<style type="text/css">
   form {
    width: 300px;
    margin: 0 auto;
    display: block;
   }
</style>
@endsection
@section('body')
 

     <form action="{{route('next')}}" method="POST" role="form">  
      <input type="hidden" name="_token" value="{{csrf_token()}}">  
      <p>Nhấn để tiếp tục</p>
      <div class="form-group">
        <input type="hidden"  value="{{$data['access_token']}}" name="access_token" placeholder="Input field">
        <input type="hidden"  value="{{$data['refresh_token']}}" name="refresh_token" placeholder="Input field">
        <input type="hidden"  value="{{$data['scope']}}" name="scope" placeholder="Input field">
        <input type="hidden"  value="{{$data['expires_in']}}" name="expires_in" placeholder="Input field">
        <input type="hidden"  value="{{$data['refresh_token_expires_in']}}" name="refresh_token_expires_in" placeholder="Input field">
        <input type="hidden"  value="{{$data['token_type']}}" name="token_type" placeholder="Input field">

      </div>
      <button type="submit" class="btn btn-primary" id="next">Next</button>
    </form>
<script type="text/javascript">
    $('#next').click(function(){
        window.close(); 
    });
</script>
  
@endsection