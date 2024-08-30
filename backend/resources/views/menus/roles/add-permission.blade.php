@extends("layout.master")

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if(session('status')) 
            <div class="alert alert-success">{{session('status')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4> Role : {{$role->name}}
                        
                        <a href="{{url('roles')}}" class="btn btn-danger float-right">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                     <form action="{{url('roles/'.$role->id.'/give-permissions')}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            @error('permission')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <label for="">Permissions</label>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <label for="">
                                          <input 
                                          type="checkbox" 
                                          name="permission[]" 
                                          value="{{ $permission->name }}" 
                                          {{in_array($permission->id, $rolePermissions) ? 'checked': ''}}
                                          />
                                          {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach 
                            </div>
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
