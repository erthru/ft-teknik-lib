@extends("admin.layout")
@section("title", "Admin Dashboard Tambah Anggota")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/member">Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Tambah Anggota Baru</strong>
            </div>

            <div class="card-body">
                @if(session("error"))
                    <div class="alert alert-danger">{{ session("error") }}</div>
                @endif

                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                @endforeach

                <form method="post" action="/admin/member/add">
                    @csrf

                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" placeholder="Masukan NIM" name="nim" value="{{ old('nim') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukan nama lengkap" name="full_name" value="{{ old('full_name') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Telp (HP)</label>
                        <input type="text" class="form-control" placeholder="Masukan No. Telp (Handphone)" name="phone" value="{{ old('phone') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Masukan alamat" name="address" value="{{ old('address') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="MEN">Laki-Laki</option>
                            <option value="WOMEN">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <select name="major_id" class="form-control" id="selectMajor" required>
                            <option value="">Pilih jurusan</option>
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <select name="study_program_id" class="form-control" id="selectStudyProgram" required disabled>
                            <option value="">Pilih prodi</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $("#selectMajor").on("change", function(){
                if(this.value != ""){
                    $("#selectStudyProgram option:first").text("Memuat data...");
                    getStudyProgram(this.value);
                }else{
                    $("#selectStudyProgram").attr("disabled", "");
                    $("#selectStudyProgram").find("option").remove().end()
                    $("#selectStudyProgram").append(new Option("Pilih prodi", ""));
                }
            });

            function getStudyProgram(id){
                $.get("/admin/study_program/json/data/by_major_id?id="+id, function(data) {
                    $("#selectStudyProgram").removeAttr("disabled");
                    $("#selectStudyProgram").find("option").remove().end()
                    $("#selectStudyProgram").append(new Option("Pilih prodi", ""));
                    
                    for(let i=0; i<data.length; i++){
                        $("#selectStudyProgram").append(new Option(data[i].name, data[i].id));
                    }
                });
            }
        });
    </script>
@endsection