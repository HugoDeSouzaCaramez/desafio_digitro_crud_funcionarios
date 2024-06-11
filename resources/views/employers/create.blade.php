@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Novo Funcionario</div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('employers.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="cpf">CPF:</label>
                                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" class="form-control" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-0" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="birth_date">Data de Nascimento:</label>
                                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="form-control" required>
                            </div>
                            <div class="form-groupm mb-3">
                                <label for="civil_state">Estado Civil:</label>
                                <select id="civil_state" name="civil_state" required>
                                    <option value="Solteiro">Solteiro</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viúvo">Viúvo</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cpfInput = document.getElementById('cpf');

            cpfInput.addEventListener('keydown', function() {
                var cpf = cpfInput.value;
                cpf = cpf.replace(/\D/g, '');
                if (cpf.length > 3 && cpf.length < 7) {
                    cpf = cpf.substring(0, 3) + '.' + cpf.substring(3);
                } else if (cpf.length > 6 && cpf.length < 10) {
                    cpf = cpf.substring(0, 3) + '.' + cpf.substring(3, 6) + '.' + cpf.substring(6);
                } else if (cpf.length >= 9) {
                    cpf = cpf.substring(0, 3) + '.' + cpf.substring(3, 6) + '.' + cpf.substring(6, 9) + '-' + cpf.substring(9, 10);
                }
                cpfInput.value = cpf;
            });
        });
    </script>
@endsection
