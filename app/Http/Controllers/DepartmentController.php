<?php
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }
    private function getDepartmentOptions()
    {
        return [
            'Departemen Ilmu Ekonomi', 'Departemen Manajemen', 'Departemen Akuntansi', 
            'Departemen Teknik Sipil', 'Departemen Teknik Mesin', 'Departemen Teknik Komputer',
            'Departemen Arsitektur', 'Departemen Elektro', 'Departemen Hukum'
        ];
    }
    public function create()
    {
        $departmentOptions = $this->getDepartmentOptions();
        return view('departments.create', compact('departmentOptions'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments',
            'deskripsi' => 'nullable|string',
        ]);

        Department::create($validated);
        return redirect()->route('departments.index')->with('success', 'Departemen berhasil ditambahkan.');
    }
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }
    public function edit(Department $department)
    {
        $departmentOptions = $this->getDepartmentOptions();
        return view('departments.edit', compact('department', 'departmentOptions'));
    }
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen,' . $department->id,
            'deskripsi' => 'nullable|string',
        ]);
        $department->update($validated);
        return redirect()->route('departments.index')->with('success', 'Data departemen berhasil diperbarui.');
    }
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Data departemen berhasil dihapus.');
    }
}