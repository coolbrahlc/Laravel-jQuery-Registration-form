
@extends('people.layout')

@section('content')
    <style>
        #map2 {
            height: 0px;
        }
    </style>

    <div id="map"></div>
    <div id="result"></div>



    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 col-sm-8 col-lg-8">

                <div id ="buttons" class="mt-4 mb-3">
                    <a href="/people" class="btn btn-primary mr-2" >See all members</a>
                    <a href="/home" class="btn btn-primary float-right">Login page</a>
                </div>

                <div id="first" class="card uper mt-3 mb-5 " >
                    <div class="card-header">

                        <h4>To participate in the conference, please fill out the form:</h4>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>

                        @if ($errors->any())
                            <b class="alert alert-danger" ></b>

                            <div class="alert alert-danger" >
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        <form id="data" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="name" >Name:</label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="price">Last name :</label>
                                <input type="text" class="form-control" name="last_name" />
                            </div>
                            <div class="form-group">
                                <label for="quantity">Birth:</label>
                                <input type="date" name="birth" min="1000-01-01"
                                       max="2019-01-31" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Subject:</label>
                                <input type="text" class="form-control" name="subject" />
                            </div>
                            <div class="form-group">
                                <label for="quantity">Country:</label>
                                <select class="form-control bfh-countries" data-country="US" name="country"></select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Email:</label>
                                <input type="email" class="form-control" name="email" required/>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Phone:</label>
                                <input type="text" class="form-control input-medium bfh-phone" name="phone" data-format="+1 (ddd) ddd-dddd">

                            </div>
                            <button type="submit" class="btn  btn-success btn-lg  float-right">Next</button>
                        </form>
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
                    url: '/people',
                    type: 'POST',
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data, textStatus, request){
                        $('#first').hide();
                        $('#buttons').hide();
                        $('#result').html(data);
                        $('#result').show();
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
