@extends('layouts.layout')
@section('title', 'Add/Edit User')
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
    </div>
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          @if(!empty($single_data))
          {!! Form::open(array('route' =>['user-list.update',$single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $btn='Update';?>
          @else
          {!! Form::open(array('route' =>['user-list.store'],'method'=>'POST','files'=>true)) !!}
          <?php $btn='Add';?>
          @endif
          <div class="card-header">
            <div class="card-title">{{$btn}} User</div>
            <a href="{{URL::to('/user/user-list')}}" class="btn btn-sm btn-warning pull-right"><i class="icon-corner-down-right"></i> <b>Back</b></a>
          </div>
          
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <!------------------- name --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="name" value="{{!empty($single_data->name)?$single_data->name:''}}" autocomplete="off">
                  <div class="field-placeholder">Name <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- email --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="email" value="{{!empty($single_data->email)?$single_data->email:''}}" autocomplete="off">
                  <div class="field-placeholder">Email</div>
                </div>
              </div>
              <!------------------- phone --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="phone" value="{{!empty($single_data->phone)?$single_data->phone:''}}" autocomplete="off">
                  <div class="field-placeholder">Phone <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- role --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('role_id') is-invalid @enderror" data-live-search="true" name="role_id" required="">
                    <option value="">Select</option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" {{(!empty($single_data) && $single_data->role_id == $role->id)?'selected':''}}>{{$role->title}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Role<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- designation --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('designation_id') is-invalid @enderror" data-live-search="true" name="designation_id" required="">
                    <option value="">Select</option>
                    @foreach($designations as $designation)
                    <option value="{{$designation->id}}" {{(!empty($single_data) && $single_data->designation_id==$designation->id)?'selected':''}}>{{$designation->title}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Designation<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- division --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('division_id') is-invalid @enderror" data-live-search="true" name="division_id" id="division_id" required="">
                    <option value="">Select</option>
                    @foreach($divisions as $division)
                    <option value="{{$division->id}}" {{(!empty($single_data) && $single_data->division_id == $division->id)?'selected':''}}>{{$division->name}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Division<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- district --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('district_id') is-invalid @enderror" data-live-search="true" name="district_id" id="district_id" required="">
                    @if (!empty($single_data))
                      <option value="">Select</option>
                      @foreach($districts as $district)
                      <option value="{{$district->id}}" {{(!empty($single_data) && $single_data->district_id == $district->id)?'selected':''}}>{{$district->name}}</option>
                      @endforeach
                    @endif
                  </select>
                  <div class="field-placeholder">District<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- area --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <select class="select-multiple js-states select2 @error('area_id') is-invalid @enderror" multiple="multiple" name="area_id[]" id="area_id" required="">
                    @if (!empty($single_data))
                      <option value="">Select</option>
                      @foreach($areas as $area)
                      <option value="{{$area->id}}" {{(!empty($single_data) && in_array($area->id, $allareas))?'selected':''}}>{{$area->name}}</option>
                      @endforeach
                    @endif
                  </select>
                  <div class="field-placeholder">Area<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- password --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="password" class="form-controller">
                  <div class="field-placeholder">Password <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- confirm password --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="password_confirmation" class="form-controller">
                  <div class="field-placeholder">Confirm Password <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- avatar --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="file" name="avatar" value="">
                  <div class="field-placeholder">Avatar</div>
                </div>
              </div>
              <!------------------- nid --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="file" name="nid" value="">
                  <div class="field-placeholder">NID</div>
                </div>
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">{{$btn}}</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!! Html::script('custom/js/jquery.min.js') !!}
<script>
  $(document).ready(function () {

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $('#division_id').change(function (e) { 
      e.preventDefault();
      var divisionId = $(this).val();

      $.ajax({
        type: "POST",
        url: "{{route('get-district-by-division-id')}}",
        data: {"id":divisionId},
        dataType: "JSON",
        success: function (response) {
          $('#district_id').empty();
          $('#area_id').empty();
          $('#district_id').append('<option value="">Select</option>');
          $.each(response, function (key, value) { 
            $('#district_id').append('<option  value="'+ value.id +'">' + value.name+ '</option>');
          });
        }
      });
      
    });

    $('#district_id').change(function (e) { 
      e.preventDefault();
      var districtId = $(this).val();

      $.ajax({
        type: "POST",
        url: "{{route('get-area-by-district-id')}}",
        data: {"id":districtId},
        dataType: "JSON",
        success: function (response) {
          $('#area_id').empty();
          $('#area_id').append('<option value="">Select</option>');
          $.each(response, function (key, value) { 
            $('#area_id').append('<option  value="'+ value.id +'">' + value.name+ '</option>');
          });
        }
      });
      
    });

  });
</script>
@endsection