@extends('layouts.layout')
@section('title', 'Clients')
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
            <div class="card-title">Client of {{$area->name}}</div>
            <input type="hidden" name="areaId" id="areaId" value="{{$area->id}}">
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <!--<table id="dataTable" class="table v-middle">-->
              <table id="example" class="table custom-table">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Lat</th>
                    <th>Long</th>
                    <th>Business</th>
                    <th>Area</th>
                    <th>District</th>
                    <th>Division</th>
                    <th>User</th>
                    <th>Action</th>
                  </tr>
                </thead>
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

{!!Html::script('custom/yajraTableJs/jquery.js')!!}
<script>
   // ==================== date format ===========
   function dateFormat(data) { 
    let date, month, year;
    date = data.getDate();
    month = data.getMonth() + 1;
    year = data.getFullYear();

    date = date
        .toString()
        .padStart(2, '0');

    month = month
        .toString()
        .padStart(2, '0');

    return `${date}-${month}-${year}`;
  }
	$(document).ready(function() {
		'use strict';
    var id = $('#areaId').val();
    var link = '{{route("clients",":id")}}';
    var link = link.replace(':id', id);
    console.log(id);

      var table = $('#example').DataTable({
			serverSide: true,
			processing: true,
      deferRender : true,
			ajax: link,
      "lengthMenu": [[ 50, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 2, 3,4,5,6]
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
          data: 'avatar',
          render: function(data, type, row) {
            if (data != null) {
            return "<img src={{ URL::to('/') }}/storage/" + data + " width='50px' class='img-thumbnail' />";
          } else {
            return '<img src="{{asset("upload/logo/no-image.jpg")}}" width="50px" class="img-thumbnail" />'
          }
          }
        },
				{
          data: 'name',
        },
				{
          data: 'mobile',
        },
				{
          data: 'lat',
          render: function(data, type, row) {
            var url = '{{route("customer-map",":id")}}'; 
            var url = url.replace(':id', row.id);
            return '<a href=' + url +'>'+ data +'</a>';
          }
        },
				{
          data: 'long',
          render: function(data, type, row) {
            var url = '{{route("customer-map",":id")}}'; 
            var url = url.replace(':id', row.id);
            return '<a href=' + url +'>'+ data +'</a>';
          }
        },
				{
          data: 'business_category.name',
        },
        {
          data: 'area.name',
        },
        {
          data: 'area.district.name',
        },
        {
          data: 'area.district.division.name',
        },
				{
          data: 'user.name',
        },
				{
          data: 'action',
        },
			]
    });
});
</script>
@endsection 