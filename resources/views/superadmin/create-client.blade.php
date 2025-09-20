@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Client</h2>
    <form action="{{ route('superadmin.clients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Client Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" class="form-control" id="company" name="company">
        </div>
        <button type="submit" class="btn btn-primary">Create Client</button>
    </form>
</div>
@endsection