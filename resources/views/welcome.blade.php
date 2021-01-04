@extends('layouts.app')

@section('content')
<form class="form justify-content-center" method="POST" action="{{ route('link')}}">
  @csrf
  <div class="row d-flex justify-content-center">
    <h1 class="h3 mb-3 font-weight-normal ">Shorten your link</h1>
  </div>
  <div class="row mb-1">
    <input type="url" class="form-control input-lg" name="link" placeholder="Enter your link here" required>
  </div>
  <div class="row mb-1">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Do it!</button>
  </div>
</form>

  @if(session('success'))
    <div class="row d-flex justify-content-center">
      <div class="alert alert-primary text-center" role="alert">
        Your new link - <a href = "{{ route('welcome') }}/{{ session('success') }}" class="alert-link">
          {{ route('welcome') }}/{{ session('success') }}
        </a>
      </div>
    </div>
  @endif

  @if(session('danger'))
    <div class="row d-flex justify-content-center">
      <div class="alert alert-danger text-center" role="alert">
        Link <a href = "{{ route('welcome') }}/{{ session('danger') }}" class="alert-link">
          {{ route('welcome') }}/{{ session('danger') }}
        </a> not found
      </div>
    </div>
  @endif
@endsection
