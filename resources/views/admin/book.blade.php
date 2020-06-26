@extends("admin.layout")
@section("title", "Admin Dashboard")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buku</li>
            </ol>
        </nav>

        @if(session("success"))
            <div class="alert alert-success">{{ session("success") }}</div>
        @endif
    </div>
@endsection