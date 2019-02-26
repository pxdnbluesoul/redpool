@extends('layouts.app')

@section('content')
    @auth
    <div class="container">
        <div class="card">
            <h3 class="card-header">Users</h3>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Wikidot Username</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\User::all() as $user)
                        <tr>
                            <td scope="row">{{$user->username}}</td>
                            <td>{{$user->wikidotusername}}</td>
                            <td>
                                <a href="/users/{{$user->id}}" class="btn btn-primary">View</a>
                                @can('update', $user)
                                <a href="/users/{{$user->id}}/edit" class="btn btn-warning">Edit</a>
                                @endcan
                                @can('delete', $user)
                                <a href="/users/{{$user->id}}/delete" class="btn btn-danger">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endauth
    @guest
        <div class="container">
            <div class="card">
                <h3 class="card-header">Access Denied</h3>
                <div class="card-body">Nope.</div>
            </div>
        </div>
    @endguest
@endsection