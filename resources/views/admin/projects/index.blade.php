@extends('layouts.app')

@section('content')
    <div class="container py-3">

        <h1 class="py-3">I Miei Progetti</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Tecnologie</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Data</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">GitHub Link</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td><span class="badge text-bg-secondary">{{ $project->type->name }}</span></td>
                        <td>
                            @foreach ($project->technologies as $technology)
                                <span class="badge text-bg-info">{{ $technology->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->date->format('d/m/Y') }}</td>
                        <td><img src="{{ asset('/storage/' . $project->image) }}" alt="" class="img-fluid border"
                                style="width: 50px"></td>
                        <td><a href="{{ $project->github_link }}">{{ $project->github_link }}</a></td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.projects.show', $project->id) }}"
                                class="btn btn-info"><i class="fa-solid fa-list"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <a class="btn btn-primary" href="{{ url('/admin/dashboard') }}">Indietro</a>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success">Nuovo Progetto</a>

    </div>
@endsection
