@extends('layouts.app')

@section('content')
    <section class="card" style="margin-bottom: 1rem;">
        <h1>Contact</h1>
        <p>Email: <a href="mailto:adittosaha77@gmail.com">adittosaha77@gmail.com</a></p>
        <p>GitHub: <a href="https://github.com/adi-77-tto" target="_blank" rel="noopener">adi-77-tto</a></p>
        <p>LinkedIn: <a href="https://www.linkedin.com/in/aditto-saha-83449535a" target="_blank" rel="noopener">Aditto Saha</a></p>
    </section>

    <section class="card">
        <h2>Send a Message</h2>
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required>

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>

            <button class="btn" type="submit">Send</button>
        </form>
    </section>
@endsection
