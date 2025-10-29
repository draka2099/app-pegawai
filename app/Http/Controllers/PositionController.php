<?php
namespace App\Http\Controllers;
use App\Models\Position;
use Illuminate\Http\Request;
class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->paginate(10);
        return view('positions.index', compact('positions'));
    }
    public function create()
    {
        return view('positions.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions',
            'gaji_pokok' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);
        Position::create($validated);
        return redirect()->route('positions.index')->with('success', 'Jabatan baru berhasil ditambahkan!');
    }
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);
        $position->update($validated);
        return redirect()->route('positions.index')->with('success', 'Data jabatan berhasil diperbarui!');
    }
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Data jabatan berhasil dihapus!');
    }
}