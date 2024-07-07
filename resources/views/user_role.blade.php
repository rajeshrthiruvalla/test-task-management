@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">User Role</div>

                <div class="card-body">
                    <form action="{{route('user-role.save')}}" method="POST">
                        @csrf
                       <div class="form-group">
                           <label>User</label>
                           <select class="form-control" name="user_id" id="user_id">
                             <option value="">Select User</option>
                               @foreach ($users as $user)
                               <option value="{{$user->id}}">{{$user->name}}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="form-group">
                           <label>User Role</label>
                           <select class="form-control" multiple name="role_ids[]" id="role_id">
                               @foreach ($roles as $role)
                               <option value="{{$role->id}}">{{$role->name}}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="form-group">
                        <input type="submit" class="btn btn-info" name="submit" value="Submit"/>
                       </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <td>Sl No</td>
                        <td>Name</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user_with_roles as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
