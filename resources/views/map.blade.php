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
				<div class="card" style="background: rgb(10, 97, 85)">
					<div class="card-header">
						<div class="card-title" style="color:white">Customer Map</div>
					</div>
					<div class="card-body">
						<div id="mapid" style="height: 370px"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->
	</div>
	<!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!!Html::script('custom/js/jquery.min.js')!!}
<script>
	var mymap = L.map('mapid').setView([23.777176, 90.399452], 7);

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
		url: "{{route('get-lat-long')}}",
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