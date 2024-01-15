@extends('layout.template')

@section('title', 'Data List Musik')

@section('content')

    <h1>List Musik</h1>
    <a href="/musiks/create" class="btn btn-primary">Input List Musik</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Tahun</th>
                <th scope="col">Song Writer</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($musiks as $musik)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $musik->judul }}</td>
                    <td>{{ $musik->category->nama_kategori }}</td>
                    <td>{{ $musik->tahun }}</td>
                    <td>{{ $musik->songwriter }}</td>
                    <td class="text-nowrap">
                        <a href="/musik/{{ $musik['id'] }}/edit" class="btn btn-warning">Edit</a>
                        <a href="/musik/delete/{{ $musik->id }}" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $musiks->links() }}
    </div>
@endsection
