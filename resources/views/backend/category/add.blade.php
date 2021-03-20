@extends('layout')
@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb mt-2">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>


  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Add Category
      <a href="{{url('admin/categories')}}" class="float-right btn btn-sm btn-dark">All Data</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        @if($errors)
          @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
          @endforeach
        @endif

        @if(Session::has('success'))
        <p class="text-success">{{session('success')}}</p>
        @endif

        <form method="post" action="{{url('admin/categories')}}" enctype="multipart/form-data">
          @csrf
          <table class="table table-bordered">
              <tr>
                  <th>Title</th>
                  <td><input type="text" name="title" class="form-control" /></td>
              </tr>
              <tr>
                  <th>Detail</th>
                  <td><input type="text" name="details" class="form-control" /></td>
              </tr>
              <tr>
                  <th>Image</th>
                  <td><input type="file" name="category_image" /></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <input type="submit" class="btn btn-primary" value="Create Now" />
                  </td>
              </tr>
          </table>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection
