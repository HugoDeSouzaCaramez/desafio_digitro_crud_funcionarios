@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/cpfFormatter.js') }}"></script>
    <div class="container">
        <h1>Cadastrar Funcionário</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('employers.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" class="form-control" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
            </div>
            <div class="form-group mb-3">
                <label for="birth_date">Data de Nascimento:</label>
                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="form-control" min="1900-01-01" max="9999-12-31" required>
            </div>
            <div class="form-group mb-3">
                <label for="civil_state">Estado Civil:</label>
                <select id="civil_state" name="civil_state" class="form-control" required>
                    <option value="Solteiro" {{ old('civil_state') == 'Solteiro' ? 'selected' : '' }}>Solteiro</option>
                    <option value="Casado" {{ old('civil_state') == 'Casado' ? 'selected' : '' }}>Casado</option>
                    <option value="Divorciado" {{ old('civil_state') == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                    <option value="Viúvo" {{ old('civil_state') == 'Viúvo' ? 'selected' : '' }}>Viúvo</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-sm" style="height: 30px;">Salvar</button>
            </div>
        </form>
    </div>
@endsection
