@extends('layout')
@section('content')
<div class="container-fluid">
    <ol class="breadcrumb mt-2">
    <li class="breadcrumb-item">
      <a href="#">Category</a>
    </li>
    <li class="breadcrumb-item active">Lists</li>
  </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            All Category
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
                        
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->title}}</td>
                                <td><img src="{{asset($category->image)}}" alt="" width="100px"></td>
                                <td>
                                    <a href="/admin/categories/{{$category->id}}/edit" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    

                                    <form action="/admin/categories/{{$category->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{$category->id}}" name="id">
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
