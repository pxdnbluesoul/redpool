@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h3 class="card-header">Pastes</h3>
            <div class="card-body">
                <a href="/pastes/create" class="btn btn-block btn-success mb-4">Create New Paste</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Owner</th>
                        <th scope="col" class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(App\Paste::with('owner')->get() as $paste)
                        @can('view', $paste)
                        <tr>
                            <td scope="row">{{$paste->name}}</td>
                            <td>{{$paste->owner->username}}</td>
                            <td class="text-right">
                                <a href="/pastes/{{$paste->id}}" class="btn btn-primary">View</a>
                                @can('update', $paste)
                                    <a href="/pastes/{{$paste->id}}/edit" class="btn btn-warning">Edit</a>
                                @endcan
                                @can('delete', $paste)
                                    <a href="/pastes/{{$paste->id}}/delete" class="btn btn-danger">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @endcan
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection