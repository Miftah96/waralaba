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
        <table lass="table table-bordered" id="users-table">
            <thead>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Phone</th>
                <th>Tgl. Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Daftar</th>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('member.getList') !!}',
        columns: [
            { data: 'id_card_number', name: 'id_card_number' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'date_of_birth', name: 'date_of_birth' }
            { data: 'created_at', name: 'created_at' },
        ]
    });
});
</script>
@endpush
