@extends('layouts.layout')
@section('title', 'District')
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
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        @if(!empty($single_data))
          {!! Form::open(array('route' =>['district.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $info ="Update";?>
        @else
        {!! Form::open(array('route' =>['district.store'],'method'=>'POST','files'=>true)) !!}
          <?php $info ="Add";?>
        @endif
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}} District</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{(!empty($single_data->name))?$single_data->name:''}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Name<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('division_id') is-invalid @enderror" data-live-search="true" name="division_id"  required="">
                    <option value="">Select</option>
                    @foreach($divisions as $division)
                    <option value="{{$division->id}}" {{(!empty($single_data) && $single_data->division_id == $division->id)?'selected':''}}>{{$division->name}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Division<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">{{$info}}</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
      
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">District List</div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <!--<table id="dataTable" class="table v-middle">-->
              <table id="basicExample" class="table custom-table">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Division</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sl = 1;?>
                  @foreach($alldata as $data)
                  <tr>
                    <td>{{$sl++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->division->name}}</td>
                    <td>
                      <div class="actions" style="height: 25px">
                        <a href="{{ route('district.edit', $data->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                          <i class="icon-edit1 text-info"></i>
                        </a>
                        {{Form::open(array('route'=>['district.destroy',$data->id],'method'=>'DELETE'))}}
                          <button type="submit" class="btn btn-default btn-xs confirmdelete" confirm="You want to delete this informations ?" title="Delete" style="width: 100%"><i class="icon-x-circle text-danger"></i></button>
                        {!! Form::close() !!}
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection 