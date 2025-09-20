@extends('layouts.app')
@section('content')
  <h3>Login</h3>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div><input name="email" value="{{ old('email') }}" placeholder="email"></div>
    <div><input name="password" type="password" placeholder="password"></div>
    <button>Login</button>
    @error('email') <div style="color:red">{{ $message }}</div>@enderror
  </form>
@endsection
