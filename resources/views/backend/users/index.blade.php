@extends('backend.layouts.master')

@section('title', 'User List')

@section('heading', 'User List')

@section('heading_buttons')
    <a href="{{route('users.create')}}" class="btn btn-primary">Create User</a>
@endsection

@section('contents')
    <form action="#" enctype="multipart/form-data" method="GET">
        <div class="col-12 col-md-12 col-lg-12" style="padding: 0px">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3 mr-5">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control select2" data-placeholder="Select Status">
                                <option value=""></option>
                                @foreach(trans('user.status') as $key => $status)
                                    <option value="{{ $key }}"
                                            @if(Arr::get($input, 'status') == $key) selected @endif>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="status">Role</label>
                            <select id="roles" name="roles" class="form-control">
                                <option value="">Select Role</option>
                                @foreach($roles as $role => $name)
                                    <option value="{{ $role }}" @if(Arr::get($input, 'roles') == $role) selected @endif >{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3" style="margin-top: 30px">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            @if(!empty(array_filter($input)))
                                <a href="{{ route('users.index') }}" class="btn btn-light">Remove Filters</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>All Users</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search"
                               value="{{ $input['search'] ?? '' }}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table-responsive card-list-table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td data-title="Name">{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td data-title="email">{{ $user->email }}</td>
                            <td data-title="role">
                                @foreach($user->roles as $role)
                                    @if($role == \App\Enums\Role::SUPER_ADMIN)
                                        <div class="badge badge-danger mr-1 mb-1">{{ trans('user.roles.'.$role) }}</div>
                                    @elseif($role == \App\Enums\Role::MANAGEMENT_ADMIN)
                                        <div class="badge badge-warning mr-1 mb-1">{{ trans('user.roles.'.$role) }}</div>
                                    @elseif($role == \App\Enums\Role::EVENT_ADMIN)
                                        <div class="badge badge-primary mr-1 mb-1">{{ trans('user.roles.'.$role) }}</div>
                                    @elseif($role == \App\Enums\Role::STUDENT)
                                        <div class="badge badge-info mr-1 mb-1">{{ trans('user.roles.'.$role) }}</div>
                                    @endif
                                @endforeach
                            </td>
                            @if($user->status == \App\Enums\UserStatus::INACTIVE)
                                <td>
                                    <div class="badge badge-danger">Inactive</div>
                                </td>
                            @else
                                <td>
                                    <div class="badge badge-success">Active</div>
                                </td>
                            @endif
                            <td data-title="Actions">
                                <a href="{{ route('users.edit', [$user->id]) }}"
                                   class="btn btn-sm btn-info">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="dataTables_info" id="table-1_info" role="status" aria-live="polite">
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
                            entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="float-right">
                            {{ $users->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection()
