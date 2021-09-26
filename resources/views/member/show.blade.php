@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
        <h1>Detail</h1>
        <a href="{{ route('member.edit', $query->id) }}">Edit Member</a>
        <div class="">
            <div>
                <img src="{{ $query->photo }}" alt="">
            </div>
            <div>
                <p><pre>No. KTP     : {{ $query->id_card_number }}</pre></p>
                <p><pre>Nama        : {{ $query->name }}</pre></p>
                <p><pre>Phone       : {{ $query->phone }}</pre></p>
                <p><pre>E-mail      : {{ $query->email }}</pre></p>
                <p><pre>Tgl. Lahir  : {{ $query->date_of_birth }}</pre></p>
                <p><pre>Jenis Kelamin   : {{ $query->gender }}</pre></p>
                <p><pre>Level       : {{ $query->level }}</pre></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
</script>
@endpush
