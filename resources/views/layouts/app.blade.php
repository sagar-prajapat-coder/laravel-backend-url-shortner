<!doctype html>
<html>
<head><meta charset="utf-8"><title>Shortly</title></head>
<body>
  <div style="padding:12px; border-bottom:1px solid #ddd;">
    <a href="{{ route('dashboard') }}">Dashboard</a>
    @auth
      <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button style="float:right">Logout</button>
      </form>
    @endauth
  </div>
  <div style="padding:20px;">
    @if(session('success')) <div style="background:#dfd;padding:8px">{{ session('success') }}</div> @endif
    @yield('content')
  </div>
</body>
</html>
