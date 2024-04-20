<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Tambah Data Pasien</h2>
        <form id="formTambah" method="POST" action="{{ route('pasien.store') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Pasien:</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="telepon">No Telepon:</label>
                <input type="number" class="form-control" id="telepon" name="telepon">
            </div>
            <div class="form-group">
                <label for="idrs">Rumah Sakit:</label>
                <select class="form-control" id="idrs" name="idrs">
                    <option value="">Pilih Rumah Sakit</option>
                    @foreach($rumahsakit as $rs)
                        <option value="{{ $rs->id }}">{{ $rs->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <hr>

        <h2>Data Pasien</h2>
        <table id="dataPasien" class="table">
            <thead>
                <tr>
                    <th>Nama Pasien </th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Nama rumah sakit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pasien as $pasien)
                <tr id="row-{{ $pasien->id }}">
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->no_telepon }}</td>
                    <td>{{ $pasien->rumahSakit->nama }}</td>
                    <td>
                        <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-warning">Edit</a>
                        <form id="formHapus-{{ $pasien->id }}" method="POST" action="{{ route('pasien.destroy', $pasien->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-hapus" data-id="{{ $pasien->id }}">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('rumahsakit.index') }}" class="btn btn-primary">Ke Halaman Rumah Sakit</a>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#formTambah').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route("pasien.store") }}',
            data: formData,
            success: function(response) {
                console.log(response);
                alert('Data pasien berhasil ditambahkan');

                $('#dataPasien tbody').append(
                    '<tr>' +
                        '<td>' + response.pasien.nama + '</td>' +
                        '<td>' + response.pasien.alamat + '</td>' +
                        '<td>' + response.pasien.no_telepon + '</td>' +
                        '<td>' + response.pasien.rumah_sakit_id + '</td>' +
                        '<td>' +
                            '<a href="#" class="btn btn-warning">Edit</a>' +
                            '<button class="btn btn-danger btn-hapus">Hapus</button>' +
                        '</td>' +
                    '</tr>'
                );
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault(); 

            var id = $(this).data('id');

            $.ajax({
                type: 'DELETE',
                url: '/pasien/' + id,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    alert('Data pasien berhasil dihapus.');
                    $('#row-' + id).remove();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
});

</script>