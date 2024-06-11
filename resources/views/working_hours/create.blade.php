@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <h1>Cadastrar Horas Lançadas</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('working-hours.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="employer_id">Funcionario:</label>
                <select name="employer_id" id="employer_id" class="form-control" required>
                    @foreach($employers as $employer)
                        <option value="{{ $employer->id }}">{{ $employer->id }}: {{ $employer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="date">Data:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="form-group mb-3">
                <label for="hours_worked">Horas Trabalhadas:</label>
                <input type="number" class="form-control" id="hours_worked" name="hours_worked" min="0" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection
