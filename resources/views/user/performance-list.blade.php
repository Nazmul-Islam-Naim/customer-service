@extends('layouts.layout')
@section('title', 'User List')
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
        @include('common.commonFunction')
      </div>
  
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">All users performance list.</h3>
            </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered" id="example" style="width:100%"> 
                    <thead> 
                      <tr> 
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Area</th>
                        <th>Target</th>
                        <th>Recover</th>
                        <th>Opposite</th>
                        <th>Performance (%)</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <div class="card-footer"></div>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
{!!Html::script('custom/yajraTableJs/jquery.js')!!}
<script>
	$(document).ready(function() {
		'use strict';
      var table = $('#example').DataTable({
			serverSide: true,
			processing: true,
      deferRender : true,
			ajax: "{{route('performance-list')}}",
      "lengthMenu": [[ 100, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 2, 3,4,5,6,7,8]
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  // var top = '<center><p class ="text-center"><img src="{{asset("upload/logo")}}/header_pppo.jpg" width="100%"/></p></center>';
                //   top += '<center><h3>PPPO</h3></center>';
                  
                  return top;
                },
                customize: function (win){
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
 
                $(win.document.body).find('table').css('font-size', 'inherit');
 
                $(win.document.body).find('table thead th').css('border','1px solid #ddd');  
                $(win.document.body).find('table tbody td').css('border','1px solid #ddd');  
                $(win.document.body).css("height", "auto").css("min-height", "0");
                },
                exportOptions: {
                      columns: [ 0, 2, 3,4,5,6,7,8]
                },
                messageBottom: null
            }
        ],
			aaSorting: [[0, "asc"]],

			columns: [
        {
          data: 'DT_RowIndex',
        },
				{
          data: 'user.avatar',
          render: function(data, type, row) {
            if (data != null) {
            return "<img src={{ URL::to('/') }}/storage/" + data + " width='50px' height='50px' class='img-thumbnail' />";
          } else {
            return '<img src="{{asset("upload/logo/no-image.jpg")}}" width="50px" height="50px" class="img-thumbnail" />'
          }
          }
        },
				{
          data: 'user.name',
          render: function(data, type, row) {
            var url = '{{route("customer-location",":id")}}'; 
            var url = url.replace(':id', row.user_id);
            return '<a href=' + url +'>'+ data +'</a>';
          }
        },
				{
          data: 'user.phone',
        },
				{
          data: 'user.areas',
          render: function(data, display, row){
            var allarea = '';
            $.each(data, function (key, value) { 
              allarea = allarea + value.name + ', ';
            });
            return allarea;

          }
        },
        {
          data: 'target'
        },
        {
          data: 'recovery'
        },
        {
          data: 'target',
          render: function(data,type,row){
            return row.target - row.recovery;
          }
        },
        {
          data: 'target',
          render: function(data,type,row){
            return ((row.recovery*100)/ row.target).toFixed(2);
          }
        },
			]
    });
});
</script>
@endsection 