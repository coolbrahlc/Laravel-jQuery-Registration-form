@extends('admin.admin_layout')

@section('content')

<div class="container">

<div class="uper mt-3">

    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Last Name</td>
            <td>Hidden</td>

            <td colspan="2">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->last_name}}</td>

        <td>
            <input type="checkbox" id="myCheckbox{{$user->id}}"  value="0" @if ($user->hidden ===1) checked @endif>
        </td>

        <td>
            <form action="{{ route('admin.destroy', $user->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
        </tr>

        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

        <script>
            $('#myCheckbox{{ $user->id  }}').on('change', function(){

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
                    url: 'admin/update/{{$user->id}}',
                    data: obj,
                    success: function(data) {
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
</div>
</div>

@endsection