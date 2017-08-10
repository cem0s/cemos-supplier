@extends('layouts.app')

@section('cont-head')
 <h1>
    Floorplan
    <small>draw it</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Floorplan</li>
    <li class="active">Draw Floorplan</li>
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
				Step: {{ $data['orderP']['step']}}<br>
				
			</div>
			<div class="col-sm-4"> <b>Status: </b> {{ $data['order']['status']}} <br>
		    	Assigned to: <b>{{$data['orderP']['supplierUser']['name']}}</b>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-4">
				<b>Special Instructions/Comments</b><br><br>
				@if(isset($data['orderP']['data']['floorComments']))
					{{$data['orderP']['data']['floorComments']}}
				@endif
				
			</div>
			<div class="col-sm-4">
				<b>Preference Date</b><br><br>
				{{$data['orderP']['data']['preferenceDate']}}
			</div>
			<div class="col-sm-4">
				<b>Additional Info</b><br><br>
				@if($data['orderP']['data']['addFurniture'])
					<i class="fa fa-check"></i> Add Furniture <br>
				@endif
				@if($data['orderP']['data']['isMirroHor'])
					<i class="fa fa-check"></i> Mirror Horizontally <br>
				@endif
				@if($data['orderP']['data']['isMirrorVer'])
					<i class="fa fa-check"></i> Mirror Vertically <br>
				@endif
				@if($data['orderP']['data']['isSitePlan'])
					<i class="fa fa-check"></i> Add Situation Markings <br>
				@endif
				@if($data['orderP']['data']['is3D'])
					<i class="fa fa-check"></i> Add 3D Indication <br>
				@endif
			</div>
		</div>
		<hr>
		<b>Floors</b><br><br>
		<div class="row">
			@if((count($data['orderP']['data']['floors'])) > 0 && (count($data['files']) > 0))
				<?php 
					$count = 1;
				?>
				@foreach($data['orderP']['data']['floors'] as $key => $value)
					@foreach($data['files'] as $fkey => $fvalue)
						@if($key == $fkey)
						<div class="col-sm-4">
							<a class="fancybox" rel="group" href="{{url($fvalue)}}">
							<img src="{{$fvalue}}" width="200" height="200"></a> <br>
							<p>{{$value['floor_'.$count.'']}}</p>
						</div>
						@endif
					@endforeach
					<?php
					$count++;
					?>
				@endforeach
			@endif
		</div>
		<hr>
		<b>Draw Here</b><br><br>
		<div class="row">
			<div class="col-md-12" id="floorplan" style="height: 800px;">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form action="{{url('submit-floorplan')}}" method="POST">
					<input type="hidden" name="projectId" id="projectId" value="{{$data['floorplanner']['floor_id']}}">
					<input type="hidden" name="token" id="token" value="{{$data['floorplanner']['token']}}">	
					<input type="hidden" name="companyId" value="{{ $data['orderP']['company']['id']}}">	
					<input type="hidden" name="step" value="{{ $data['orderP']['step']}}">	
					<input type="hidden" name="orderId" value="{{ $data['order']['id']}}">
					<input type="hidden" name="orderPId" value="{{ $data['orderP']['id']}}">
					<input type="hidden" name="objectId" value="{{ $data['order']['objectId']}}">
					<input type="hidden" name="objectSlug" value="{{ $data['order']['slug']}}">
					<input type="hidden" name="email" value="{{ $data['order']['email']}}">
					<input type="hidden" name="_token" value="{{ csrf_token()}}">	
					<br><br>
					@if($data['orderP']['step'] == 1) 
						<button type="submit" class="btn btn-primary">Submit for Review</button>
					@else 
						<button type="submit" class="btn btn-primary">Deliver Floorplan</button>
					@endif
				</form>
			</div>
		</div>
	</section>

<script src="{{ asset('js/embed.js')}}"></script>
<script type="text/javascript">
    var elementId = "floorplan";
    var projectId = $('#projectId').val();
    var user_token = $('#token').val() ;
    var options = {
        'details':  false,
        'assets':   true,
        'sidebar': true,
        'media':    false,
        'location': true,
        'share':    true,
        'export':   true,
        'tutorial': false,
        'initial':  'assets',
        'state':    'edit',
        'token': user_token,
    };
    // var options = [];
    var fp = new Floorplanner(elementId, projectId, options);
</script>
@endsection
