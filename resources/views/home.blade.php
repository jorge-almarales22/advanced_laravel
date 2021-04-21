@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @php
                        $user = auth()->user();
                        $birthdate = sizeof($user->unreadNotifications);
                        if($birthdate != 0):
                            $birthdate = true;
                        endif;
                    @endphp
                    @if ($birthdate)
                        <div class="alert alert-success" role="alert">
                            @foreach ($user->notifications as $notification)
                                {{$notification->data['message']}}
                            @endforeach
                        </div>
                    @endif
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('groups') }}">Groups for users</a>
                        <form action="{{ route('addImage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="file" class="form-control" name="img">
                            </div>
                            <button class="btn btn-primary btn-lg btn-block">Add</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Images</div>

                <div class="card-body">
                    @foreach ($images as $item)
                    <h3>{{ $item->url }}</h3>
                        <img src="{{ $item->url_path }}" class="img-fluid my-2">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    
    document.addEventListener('DOMContentLoaded', ()=>{
        // let app = <?php echo json_encode($images); ?>;
        var app = @json($images);
        let resultado = 0;
        app.map((item) => {
            resultado = resultado + item.id
        })
        console.log(resultado)
        const name = document.getElementById('name');
        name.value = resultado;
    })
</script>
