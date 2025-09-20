@extends('layouts.app')
@section('content')
  <h2>Super Admin Dashboard</h2>
  <a href="{{ route('clients.create') }}">Invite / Create Client</a>
  <h3>Clients</h3>
  <table border="1" cellpadding="6">
    <tr><th>Name</th><th>Users</th></tr>
    @foreach($clients as $c)
      <tr><td>{{ $c->name }}</td><td>{{ $c->users_count ?? 0 }}</td></tr>
    @endforeach
  </table>

  <h3>Recent Short URLs</h3>
  <a href="{{ route('short-urls.index') }}">View all</a> | <a href="{{ route('short-urls.download') }}">Download</a>
  <ul>
    @foreach($shortUrls as $s)
      <li>{{ url('/r/'.$s->code) }} → {{ $s->original_url }}</li>
    @endforeach
  </ul>
@endsection
