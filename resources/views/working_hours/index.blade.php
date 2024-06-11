@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <h1>Horas Lançadas</h1>
            <a href="{{ route('working-hours.create') }}" class="btn btn-primary btn-sm" style="height: 30px;">Nova</a>
        </div>
        <date-search></date-search>
        <table class="table">
            <thead>
                <tr>
                    <th>Funcionario</th>
                    <th>CPF</th>
                    <th>Horas Lançadas</th>
                    <th>Data</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workingHours as $workingHour)
                <tr>
                    <td>{{ $workingHour->employer->name }}</td>
                    <td>{{ $workingHour->employer->cpf }}</td>
                    <td>{{ $workingHour->hours_worked }}</td>
                    <td>{{ $workingHour->date }}</td>
                    <td>
                        <a href="{{ route('working-hours.edit', $workingHour->id) }}" title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                            </svg>   
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{ $workingHours->links() }}
            </ul>
        </nav>
    </div>
@endsection
