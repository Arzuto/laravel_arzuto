<!DOCTYPE html>
<html>
<head>
    <title>Data Rumah Sakit</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Tambah Data Rumah Sakit</h2>
        <form method="POST" action="{{ route('rumahsakit.store') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Rumah Sakit:</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <hr>

        <h2>Data Rumah Sakit</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Rumah Sakit</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rumahsakit as $rumahsakit)
                <tr>
                    <td>{{ $rumahsakit->nama }}</td>
                    <td>{{ $rumahsakit->alamat }}</td>
                    <td>{{ $rumahsakit->email }}</td>
                    <td>{{ $rumahsakit->telepon }}</td>
                    <td>
                        <a href="{{ route('rumahsakit.edit', $rumahsakit->id) }}" class="btn btn-warning">Edit</a>
                        <form method="POST" action="{{ route('rumahsakit.destroy', $rumahsakit->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
