<?php
namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(15);
        return view('salaries.index', compact('salaries'));
    }
    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('salaries.create', compact('employees'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);
        $validated['total_gaji'] = ($validated['gaji_pokok'] + $request->input('tunjangan', 0))
         - $request->input('potongan', 0);
        Salary::create($validated);
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil ditambahkan.');
    }
    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary'));
    }
    public function edit(Salary $salary)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }
    public function update(Request $request, Salary $salary)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);
        $validated['total_gaji'] = ($validated['gaji_pokok'] + $request->input('tunjangan', 0)) 
        - $request->input('potongan', 0);
        $salary->update($validated);
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil diperbarui.');
    }
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus.');
    }
}