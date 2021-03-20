@extends('layout')
@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb mt-2">
    <li class="breadcrumb-item">
      <a href="#">Posts</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
  </ol>


  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Add Post
      <a href="{{url('admin/posts')}}" class="float-right btn btn-sm btn-dark">All Data</a>
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

        <form method="post" action="{{url('admin/posts')}}" enctype="multipart/form-data">
          @csrf
          <table class="table table-bordered">
            <tr>
                  <th>Category</th>
                  <td>
                    <select name="category" id="" class="form-control">
                      @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                      @endforeach
                    </select>
                  </td>
              </tr>
              <tr>
                  <th>Title</th>
                  <td><input type="text" name="title" class="form-control" placeholder="Title" /></td>
              </tr>
              <tr>
                  <th>Thumbnail</th>
                  <td><input type="file" name="thumbnail"/></td>
              </tr>
              <tr>
                  <th>Full Image</th>
                  <td><input type="file" name="full_image"/></td>
              </tr>
              <tr>
                  <th>Detail</th>
                  <td>
                    <textarea name="details" id="" cols="30" rows="10" class="form-control" placeholder="Details"></textarea>
                  </td>
              </tr>
              <tr>
                  <th>Tags</th>
                  <td>
                    <textarea name="tags" id="" cols="30" rows="10" class="form-control" placeholder="Tags"></textarea>
                  </td>
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
