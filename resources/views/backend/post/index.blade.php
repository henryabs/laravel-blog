@extends('layout')
@section('content')
<div class="container-fluid">
    <ol class="breadcrumb mt-2">
    <li class="breadcrumb-item">
      <a href="#">Post</a>
    </li>
    <li class="breadcrumb-item active">Lists</li>
  </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            All Post
            <a href="{{url('admin/posts/create')}}" class="float-right btn btn-sm btn-dark">Create Post</a>
        </div>
        @if(Session::has('success'))
        <p class="text-success">{{session('success')}}</p>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td><img src="{{asset($post->thumbnail)}}" alt="" width="100px"></td>
                                <td>
                                    <a href="/admin/posts/{{$post->id}}/edit" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    

                                    <form action="/admin/posts/{{$post->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{$post->id}}" name="id">
                                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
