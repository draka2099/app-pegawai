<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; 

class AttendanceController extends Controller
{
    public function index(){
        $attendances = Attendance::with('employee')->latest()->paginate(15);
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('attendances.index', compact('attendances', 'employees'));
    }
    public function create(){
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('attendances.create', compact('employees'));
    }
    public function store(Request $request){
    try {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => ['required', 'date_format:H:i,H:i:s'],
            'waktu_keluar' => ['nullable', 'date_format:H:i,H:i:s', 'after:waktu_masuk'],
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);
        if (!empty($validated['waktu_masuk'])) {
            $validated['waktu_masuk'] = Carbon::parse($validated['waktu_masuk'])->format('H:i:s');
        }
        if (!empty($validated['waktu_keluar'])) {
            $validated['waktu_keluar'] = Carbon::parse($validated['waktu_keluar'])->format('H:i:s');
        } else {
            $validated['waktu_keluar'] = null;}
        Attendance::create($validated);
        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil ditambahkan.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
    }}
    public function show(Attendance $attendance){
        return view('attendances.show', compact('attendance'));
    }
    public function edit(Attendance $attendance){
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('attendances.edit', compact('attendance', 'employees'));
    }
    public function update(Request $request, Attendance $attendance){
    try {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => ['required', 'date_format:H:i,H:i:s'],
            'waktu_keluar' => ['nullable', 'date_format:H:i,H:i:s', 'after:waktu_masuk'],
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);
        if (!empty($validated['waktu_masuk'])) {
            $validated['waktu_masuk'] = Carbon::parse($validated['waktu_masuk'])->format('H:i:s');
        }
        if (!empty($validated['waktu_keluar'])) {
            $validated['waktu_keluar'] = Carbon::parse($validated['waktu_keluar'])->format('H:i:s');
        } else {
            $validated['waktu_keluar'] = null;
        }
        $attendance->update($validated);
        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil diperbarui.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput()
            ->with('error_modal_id', $attendance->id);
    }}
    public function destroy(Attendance $attendance){
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil dihapus.');
    }
}

