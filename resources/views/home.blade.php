

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Welcome  {{  Auth::user()->name }}
                    <a href="{{ route('get-upload')  }}"  class="btn btn-primary btn-sm" style="float: right">Add Image(s)</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @if( count(Auth::user()->images()->get()) ==0)
                            <h4>No Images</h4>
                        @else
                            <div class="alert alert-secondary" id="popUp3" style="width: 200px;float: right;display: none"></div>

                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Image Tag</th>
                                    <th>Permission Type</th>
                                    <th>Image Link</th>
                                </thead>
                                @foreach(Auth::user()->images()->get() as $key => $image)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$image->tag}}</td>
                                        <td>{{$image->permission}}</td>
                                        <td>
                                            <input type="hidden" class="form-control" id="link{{$image->id}}" value="{{route('view',$image->public_id)}}" aria-describedby="basic-addon2" >

                                            <a href="{{route('view',$image->public_id)}}" class="btn btn-success btn-sm">View</a>
                                            <a class="btn btn-success btn-sm" onclick="copy('link{{$image->id}}')" title="Copy Image Link">Copy Link</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function copy(element_id){
            var aux = document.createElement("div");
            aux.setAttribute("contentEditable", true);
            aux.innerHTML = document.getElementById(element_id).value;
            aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)");
            document.body.appendChild(aux);
            aux.focus();
            document.execCommand("copy");
            document.body.removeChild(aux);

            $("#popUp3").text("Link Copied");

            $( "#popUp3" ).show();

            setTimeout(function() {

                $( "#popUp3" ).hide();

            }, 1000);
        }

    </script>

@endsection

