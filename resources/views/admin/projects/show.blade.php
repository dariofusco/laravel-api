@extends('layouts.app')

@section('content')
    <div class="container py-3 text-center">

        <h1>{{ $project->name }}</h1>

        <h2>
            <span class="badge text-bg-secondary">{{ $project->type->name }}
                @foreach ($project->technologies as $technology)
                    <span class="badge text-bg-info">{{ $technology->name }}</span>
                @endforeach
            </span>
        </h2>

        <p>{{ $project->description }}</p>

        <p>{{ $project->date->format('d/m/Y') }}</p>

        <div>
            <img src="{{ asset('/storage/' . $project->image) }}" alt="" class="img-fluid" style="width: 250px">
        </div>

        <a href="{{ $project->github_link }}">GitHub Link</a>

        <div class="d-flex py-3 justify-content-center">

            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Indietro</a>

            <a class="btn btn-warning mx-2"
                href="{{ route('admin.projects.edit', ['project' => $project->id]) }}">Modifica</a>

            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Elimina</button>
            </form>

        </div>

    </div>
@endsection
