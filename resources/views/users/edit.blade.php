@extends('layouts.app')

@section('content')
    @can('update', $user)
    <div class="container">
        <div class="row pb-4">
            <div class="col-12">
            <div class="card">
                <h3 class="card-header">Editing {{$user->username}}</h3>
                <div class="card-body">
                    <form method="POST" action="/users/{{$user->id}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{old('username', $user->username)}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}">
                        </div>
                        <div class="form-group">
                            <label for="wikidotusername">Wikidot Username</label>
                            <input type="text" class="form-control" id="wikidotusername" name="wikidotusername" value="{{old('wikidotusername', $user->wikidotusername)}}">
                        </div>
                        <button type="submit" class="btn btn-success">Update User</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @can('create', App\GroupMembership::class)
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="card-header">Group Memberships for {{$user->username}}</h3>
                        <div class="card-body">
                            <h3>Current Memberships</h3>
                            <table class="table">
                            @foreach($user->memberships as $membership)
                                <tr>
                                    <td>{{$membership->parent->name}}</td>
                                    <td>
                                        <form method="post" action="/groupmemberships/{{$membership->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove Membership</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="card-header">Add To Group</h3>
                        <form action="/groupmemberships" method="post">
                            @csrf
                            <div class="form-group">
                            <select name="groups[]" size="10" class="form-control" multiple>
                                @foreach(App\Group::all() as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                            <small class="form-check pt-2">
                                Please do not use this unless you've been thoroughly trained on usage.
                                Improper usage will break the site for this user.
                            </small>
                            </div>
                            <input type="hidden" name="member_type" value="User">
                            <input type="hidden" name="member_id" value="{{$user->id}}">
                            <button class="btn btn-block btn-success">Add To Group(s)</button>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </div>
    @endcan
@endsection