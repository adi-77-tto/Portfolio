@extends('layouts.app')

@section('content')
    <div style="max-width: 460px; margin: 1.5rem auto;">
        <form class="card" action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <h1>Admin Login</h1>
            <p class="muted">Use your email and password to access admin panel.</p>

            @if ($errors->any())
                <div class="alert" style="background:#fcefed; border-color:#efc7c2;">
                    {{ $errors->first() }}
                </div>
            @endif

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <label style="display:flex; align-items:center; gap:0.45rem; margin-bottom:1rem;">
                <input type="checkbox" name="remember" value="1" style="width:auto; margin:0;">
                Remember me
            </label>

            <button class="btn" type="submit" style="width:100%;">Login</button>
        </form>
    </div>
@endsection
