<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department', 'position')->latest()->paginate(15);
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get(); 

        return view('employees.index', compact('employees', 'departments', 'positions')); 
    }
    public function create()
    {
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get(); 
        return view('employees.create', compact('departments', 'positions')); 
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'nomor_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Pegawai baru berhasil ditambahkan!');
    }
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'nomor_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id', 
            'status' => 'required|in:aktif,nonaktif',
        ]);
        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}