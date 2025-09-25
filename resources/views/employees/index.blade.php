<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Pegawai</h1>
        
        <a href="{{ route('employees.create') }}" class="btn btn-dark mb-3">Tambah Pegawai</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>   
                        <th>Tanggal Lahir</th> 
                        <th>Alamat</th>         
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->nama_lengkap }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->nomor_telepon }}</td>     
                        <td>{{ $employee->tanggal_lahir }}</td>     
                        <td>{{ $employee->alamat }}</td>            
                        <td>{{ $employee->tanggal_masuk }}</td>
                        <td>{{ $employee->status}}</td>
                        <td>
                            <form action="S" method="POST" class="d-inline">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-warning btn-sm">Show</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Data pegawai belum tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {!! $employees->links() !!}
        </div>
    </div>
</body>
</html>