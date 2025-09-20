@extends('layouts.app')

@section('content')
    <h1>Clients</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Add Client</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Users Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->users_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection