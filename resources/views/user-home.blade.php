@extends('layouts.layout')
@section('title', 'User Dashboard')
@section('content')
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			@include('common.commonFunction')
			</div>
			<!------------------- number of department ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="stats-tile">
					<div class="sale-icon">
						<i ><img src="{{asset('upload/logo/department.gif')}}" alt="" width="60px"></i>
					</div>
					<div class="sale-details">
						{{-- <h4>{{$department}}</h4> --}}
						<a href="#"><p>Department</p></a>
					</div>
					<div class="sale-graph">
						<div id="sparklineLine5"></div>
					</div>
				</div>
			</div>
			<!------------------- number of designation ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="stats-tile">
					<div class="sale-icon">
						<i ><img src="{{asset('upload/logo/destination.gif')}}" alt="" width="60px"></i>
					</div>
					<div class="sale-details">
						{{-- <h4>{{$designation}}</h4> --}}
						<a href="#"><p>Designation</p></a>
					</div>
					<div class="sale-graph">
						<div id="sparklineLine5"></div>
					</div>
				</div>
			</div>
			<!------------------- total product ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="stats-tile">
					<div class="sale-icon">
						<i ><img src="{{asset('upload/logo/product.png')}}" alt="" width="60px"></i>
					</div>
					<div class="sale-details">
						{{-- <h4>{{$product}}</h4> --}}
						<a href="#"><p>Total Product</p></a>
					</div>
					<div class="sale-graph">
						<div id="sparklineLine5"></div>
					</div>
				</div>
			</div>
			<!------------------- chart  ---------------------->
			{{-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Stock product current state</div>
					</div>
					<div class="card-body">
						<div id="basic-pie-graph" style="width: 50%; margin-left: 11%"></div>
					</div>
				</div>
			</div> --}}
		</div>
		<!-- Row end -->
	</div>
	<!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection