@extends('layouts.layout')
@section('title', 'Customer Location')
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
          </div>
          <div class="card-body">
            <div class="row d-flex">
              <div class="col-md-6">
                <p><strong>User Name: </strong> {{$user->name}}</p>
                <p><strong>User Mobile: </strong> {{$user->phone}}</p>
                <p><strong>User District: </strong> {{$user->district->name}}</p>
                <p><strong>User Division: </strong> {{$user->division->name}}</p>
                <p><strong>User Area: </strong> @if (!empty($user->areas)) @foreach ($user->areas as $item) {{$item->name}}, @endforeach @endif </p>
              </div>
              <input type="hidden" name="customers" id="customers" value="{{$customers}}">
              <div class="col-md-6 text-center">
                <img src="{{asset('storage').'/'. $user->avatar}}" height="120px" alt="">
              </div>
            </div>
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
  var customers = document.getElementById('customers').value;
  customers = JSON.parse(customers);
  var mymap = L.map('mapid').setView([23.777176, 90.399452], 10);
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 20,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(mymap);

  customers.forEach(element => {
    var marker = L.marker([element.lat, element.long]).addTo(mymap);
				marker.bindPopup(element.name);
  });

</script>
@endsection 