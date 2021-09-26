@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ !isset($id) ? 'New Member' : 'Edit Member' }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="{{ isset($data['id']) ? route('member.update', $data['id']) : route('member.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($data['id']))
            @method('PUT')
            @endif
            <div class="form-group row">
                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Foto KTP') }}</label>

                <div class="col-md-6">
                    <!-- <input id="photo" type="number" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ isset($data['id']) ? old('photo') : '' }}" required autocomplete="photo" autofocus> -->
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"" value="{{ old('photo') }}">
                    @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="id_card_number" class="col-md-4 col-form-label text-md-right">{{ __('No KTP') }}</label>

                <div class="col-md-6">
                    <input id="id_card_number" type="number" class="form-control @error('id_card_number') is-invalid @enderror" name="id_card_number" value="{{ isset($data['id']) ? $data['query']->id_card_number : '' }}" required autocomplete="id_card_number" autofocus>

                    @error('id_card_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($data['id']) ? $data['query']->name : '' }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                <div class="col-md-6">
                    <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ isset($data['id']) ? $data['query']->date_of_birth : '' }}" required autocomplete="date_of_birth" autofocus>

                    @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>

                <div class="col-md-6">
                    <!-- <input id="gender" type="date" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ isset($data['id']) ?  old('gender') : '' }}" required autocomplete="gender" autofocus> -->
                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ isset($data['id']) ?  old('gender') : '' }}" required autocomplete="gender" autofocus>
                        <option value="l">Laki - Laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ isset($data['id']) ? $data['query']->phone : '' }}" required autocomplete="phone" autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                <div class="col-md-6">
                    <!-- <input id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ isset($data['id']) ?  old('level') : '' }}" required autocomplete="level" autofocus> -->
                    <select class="form-control @error('level') is-invalid @enderror" name="level" value="{{ isset($data['id']) ?  old('level') : '' }}" required autocomplete="level" autofocus>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                    @error('level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($data['id']) ? $data['query']->email : '' }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @if(!isset($data['id']))
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @endif
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($data['id']) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
            </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
});
</script>
@endpush
