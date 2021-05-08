@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <h3>Upload Image(s)</h3>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Great ! </strong> {{session()->get('success')}}<br><br>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif

                        @if (count($errors) > 0)

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('post-upload') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Tag') }}</label>

                                <div class="col-md-6">
                                    <input id="tag" type="text" class="form-control @error('tag') is-invalid @enderror" name="tag" value="{{ old('tag') }}" required autocomplete="tag" autofocus placeholder="Tag will show for image when it is viewed">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="permission" class="col-md-4 col-form-label text-md-right">{{ __('Permission') }}</label>

                                <div class="col-md-6">
                                    <select name="permission" id="permission" class="form-control" required>
                                        <option value="">Choose permission type</option>
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Select Image(s)') }}</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file[]" required multiple>
                                </div>
                            </div>
                               <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Upload') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
