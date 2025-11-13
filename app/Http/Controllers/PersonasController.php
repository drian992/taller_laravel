<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PersonasController extends Controller
{
    public function index(): View
    {
        $personas = Persona::whereDoesntHave('user', function ($query) {
            $query->where('role', 'admin');
        })
            ->orderByDesc('created_at')
            ->paginate(10);

        $personasEliminadas = Persona::onlyTrashed()
            ->whereDoesntHave('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->orderByDesc('deleted_at')
            ->get();

        return view('personas.index', compact('personas', 'personasEliminadas'));
    }

    public function edit(Persona $persona): View
    {
        $this->abortIfAdminRecord($persona);

        return view('personas.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona): RedirectResponse
    {
        $this->abortIfAdminRecord($persona);

        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'dni' => [
                'required',
                'string',
                'max:30',
                Rule::unique('personas', 'dni')->ignore($persona->id)->whereNull('deleted_at'),
                Rule::unique('users', 'dni')->ignore(optional($persona->user)->id),
            ],
            'telefono' => ['required', 'string', 'max:30'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('personas', 'email')->ignore($persona->id)->whereNull('deleted_at'),
                Rule::unique('users', 'email')->ignore(optional($persona->user)->id),
            ],
            'direccion' => ['required', 'string', 'max:255'],
        ]);

        $persona->update($data);

        if ($persona->user) {
            $persona->user->update([
                'name' => $data['nombre'],
                'nombre' => $data['nombre'],
                'dni' => $data['dni'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'domicilio' => $data['direccion'],
            ]);
        }

        return redirect()->route('personas.index')->with('mensaje-success', 'Datos actualizados correctamente.');
    }

    public function destroy(Persona $persona): RedirectResponse
    {
        $this->abortIfAdminRecord($persona);

        $persona->delete();

        return redirect()->route('personas.index')->with('mensaje-success', 'Registro enviado a la papelera.');
    }

    public function restaurar(int $persona): RedirectResponse
    {
        $registro = Persona::withTrashed()
            ->whereDoesntHave('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->findOrFail($persona);

        $registro->restore();

        return redirect()->route('personas.index')->with('mensaje-success', 'Registro restaurado correctamente.');
    }

    public function eliminarDefinitivo(int $persona): RedirectResponse
    {
        $registro = Persona::withTrashed()
            ->whereDoesntHave('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->findOrFail($persona);

        $registro->forceDelete();

        return redirect()->route('personas.index')->with('mensaje-success', 'Registro eliminado de forma permanente.');
    }

    private function abortIfAdminRecord(Persona $persona): void
    {
        if (optional($persona->user)->isAdmin) {
            abort(403);
        }
    }
}
