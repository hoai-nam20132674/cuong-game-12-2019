@extends('admin.default')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách khách hàng quay thưởng
                            <small></small>
                        </h1>
                        @if( Session::has('flash_message'))
			                <div class="alert alert-{{ Session::get('flash_level')}}">
			                    {{ Session::get('flash_message')}}
			                </div>
			            @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>SĐT</th>
                                <th>Phần thưởng</th>
                                <th>Trạng thái</th>
                                <!-- <th>Xóa</th>
                                <th>Sửa</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
                        		$i =1;
                        	?>
                        	@foreach($user as $us)
                            <tr class="odd gradeX" align="center">
                                <td>{{$i}}</td>
                                <td>{{$us->name}}</td>
                                <td>{{$us->sdt}}</td>
                                @if($us->phanthuong == 1)
                                	<td>Nokia 6700</td>
                                @elseif($us->phanthuong == 2)
                                	<td>Gift Voucher</td>
                                @elseif($us->phanthuong == 3)
                                	<td>Spa vệ sinh máy </td>
                                @elseif($us->phanthuong == 4)
                                	<td>Móc khóa rồng</td>
                                @elseif($us->phanthuong == 5)
                                	<td>Gift Voucher</td>
                                @elseif($us->phanthuong == 6)
                                	<td>Bao da Handmade </td>
                                @elseif($us->phanthuong == 7)
                                	<td>Gift Voucher</td>
                                @elseif($us->phanthuong == 8)
                                	<td>Gói bảo hành sửa chữa 5 năm tại Slux</td>
                                @else
                                	<td></td>
                                @endif
                                <td>
                                	@if($us->status == 0)
                                	<div class="status" style="background: green;color:#fff;width:100%; ">
										<span >Chưa quay thưởng</span>
									</div>
									@else
                                	<div class="status" style="background: red;color:#fff;width:100%; ">
										<span >Đã quay thưởng</span>
									</div>
									@endif
                                </td>
                                <!-- <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection