@extends('people.layout')

@section('content')


    <div class="container">

    <div class="uper mt-3">
        <a href="/" class="btn btn-primary  mb-3 mr-2" >Back to form</a>
        <a href="/home" class="btn btn-primary mb-3 mr-2 pull-right" >Login page</a>


        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <table class="table table-striped " >
            <thead>
            <tr>
                <td>Photo</td>
                <td width="300">Name</td>
                <td>Subject</td>
                <td>Email</td>
                @auth <td>Hidden</td> @endauth


            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr >
                    <td>
                        <div class="mw-50 h-75">
                            <img src="@if ($user->photo) {{ asset('images/'.$user->photo) }} @else {{ asset('images/default.png') }} @endif" class="img-thumbnail img-responsive" style="width:16%"/>
                        </div>
                    </td>
                    <td><div class="h-75" style="height:75px;">{{ $user->name.'  '.$user->last_name }}</div></td>
                    <td><div style="height:75px;">{{ $user->subject }}</div></td>
                    <td><div style="height:75px;"><a href="mailto:{{ $user->email }}" >{{ $user->email }}</a></div></td>
                    @auth <td><div style="height:75px;"><input type="checkbox" id="myCheckbox{{$user->id}}"  value="0"  @if ($user->hidden ==1)  checked @endif ></div></td> @endauth


                </tr>

                <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                        crossorigin="anonymous"></script>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

                <script>
                    $('#myCheckbox{{ $user->id }}').on('change', function(){

                        this.value = this.checked ? 1 : 0;
                        let obj = {};
                        obj.hidden = this.value;

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: 'people/update_hidden/{{$user->id}}',
                            data: obj,
                            success: function(data) {
                                $('#changed').show();

                                //alert('Successfully changed');
                            },
                            error: function() {
                                alert('it broke');
                            },
                        });
                    });
                </script>
            @endforeach
            </tbody>
        </table>
            {{ $users->links() }}
     <div>
    </div>

@endsection