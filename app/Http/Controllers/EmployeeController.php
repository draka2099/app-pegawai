<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string|max:50',
        ]);
        Employee::create($request->all());
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai ditambahkan.');
    }

    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee'));
    }

    public function edit(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees,email,' . $id,
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string|max:50',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validatedData);
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }



    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
