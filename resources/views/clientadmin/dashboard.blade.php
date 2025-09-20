@extends('layouts.app')
@section('content')
  <h2>Client Admin Dashboard</h2>
  <a href="{{ route('short-urls.index') }}">Generated Short URLs</a> |
  <a href="{{ route('team.create') }}">Invite Team Member</a>
  <h3>Team Members</h3>
  <table border="1" cellpadding="6">
    <tr><th>Name</th><th>Email</th><th>Role</th></tr>
    @foreach($team as $t)
      <tr><td>{{ $t->name }}</td><td>{{ $t->email }}</td><td>{{ $t->role->name ?? '' }}</td></tr>
    @endforeach
  </table>
@endsection
