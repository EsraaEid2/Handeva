@extends('layouts.master')

@section('content')
<h1>Contact Us Message</h1>
<p><strong>User:</strong> {{ $message->user->name }}</p>
<p><strong>Subject:</strong> {{ $message->subject }}</p>
<p><strong>Message:</strong></p>
<p>{{ $message->message }}</p>

<a href="{{ route('contact_us.index') }}" class="btn btn-primary">Back</a>
@endsection