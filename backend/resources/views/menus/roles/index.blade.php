@extends("layout.master")

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
            <div class="alert alert-success" role="alert">{{session('status')}}</div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        User Roles
                        <a href="{{url('roles/create')}}" class="btn btn-primary float-right">Create Role</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                       <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                       </thead>
                       <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="{{url('roles/'.$role->id.'/give-permissions')}}" class="btn btn-success">Add Permission</a>
                                <a href="{{url('roles/'.$role->id.'/edit')}}" class="btn btn-warning">Edit</a>
                                <a href="{{url('roles/'.$role->id.'/delete')}}" class="btn btn-danger">Delete</a>
                            </td>
                            
                        </tr>
                        @endforeach
                        
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection