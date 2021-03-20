@extends('layout')
@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb mt-2">
    <li class="breadcrumb-item">
      <a href="#">Posts</a>
    </li>
    <li class="breadcrumb-item active">Edit</li>
  </ol>


  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Edit Post
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

        <form method="post" action="{{url('admin/posts')}}/{{$post->id}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <table class="table table-bordered">
            <tr>
                  <th>Category</th>
                  <td>
                    <select name="category" id="" class="form-control">
                      @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $post->category_id ? 'selected':''}}>{{$category->title}}</option>
                      @endforeach
                    </select>
                  </td>
              </tr>
              <tr>
                  <th>Title</th>
                  <td><input type="text" name="title" class="form-control" placeholder="Title" value="{{$post->title}}" /></td>
              </tr>
              <tr>
                  <th>Thumbnail</th>
                  <td>
                    <input type="hidden" name="old_thumbnail" value="{{$post->thumbnail}}">
                    <input type="file" name="thumbnail"/>
                    <p><img src="{{asset($post->thumbnail)}}" alt="" width="200" class="my-2"></p>
                  </td>

              </tr>
              <tr>
                  <th>Full Image</th>
                  <td>
                    <input type="hidden" name="old_full_image" value="{{$post->full_image}}">
                    <input type="file" name="full_image"/>
                    <p><img src="{{asset($post->full_image)}}" alt="" width="200" class="my-2"></p>
                  </td>
              </tr>
              <tr>
                  <th>Detail</th>
                  <td>
                    <textarea name="details" id="" cols="30" rows="10" class="form-control" placeholder="Details">{{$post->details}}</textarea>
                  </td>
              </tr>
              <tr>
                  <th>Tags</th>
                  <td>
                    <textarea name="tags" id="" cols="30" rows="10" class="form-control" placeholder="Tags">{{$post->tags}}</textarea>
                  </td>
              </tr>
              
              <tr>
                  <td colspan="2">
                      <input type="submit" class="btn btn-primary" value="Update Now" />
                  </td>
              </tr>
          </table>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection
