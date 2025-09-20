@extends('layouts.app')
@section('content')
  <h3>Short URLs</h3>

  <form method="POST" action="{{ route('short-urls.store') }}">
    @csrf
    <div>
      <input name="original_url" placeholder="https://example.com" style="width:400px" value="{{ old('original_url') }}">
      <label><input type="checkbox" name="is_public"> Public</label>
      <button>Create</button>
    </div>
    @error('original_url') <div style="color:red">{{ $message }}</div> @enderror
  </form>

  <p><a href="{{ route('short-urls.download') }}">Download CSV</a></p>

  <table border="1" cellpadding="6">
    <tr><th>Short</th><th>Original</th><th>Created by</th><th>Public</th></tr>
    @foreach($urls as $u)
      <tr>
        <td><a href="{{ url('/r/'.$u->code) }}">{{ url('/r/'.$u->code) }}</a></td>
        <td>{{ $u->original_url }}</td>
        <td>{{ $u->creator->name ?? '—' }}</td>
        <td>{{ $u->is_public ? 'Yes' : 'No' }}</td>
      </tr>
    @endforeach
  </table>

  {{ $urls->links() ?? '' }}
@endsection
