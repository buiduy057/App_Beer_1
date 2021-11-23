@extends('layouts.master')
@section('css')

@endsection

@section('body')
    <div class="container">
     <div class="panel-heading">
          <h1 class="text-center">Options</h1>
      </div>
       <button type="button" class="btn btn-success " id="check"> <i class="fa fa-check" aria-hidden="true" style="margin-right: 5px;" ></i>Check</button>
    <div class="row" style="margin-top: 20px;">
       <div class="col-md-12">

                     <table class="table table-dark table-hover">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>VALUE</th>
                              <th>TYPE</th>
                              <th>DETAILS</th>
                              <th>SPOT</th>
                              <th>C/P</th>
                              <th>SPIKE</th>
                              <th>TIME</th>
                            </tr>
                          </thead>
                          <tbody class="tboby">
                            @foreach($options as $op)
                            <tr >
                              <td >{{$op['id']}}</td>
                              <td id="value" data-call="{{$op['c/p']}}" data-spot="{{$op['spot']}}" data-details ="{{$op['details']}}" data-type="{{$op['type']}}" data-value="{{$op['value']}}">$ {{$op['value']}}</td>
                              <td >{{$op['type']}}</td>
                              <td >{{$op['details']}}</td>
                              <td >{{$op['spot']}}</td>
                              <td >{{$op['c/p']}}</td>
                              <td >{{$op['spike']}}</td>
                              <td >{{$op['created_at']}}</td>
                            </tr>
                            @endforeach
                           
                          </tbody>
                        </table>

           
       </div>
    </div> 
    </div> 

@endsection
@section('scripts')
 <script src="https://code.jquery.com/jquery-3.2.1.js" ></script>
 <script type="text/javascript">
      $( "#check" ).click(function() {
        alert('ok');
        $.ajax({
              type: 'GET', //THIS NEEDS TO BE GET
              url: 'checkDate',
              success: function (data) {
                  console.log(data);
              },
              error: function() { 
                   console.log(data);
              }
          });
        //   $(".tboby").find('td#value').each((index, element) => {
        //     var dataCall = $(element).attr('data-call');
        //     var dataSpot = $(element).attr('data-spot');
        //     var dataDetails = $(element).attr('data-details');
        //     var dataType = $(element).attr('data-type');
        //     var $element = $(element).attr('data-value');
        //     var $eleLength =$element.length;
        //     var lastEle = String($element).substr($eleLength-1,$eleLength);
        //     var contentEle = String($element).substr(0,$eleLength-1);

        //     $data  = `${dataCall} ${dataSpot} ${dataDetails} ${dataType} ${$element}`;
        //     if(contentEle >= 500  && lastEle ==='K'){
        //        console.log($data);
        //     } else if(lastEle ==='M') {
        //       console.log($data);
        //     }
        // });
      });
      
 </script>
@endsection