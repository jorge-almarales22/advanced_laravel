@extends('layouts.app')
@push('js')
    <script>window.csrfToken='{!! csrf_token() !!}'; window.users = {!! json_encode($users) !!}</script>
    <script src="{{ asset('js/master.js') }}"></script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="alert alert-success d-none" role="alert" id="alert">
                
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard Social') }} {{ $users->only(3)->first()->email }} </div>
                <form action="{{ route('addGroups') }}" method="POST" class="card-body">
                    @csrf
                         @foreach ($groups as $item)
                             <div class="form-check my-2">
                                 <input 
                                 class="form-check-input" type="checkbox" name="groups[]" value="{{ $item->id }}">
                                 <label class="form-check-label">
                                 {{ $item->name }}
                                 </label>
                             </div>
                         @endforeach
                    <button class="btn btn-primary btn-lg btn-block">Add</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All groups of user</div>
                <form action="{{ route('addGroups') }}" method="POST" class="card-body">
                    @csrf
                    <ul>
                    @foreach ($users as $groups)
                        @forelse ($groups->groups as $item)
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" name="groups[]" value="{{ $item->id }}">
                                <label class="form-check-label">
                                {{ $item->name }}
                                <a href="{{ route('remove-groups', $item->id ) }}" class="btn btn-danger btn-sm remove">Eliminar</a>
                                </label>
                            </div>
                            @empty                            
                        @endforelse
                    @endforeach
                    </ul>
                    <button class="btn btn-primary btn-lg btn-block">Add</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Write posts</div>
                <form id="addPosts" action="{{ route('responseJson') }}" method="POST" class="card-body">
                    @csrf
                    <div class="form-group">
                        <input id="title" type="text" class="form-control" name="title">
                    </div>
                    <button class="btn btn-primary btn-lg btn-block">Add</button>
                </form>
                {{-- <form id="addPosts" action="{{ route('addPosts') }}" method="POST" class="card-body">
                    @csrf
                    <div class="form-group">
                        <input id="title" type="text" class="form-control" name="title">
                    </div>
                    <button class="btn btn-primary btn-lg btn-block">Add</button>
                </form> --}}
            </div>
        </div>
    </div>
</div>
@endsection
