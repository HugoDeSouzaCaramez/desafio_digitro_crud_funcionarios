@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <h1>Editar Horas Lançadas</h1>
    
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <form action="{{ route('working-hours.update', $workingHour->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="employer_id" value="{{ $workingHour->employer_id }}">
                <div class="form-group mb-3">
                    <label for="employer">Funcionario</label>
                    <input type="text" class="form-control" id="employer" name="employer" value="{{ $workingHour->employer->name }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $workingHour->employer->cpf }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="hours_worked">Horas Lançadas</label>
                    <input type="number" class="form-control" id="hours_worked" name="hours_worked" value="{{ $workingHour->hours_worked }}" min="0" max="99999" required>
                </div>
                <div class="form-group mb-3">
                    <label for="date">Data</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $workingHour->date }}" required>
                </div>
    
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm" style="height: 30px;">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
