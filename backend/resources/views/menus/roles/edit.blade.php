@extends("layout.master")

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Role
                        
                        <a href="{{url('roles')}}" class="btn btn-danger float-right">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                     <form action="{{url('roles/'. $role->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="">Role Name</label>
                            <input type="text" name="name" class="form-control" value="{{$role->name}}">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection