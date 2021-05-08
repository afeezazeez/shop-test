@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>   <strong>Image Tag </strong>:  {{  $image->tag }}</p>
                        <p><strong>Status </strong>: {{$image->permission}}</p>
                    </div>

                    <div class="card-body"  style="background-color: #1a202c">
                      <img src="{{$image->fetchFirstMedia()->file_url}}" width="1000" height="500">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
