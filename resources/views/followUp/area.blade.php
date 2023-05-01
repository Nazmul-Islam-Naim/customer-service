@extends('layouts.layout')
@section('title', 'Client Area')
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
          <div class="card-header pb-3">
            <div class="card-title">Client Areas</div>
          </div>
        </div>
      </div>
      @foreach ($areas as $area)
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <a href="{{route('clients',$area->id)}}">
          <div class="card">
            <div class="card-body text-center">
              <a href="{{route('clients',$area->id)}}">
                <h3>{{$area->name}}</h3></a>
              <h6>{{$area->customers->count()}}</h6>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection 