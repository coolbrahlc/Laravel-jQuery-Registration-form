@extends('people.layout')

@section('content')



<div id="map2"><div id="map"></div></div>
<div class="container">

    <div class="row justify-content-md-center">
        <div class="col-md-8 col-sm-8 col-lg-8">
            <div id ="buttons" class="mt-4 mb-3">
                    <a href="/people" class="btn btn-primary mr-2" >See all members</a>
                    <a href="/home" class="btn btn-primary float-right">Login page</a>
            </div>

            <div id="second" class="card uper mt-3 mb-5">

                <div  class="card-header">
                    <h4>To participate in the conference, please fill out the form:</h4>
                </div>
                <div id="second" class="card-body">

                    <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif

                        <form id="data" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="price">Photo:</label>
                                <input type="file" name="photo" class="form-control-file" >
                            </div>

                            <div class="form-group">
                                <label for="price">About:</label>
                                <textarea name="about" class="form-control" id="about" rows="5" >{{ $user->about }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Company:</label>
                                <input type="text" class="form-control" name="company" value={{ $user->lastname }} >
                            </div>

                            <div class="form-group">
                                <label for="price">Position:</label>
                                <input type="text" class="form-control" name="position" value={{ $user->position }} >
                            </div>

                            <button type="submit" class="btn  btn-success btn-lg  float-right">Next</button>
                        </form>
                    </div>
                </div>
            <div id="socials" style="display: none" class="row mt-3 mb-3 ml-1">
                 <h4>Share our form on social media:</h4>
                 <div class="col-md-6 col-md-offset-3">
                     <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fmudrevskiy-kp.groupbwt.com&layout=button_count&size=large&mobile_iframe=false&width=84&height=28&appId" width="84" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                     <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="{{config('custom.twitter') }}" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                     <div class="g-plus" data-action="share" data-height="24" data-href="http://mudrevskiy-kp.groupbwt.com/"></div>
                 </div>
            </div>
        </div>
    </div>
</div>


    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("form#data").submit(function(e){
                e.preventDefault();
                let formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/people/update/{{ $user->id }}',
                    type: 'POST',
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data, textStatus, request){
                        $('#second').hide();
                        $('#socials').show();
                        $('#data')[0].reset();
                    },

                    error: function(data){

                        let errors = data.responseJSON;
                        printErrorMsg(errors["errors"]);
                        console.log(errors);
                    }
                });
            });

            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');

                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
        });
    </script>

@endsection