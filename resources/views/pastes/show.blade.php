@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h3 class="card-header">{{$paste->name}}</h3>
            <div class="card-body">
                {!! $paste->body !!}
            </div>
            <h5 class="card-footer">Created {{$paste->created_at}} by {{$paste->owner->username}}</h5>
        </div>
    @can('update', $paste)
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">Currently Shared With</h3>
                    <div class="card-body">
                        <table class="table">
                            @if(isset($metadata['Allow Users (View)']))
                                @foreach($metadata['Allow Users (View)'] as $user)
                                    <tr>
                                        <td>{{App\User::find($user)->pluck('username')->first()}} (View)</td>
                                        <td>
                                            <form method="post" action="/pastes/{{$paste->id}}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="member_type" value="User">
                                                <input type="hidden" name="member_id" value="{{$user}}">
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="actiontype" value="perms">
                                                <input type="hidden" name="access_level" value="View">
                                                <button type="submit" class="btn btn-danger">Remove Access</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                                @if(isset($metadata['Allow Users (Update)']))
                                    @foreach($metadata['Allow Users (Update)'] as $user)
                                        <tr>
                                            <td>{{App\User::find($user)->pluck('username')->first()}} (Edit)</td>
                                            <td>
                                                <form method="post" action="/pastes/{{$paste->id}}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="member_type" value="User">
                                                    <input type="hidden" name="member_id" value="{{$user}}">
                                                    <input type="hidden" name="action" value="remove">
                                                    <input type="hidden" name="actiontype" value="perms">
                                                    <input type="hidden" name="access_level" value="Update">
                                                    <button type="submit" class="btn btn-danger">Remove Access</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(isset($metadata['Allow Groups (View)']))
                                    @foreach($metadata['Allow Groups (View)'] as $group)
                                        <tr>
                                            <td>{{App\Group::where('id',$group)->pluck('name')->first()}} (View)</td>
                                            <td>
                                                <form method="post" action="/pastes/{{$paste->id}}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="member_type" value="Group">
                                                    <input type="hidden" name="member_id" value="{{$group}}">
                                                    <input type="hidden" name="action" value="remove">
                                                    <input type="hidden" name="actiontype" value="perms">
                                                    <input type="hidden" name="access_level" value="View">
                                                    <button type="submit" class="btn btn-danger">Remove Access</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(isset($metadata['Allow Groups (Update)']))
                                    @foreach($metadata['Allow Groups (Update)'] as $group)
                                        <tr>
                                            <td>{{App\Group::find($group)->pluck('name')->first()}} (Edit)</td>
                                            <td>
                                                <form method="post" action="/pastes/{{$paste->id}}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="member_type" value="Group">
                                                    <input type="hidden" name="member_id" value="{{$group}}">
                                                    <input type="hidden" name="action" value="remove">
                                                    <input type="hidden" name="actiontype" value="perms">
                                                    <input type="hidden" name="access_level" value="Update">
                                                    <button type="submit" class="btn btn-danger">Remove Access</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">Share With Groups</h3>
                    <form action="/pastes/{{$paste->id}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="members[]" size="10" class="form-control" multiple>
                                @foreach(App\Group::where('metadata->Group Type','=','Role')->get() as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <small>Please select only the most specific group required. If you only need to share something
                            with team Captains, for example, you do not need to select team members as well.</small>
                        <select name="access_level" class="form-control">
                            <option name="View">View</option>
                            <option name="Update">Edit</option>
                        </select>
                        <input type="hidden" name="member_type" value="Group">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="actiontype" value="perms">
                        <button class="btn btn-block btn-success mt-2">Share With Groups</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">Share With Users</h3>
                    <form action="/pastes/{{$paste->id}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="members[]" size="10" class="form-control" multiple>
                                @foreach(App\User::orderBy('username')->get() as $user)
                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                @endforeach
                            </select>
                        </div>
                        <select name="access_level" class="form-control">
                            <option name="View">View</option>
                            <option name="Update">Edit</option>
                        </select>
                        <input type="hidden" name="member_type" value="User">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="actiontype" value="perms">
                        <button class="btn btn-block btn-success mt-2">Share With Users</button>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    </div>
@endsection