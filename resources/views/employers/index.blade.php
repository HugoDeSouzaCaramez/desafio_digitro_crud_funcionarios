@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <h1>Funcionários</h1>
            <a href="{{ route('employers.create') }}" class="btn btn-primary btn-sm" style="height: 30px;">Novo</a>
        </div>
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Pesquisar por nome" style="width: 200px;">
        </div>
        <employer-list></employer-list>
        <table class="table" id="employer-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Estado civil</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody id="employer-tbody">
                @foreach ($employers as $employer)
                <tr>
                    <td>{{ $employer->id }}</td>
                    <td><a href="{{ route('employers.edit', $employer->id) }}" title="Editar">{{ $employer->name }}</a></td>
                    <td>{{ $employer->birth_date }}</td>
                    <td>{{ $employer->email }}</td>
                    <td>{{ $employer->cpf }}</td>
                    <td>{{ $employer->civil_state }}</td>
                    <td>
                        <a href="{{ route('employers.edit', $employer->id) }}" title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                            </svg>
                        </a>
                        <form action="{{ route('employers.destroy', $employer->id) }}" method="POST" class="d-inline" title="Excluir">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="d-inline" onclick="return confirm('Tem certeza que deseja excluir este funcionario?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{ $employers->links() }}
            </ul>
        </nav>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let query = this.value;
            fetch(`/employers/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let tbody = document.getElementById('employer-tbody');
                    tbody.innerHTML = '';
                    data.forEach(employer => {
                        let row = `<tr>
                            <td>${employer.id}</td>
                            <td><a href="${employer.edit_url}" title="Editar">${employer.name}</a></td>
                            <td>${employer.email}</td>
                            <td>${employer.cpf}</td>
                            <td>${employer.civil_state}</td>
                            <td>
                                <a href="${employer.edit_url}" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                    </svg>
                                </a>
                                <form action="${employer.delete_url}" method="POST" class="d-inline" title="Excluir">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="d-inline" onclick="return confirm('Tem certeza que deseja excluir este funcionario?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>`;
                        tbody.innerHTML += row;
                    });
                });
        });
    </script>    
@endsection
