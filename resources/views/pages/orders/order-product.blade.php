@extends('layouts.app')

@section('cont-head')
 <h1>
     Order Product Details #{{ $data['orderP']['id']}}
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Order Product</li>
    <li class="active">#{{ $data['orderP']['id']}}</li>
  </ol>
@endsection

@section('main-content')
	<section class="orderdetails">
		<div class="row">
			<div class="col-xs-12">
				<small class="pull-left">Date Created: {{date('F d, Y h:i:s', strtotime($data['order']['createdAt']))}}</small>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				Company: <b>{{ $data['order']['company']}} </b><br>
				Requestor: <b>{{ $data['order']['firstName']}} {{ $data['order']['lastName']}}</b> <br>
				Property Address: <b>{{ $data['order']['address1']}}, {{$data['order']['town']}}, {{$data['order']['zipcode']}}, Philippines </b><br>
				
			</div>
		</div>
		<hr>
		<b>Order Product Details </b><br><br>
		<div class="row">
			<div class="col-sm-4">
				{{ $data['orderP']['product']['name']}} <br>
				Price: &#8369 {{ $data['orderP']['price']}} <br>
				Quantity: {{ $data['orderP']['quantity']}}<br>
				Step: {{ $data['orderP']['step']}}<br>
				
			</div>
			<div class="col-sm-4"> <b>Status: </b> {{ $data['order']['status']}} <br>
			@if(!isset($data['orderP']['supplierUser']['name']))
			No Assignee Yet.
            @else 
            Assigned to: <b>{{$data['orderP']['supplierUser']['name']}}</b>
            @endif
            <br>
	            <div class="margin">
	                <div class="btn-group">
	                  <button type="button" class="btn btn-primary">Options</button>
	                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	                    <span class="caret"></span>
	                    <span class="sr-only">Toggle Dropdown</span>
	                  </button>
	                  <ul class="dropdown-menu" role="menu">
	                    <li><a href="javascript:void(0)" onclick="assignMember({{$data['orderP']['id']}})">Assign Member</a></li>
	                  </ul>
	                </div>
	            </div>
			</div>
		</div>

	</section>
@endsection