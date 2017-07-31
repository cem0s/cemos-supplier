@extends('layouts.app')

@section('cont-head')
 <h1>
   @if($data['orderP']['step'] == 1)
   Photography
   @elseif($data['orderP']['step'] == 2)
   Photo Editor
   @elseif($data['orderP']['step'] == 3)
   Quality Checker
   @endif
    <small>upload images</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Orders</li>
    <li>Photography</li>
    <li class="active">Upload Photos</li>
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
				<b>Special Instructions</b><br><br>
				@if(isset($data['orderP']['data']['photoComment']))
					{{$data['orderP']['data']['photoComment']}}
				@elseif(isset($data['orderP']['data']['videoComment']))
					{{$data['orderP']['data']['videoComment']}}
				@endif
				
			</div>
			<div class="col-sm-4">
				<b>Preference Date</b><br><br>
				{{$data['orderP']['data']['preferenceDate']}}
			</div>
		</div>
		<hr>
		@if($data['orderP']['step'] == 1)
		<div class="row">
			<div class="col-sm-4">
				<b>Are files edited?</b>
			</div>
			<div class="col-sm-4">
				<input type="radio" name="isEdited" value="1" onclick="confirm()"> Yes
				<input type="radio" name="isEdited" value="0" onclick="confirm()"> No 
			</div>
		</div>
		<hr>
		@endif
		@if(!empty($data['files']))
			<div class="row">
				<div class="col-sm-12">
					@if($data['orderP']['step'] == 2) 
						Raw Files
					@else
						Edited Files
					@endif
					<br> <br>
					@foreach($data['files'] as $key => $value)
						@if(strpos($value['type'], 'video') !== false)
						<a href="javascript:void(0)" onclick="showVideo('{{url($value['file'])}}', '{{$value['type']}}')">
							<video type="video" width="140px" height="100px" controls>
								<source src="{{url($value['file'])}}" type="{{$value['type']}}">Your browser does not support the video tag.
							</video>
						</a>
						@else
						<a class="fancybox" rel="group" href="{{url($value['file'])}}"><img src="{{url($value['file'])}}" alt="" width="200" height="200" /></a>
						@endif
					@endforeach
				</div>
			</div>
			<br>
			<form action="{{url('zip-file')}}">
				<input type="hidden" name="name" value="{{$data['order']['slug']}}">
				<input type="hidden" name="objId"  value="{{$data['order']['objectId']}}">
				<input type="hidden" name="oId"  value="{{$data['order']['id']}}">
				<input type="hidden" name="orderPId" value="{{$data['orderP']['id']}}">
				<input type="hidden" name="compId"  value="{{$data['orderP']['company']['id']}}">
				<input type="hidden" name="step" value="{{$data['orderP']['step']}}">
				<button class="btn btn-primary" type="submit">Download Zip Files</button>
			</form>
	
			<hr>
		@endif
		<br>
				
		<?php 
			$isDisplay = "display:block;";
			if($data['orderP']['step'] == 1) {
				$isDisplay = "display:none;";
			}
		?>
		<div class="row" id="upload-here" style="{{$isDisplay}}">
			<div class="col-sm-12">
				<b>Start Uploading Files Here...</b> <br><br><br>
				<form action="{{url('upload')}}" class="dropzone" enctype="multipart/form-data" id="image-upload">
					<input type="hidden" name="objectId" id="objectId" value="{{$data['order']['objectId']}}">
					<input type="hidden" name="orderId" id="orderId" value="{{$data['order']['id']}}">
					<input type="hidden" name="orderProductId" id="orderProductId" value="{{$data['orderP']['id']}}">
					<input type="hidden" name="companyId" id="companyId" value="{{$data['orderP']['company']['id']}}">
					<input type="hidden" name="isEdited" id="isEdited" value="">
					<input type="hidden" name="step" id="step" value="{{$data['orderP']['step']}}">
				</form>
				<br> <br>
				<button class="btn btn-primary" onclick="submitFiles({{$data['orderP']['id']}}, {{$data['order']['id']}}, {{$data['orderP']['step']}}, this)">Submit Files</button>
				<div style="display: none;"> <i class="fa fa-cog fa-spin fa-2x fa-fw"></i>  Please wait while saving data </div>
			</div>
		</div>
	</section>

	<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@endsection

