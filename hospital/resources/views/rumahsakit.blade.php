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
        <form id="formTambah" method="POST" action="{{ route('rumahsakit.store') }}">
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
                <input type="number" class="form-control" id="telepon" name="telepon">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <hr>

        <h2>Data Rumah Sakit</h2>
        <table id="dataRumahSakit" class="table">
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
                <tr id="row-{{ $rumahsakit->id }}"> <!-- Tambahkan ID unik untuk setiap baris -->
                    <td>{{ $rumahsakit->nama }}</td>
                    <td>{{ $rumahsakit->alamat }}</td>
                    <td>{{ $rumahsakit->email }}</td>
                    <td>{{ $rumahsakit->telepon }}</td>
                    <td>
                        <a href="{{ route('rumahsakit.edit', $rumahsakit->id) }}" class="btn btn-warning">Edit</a>
                        <form id="formHapus-{{ $rumahsakit->id }}" method="POST" action="{{ route('rumahsakit.destroy', $rumahsakit->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
             url: '{{ route("rumahsakit.store") }}',
             data: formData,
             success: function(response) {
                console.log(response); // Tambahkan ini untuk memeriksa respons di konsol browser
                alert(response.message);
 
                // Update tabel dengan data yang baru
                $('#dataRumahSakit tbody').append(
                    '<tr>' +
                        '<td>' + response.rumahSakit.nama + '</td>' +
                        '<td>' + response.rumahSakit.alamat + '</td>' +
                        '<td>' + response.rumahSakit.email + '</td>' +
                        '<td>' + response.rumahSakit.telepon + '</td>' +
                        '<td>' +
                            '<a href="{{ route("rumahsakit.edit", " + response.rumahSakit.id + ") }}" class="btn btn-warning">Edit</a>' +
                            '<form class="form-hapus" id="formHapus-' + response.rumahSakit.id + '" method="POST" action="{{ route("rumahsakit.destroy", " + response.rumahSakit.id + ") }}" style="display: inline;">' +
                                '@csrf' +
                                '@method("DELETE")' +
                                '<button type="submit" class="btn btn-danger btn-hapus">Hapus</button>' +
                            '</form>' +
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

       // Event listener untuk tombol hapus
       $(document).on('click', '.btn-hapus', function(e) { // Menggunakan click event
    e.preventDefault(); // Menghentikan perilaku bawaan tombol

    var form = $(this).closest('form');

    $.ajax({
        type: 'DELETE',
        url: form.attr('action'),
        data: form.serialize(),
        success: function(response) {
            console.log(response); // Tambahkan ini untuk memeriksa respons di konsol browser
            alert(response.message);

            // Hapus baris dari tabel
            form.closest('tr').remove(); // Menghapus baris tabel yang sesuai dengan formulir yang dihapus
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
});
    });
</script>