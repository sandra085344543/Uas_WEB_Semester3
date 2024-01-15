@extends('layout.template')

@section('title', 'Homepage')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>List Musik</h1>
    <div class="row">
        @foreach ($musiks as $musik)
            <div class="col-lg-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $musik['judul'] }}</h5>
                                <p class="card-text">{{ $musik['sinopsis'] }}</p>
                                <a href="/musiks/{{ $musik['id'] }}" class="btn btn-primary">Lihat Selanjutnya</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="/images/{{ $musik['foto_sampul'] }}" class="img-fluid rounded-end" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $musiks->links() }}
        </div>
    </div>
@endsection
