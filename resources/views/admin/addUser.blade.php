@extends('admin.default')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm khách hàng
                        <small></small>
                    </h1>
                    @if( count($errors) > 0)
                        <div class="alert alert-danger">
                          <ul>
                            @foreach($errors->all() as $error)
                              <li>{{$error}}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{URL::route('postAddUser')}}" method="POST">
                    	<input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input class="form-control" name="name" required placeholder="Vui lòng điền họ tên" />
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="sdt" required placeholder="Vui lòng điền số điện thoại" />
                        </div>
                        
                        <div class="form-group">
                            <label>Quyền truy cập</label>
                            <label class="radio-inline">
                                <input name="role" value="1"  type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="role" value="0" checked="" type="radio">Khách hàng
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection()