@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Api Results From Local Database</a></div>

                <div class="card-body bg-dark">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

<form action="/api/search" method="post" role="search">
    {{ csrf_field() }}
  <div class="input-group">
    <input type="text" class="form-control"  name="q" placeholder="Json Query Example - Title,Description,Filename,Original link">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
</form>
<br>

<div class="container">
  <div class="row">
    @foreach ($movies as $movie)
    <div class="col">
        <div class="card" style="width: 100%;">
 <a href="{{ $movie->link }}"><img class="card-img-top"  src="{{ asset('img')}}/{{ $movie->filename}}" alt="Card image cap"></a>
  <div class="card-body">
    <h5 class="card-title text-danger">{{ $movie->title }}</h5>
    <p class="card-text">{{ $movie->description }}</p>
    <a href="{{ $movie->link }}" class="btn btn-primary">Go To Original Site</a>
   
  </div>
</div>

   <br>   
    </div>
    @endforeach
  </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
