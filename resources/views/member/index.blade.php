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
        <a href="{{ route('member.create') }}">Add Member</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No KTP</th>
                    <th>Nama</th>
                    <th>Phone</th>
                    <th>Tgl. Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Daftar</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($query as $row)
                    <tr>
                        <td>{{ $row->id_card_number }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->date_of_birth }}</td>
                        <td>{{ $row->gender }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            <a href="{{ route('member.show', $row->id) }}">View</a>
                            <a href="{{ route('member.edit', $row->id) }}">Edit</a>
                            <form method="POST" action="{{ route('member.destroy', $row->id) }}">
                               @csrf
                                @method('DELETE')
            
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
</script>
@endpush
