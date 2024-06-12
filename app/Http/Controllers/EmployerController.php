<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::orderBy('name', 'asc')->paginate(10);
        return view('employers.index', ['employers' => $employers]);
    }

    public function create()
    {
        return view('employers.create');
    }

    public function store(StoreEmployerRequest $request)
    {
        Employer::create($request->all());

        return redirect()->route('home')->with('success', 'Funcionario cadastrado com sucesso!');
    }

    public function show(Employer $employer)
    {
        return view('employers.show', compact('employer'));
    }

    public function edit($id)
    {
        $employer = Employer::findOrFail($id);
        return view('employers.edit', compact('employer'));
    }

    public function update(UpdateEmployerRequest $request, $id)
    {
        $employer = Employer::findOrFail($id);
        $employer->update($request->all());

        return redirect()->route('home')->with('success', 'Funcionario atualizado com sucesso!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $employers = Employer::where('name', 'LIKE', "%{$query}%")->get();

        return response()->json($employers->map(function ($employer) {
            return [
                'id' => $employer->id,
                'name' => $employer->name,
                'email' => $employer->email,
                'cpf' => $employer->cpf,
                'civil_state' => $employer->civil_state,
                'edit_url' => route('employers.edit', $employer->id),
                'delete_url' => route('employers.destroy', $employer->id),
            ];
        }));
    }

    public function destroy($id)
    {
        $employer = Employer::findOrFail($id);
        $employer->delete();

        return redirect()->route('employers.index')->with('success', 'Funcionario excluído com sucesso.');
    }
}