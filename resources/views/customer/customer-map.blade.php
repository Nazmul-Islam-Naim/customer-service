@extends('layouts.layout')
@section('title', 'Customer in map')
@section('content')
<!-- Content Header (Page header) -->
<?php
  $baseUrl = URL::to('/');
?>
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @include('common.message')
      </div>
      
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Customer location in map</div>
            <a class="btn btn-success" href="{{route('customers.index')}}"> <i class="icon-list"></i> Customer List</a>
          </div>
          <div class="card-body">
            <p><strong>Customer Name: </strong> {{$customer->name}} ||
                <strong>Customer Mobile: </strong> {{$customer->mobile}} ||
                <strong>Customer District: </strong> {{$customer->district->name}} ||
                <strong>Customer Division: </strong> {{$customer->division->name}} ||
                <strong>Customer Area: </strong> {{$customer->area->name}} ||
                <strong>Entry Date: </strong> {{date('d F Y', strtotime($customer->date))}} ||
            </p>
            <input type="hidden" name="lat" id="lat" value="{{$customer->lat}}">
            <input type="hidden" name="long" id="long" value="{{$customer->long}}">
            <input type="hidden" name="name" id="name" value="{{$customer->name}}">
          </div>
        </div>
      </div>
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div id="mapid" style="height: 370px"></div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!!Html::script('custom/js/jquery.min.js')!!}
<script>
  const lat = document.getElementById('lat').value;
  const long = document.getElementById('long').value;
  const name = document.getElementById('name').value;
	var mymap = L.map('mapid').setView([lat, long], 18);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(mymap);

  var marker = L.marker([lat, long]).addTo(mymap);
      marker.bindPopup(name);

</script>
@endsection 