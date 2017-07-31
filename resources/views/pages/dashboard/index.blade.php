@extends('layouts.app')

@section('cont-head')
 <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
@endsection

@section('main-content')
<div class="box">
    <div class="box-body">
        <div class="col-md-12">
         	<div class="row">
	        	@if(!empty($data['orders']))
	        	 Orders Assigned to you <hr>
					@foreach($data['orders'] as $key => $value)
					 	<div class="col-lg-3 col-xs-6">
					      <!-- small box -->
					      	<div class="small-box bg-teal">
						        <div class="inner">
						          <h4>Order # {{$value['orderId']}}</h4>
						          <p>
						          	<b>{{$value['product']['name']}}</b> <br>
						          	&#8369 {{$value['price']}} <br>
						          	@if(!isset($value['supplierUser']['name']))
						          	No Employee Assigned
						          	@else 
						          	Assigned to: <b>{{$value['supplierUser']['name']}}</b>
						          	@endif
						          </p>
						        </div>
						        <div class="icon">
						          <i class="fa fa-shopping-cart"></i>
						        </div>
						        @if($data['isAdmin'])
							        <a href="{{url('order-product-details/'.$value['id'].'')}}" class="small-box-footer">
							          More info <i class="fa fa-arrow-circle-right"></i>
							        </a>
						        @else 
						        	<a href="{{url($value["link"])}}" class="small-box-footer">
							          More info <i class="fa fa-arrow-circle-right"></i>
							        </a>
						        @endif
					      	</div>
					    </div>
				    @endforeach
				@else
				<b>No orders assigned for you.</b>
				@endif
			</div>
        </div>
    </div>
</div>

@endsection
