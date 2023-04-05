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
			<!------------------- number of users ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="stats-tile">
					<div class="sale-icon">
						<i class="icon-users"></i>
					</div>
					<div class="sale-details">
						<h4>{{$users}}</h4>
						<a href="#"><p>Users</p></a>
					</div>
					<div class="sale-graph">
						<div id="sparklineLine1"></div>
					</div>
				</div>
			</div>
			<!------------------- number of customers ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="stats-tile">
					<div class="sale-icon">
						<i class="icon-shopping-basket"></i>
					</div>
					<div class="sale-details">
						<h4>{{$customers}}</h4>
						<a href="#"><p>Customers</p></a>
					</div>
					<div class="sale-graph">
						<div id="sparklineLine2"></div>
					</div>
				</div>
			</div>
			<!------------------- today customers ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="stats-tile">
					<div class="sale-icon">
						<i class="icon-shopping-bag"></i>
					</div>
					<div class="sale-details">
						<h4>{{$todayCustomers}}</h4>
						<a href="#"><p>Today Customers</p></a>
					</div>
					<div class="sale-graph">
						<div id="sparklineLine3"></div>
					</div>
				</div>
			</div>
			<!------------------- today customers ---------------------->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div id="mapid" style="height: 370px"></div>
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
{!!Html::script('custom/js/jquery.min.js')!!}
<script>
	var mymap = L.map('mapid').setView([23.777176, 90.399452], 10);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(mymap);

	// Call the AJAX method to fetch the latitude and longitude from the server
	$.ajax({
		type: "GET",
		url: "{{route('get-today-lat-long')}}",
		dataType: "json",
		success: function (response) {
			// Add markers to the map for each latitude and longitude pair
		  
			$.each(response, function (key, value) { 
				var marker = L.marker([value.lat, value.long]).addTo(mymap);
				marker.bindPopup(value.name);
				});
		}
	});
</script>
@endsection