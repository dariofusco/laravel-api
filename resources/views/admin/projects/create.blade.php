@extends('layouts.app')

@section('content')
    <div class="container py-3">

        <h1 class="py-3">Nuovo Progetto</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf()

            <div class="mb-4">
                <label class="form-label fw-bold">Nome:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Tipologia:</label>
                <select class="form-select @error('type_id') is-invalid @enderror" name="type_id">
                    <option selected>seleziona la tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                    @error('type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Tecnologie:</label>
                <div>
                    @foreach ($technologies as $technology)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                                id="{{ $technology->id }}" name="technologies[]">
                            <label class="form-check-label" for="{{ $technology->id }}">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Descrizione:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Data:</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Immagine:</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">GitHub Link:</label>
                <input type="text" class="form-control @error('github_link') is-invalid @enderror" name="github_link">
                @error('github_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Indietro</a>

            <button class="btn btn-success">Crea</button>

        </form>

    </div>
@endsection
