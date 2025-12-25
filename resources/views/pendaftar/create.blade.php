<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            width: 300px;
            padding: 6px;
        }
        textarea {
            height: 80px;
        }
    </style>
</head>
<body>

<h2>Form Pendaftaran PPDB</h2>

{{-- pesan sukses --}}
@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

{{-- pesan error validasi --}}
@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('pendaftar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <p>
        <label>Nama Lengkap</label><br>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
    </p>

    <p>
        <label>NISN</label><br>
        <input type="text" name="nisn" value="{{ old('nisn') }}">
    </p>

    <p>
        <label>Tempat Lahir</label><br>
        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
    </p>

    <p>
        <label>Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
    </p>

    <p>
        <label>Jenis Kelamin</label><br>
        <select name="jenis_kelamin">
            <option value="">-- Pilih --</option>
            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </p>

    <p>
        <label>Alamat Lengkap</label><br>
        <textarea name="alamat">{{ old('alamat') }}</textarea>
    </p>

    <p>
        <label>No HP / WA</label><br>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}">
    </p>

    <p>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
    </p>

    <p>
        <label>Sekolah Asal</label><br>
        <input type="text" name="sekolah_asal" value="{{ old('sekolah_asal') }}">
    </p>

    <p>
        <label>Nilai Rata-rata</label><br>
        <input type="number" step="0.01" name="nilai" value="{{ old('nilai') }}">
    </p>

    <p>
        <label>Pilihan Jurusan</label><br>
        <select name="jurusan_id">
            <option value="">-- Pilih Jurusan --</option>
            @foreach ($jurusan as $j)
                <option value="{{ $j->id }}"
                    {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                    {{ $j->nama_jurusan }}
                </option>
            @endforeach
        </select>
    </p>

    <p>
        <label>Foto Siswa</label><br>
        <input type="file" name="foto">
    </p>

    <p>
        <button type="submit">Daftar</button>
    </p>

</form>

</body>
</html>
