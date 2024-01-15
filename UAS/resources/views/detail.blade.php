@extends('layout.template')

@section('title', $musik ? $musik->judul : 'Detail Musik')

@section('content')
    @if ($musik)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-9">
                    <div class="card-body">
                        <h2 class="card-title">{{ $musik->judul }}</h2>
                        <p class="card-text">{{ $musik->sinopsis }}</p>
                        <p class="card-text">Kategori :
                            {{ $musik->category ? $musik->category->nama_kategori : 'Tidak ada kategori' }}</p>
                        <p class="card-text">Tahun : {{ $musik->tahun }}</p>
                        <p class="card-text">songwriter : {{ $musik->songwriter}}</p>
                        <a href="/" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="/images/{{ $musik->foto_sampul }}" class="img-fluid rounded-end" alt="...">
                </div>
            </div>
        </div>
    @else
        <p>Data Musik tidak ditemukan.</p>
    @endif
@endsection
