@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Upload Image(s)</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('post-upload') }}" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="form-group row">

                            </div>
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
                        <br />
                        <div class="progress hide" >
                            <div class="progress-bar" role="progressbar" aria-valuenow=""
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                0%
                            </div>
                        </div>
                        <br />
                        <div id="success">

                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

            $('form').ajaxForm({
                beforeSend:function(){
                    $(".progress").removeClass("hide");
                    $('#success').empty();
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {

                        $('.progress-bar').text('0%');
                        $('.progress-bar').css('width', '0%');
                        $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }
                    if(data.success)
                    {
                        $('.progress-bar').text('Uploaded');
                        $('.progress-bar').css('width', '100%');
                        $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                        $('#success').append(data.image);
                        $('#form').trigger("reset");
                    }
                }
            });

        });
    </script>
@endsection

