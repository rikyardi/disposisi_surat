@extends('layouts.app')

@section('title', 'Surat Masuk')

@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Surat Masuk</h1>
            </div>

            <div class="section-body">
                
                {{-- <h2 class="section-title">Blank Page</h2> --}}
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i> Surat Baru
                </button>
                <table class="table table-hover table-responsive table-bordered mt-2 text-center">
                    <thead class="table-dark">
                        <tr>
                            <td>No</td>
                            <td>Nomor Surat</td>
                            <td>Pengirim</td>
                            <td>Perihal</td>
                            <td>Keterangan</td>
                            <td>Diinput Oleh</td>
                            <td>Tanggal</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $row)
                        <tr>
                            <th scope="row">{{ $data->firstItem() + $key }}</th>
                            <td class="fw-bolder">
                                <a href="/viewFile/masuk/{{$row->nomor_surat}}" class="fw-bolder text-decoration-none"> 
                                    {{ $row->nomor_surat }}
                                </a>
                            </td>
                            <td>{{ $row->pengirim }}</td>
                            <td>{{ $row->perihal }}</td>
                            <td>{{ $row->keterangan }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>
                                @php
                                    $date = explode(" ", $row->created_at)
                                @endphp
                                {{ $date[0] }}</td>
                            <td>
                                @if(Auth::user() && Auth::user()->role == 'atasan' )
                                    <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#modalDisposisi{{$row->id}}"><i class="fas fa-reply"></i> Disposisi</button>
                                @endif

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$row->id}}"><i class="fa fa-trash"></i> Delete</button>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                </table>
                {{ $data->links() }}
            </div>
        </section>
    </div>



    <!-- Modal New -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Surat Masuk Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('addSurat') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="exampleInputText1" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="exampleInputText1" name="nomor" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputFile1" class="form-label">File Surat</label>
                        <input type="file" class="form-control" id="exampleInputFile1" name="file" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText2" class="form-label">Pengirim</label>
                        <input type="text" class="form-control" id="exampleInputText2" name="pengirim" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText3" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="exampleInputText3" name="perihal" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText4" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="exampleInputText4" name="keterangan" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@foreach ($data as $item)
<!-- Modal Disposisi -->
    <div class="modal fade" id="modalDisposisi{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Disposisi Surat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addDisposisi') }}" method="POST">
                        @csrf
                        <div class="form-floating">
                            <p>Disposisi </p>
                            <textarea class="form-control mb-3" placeholder="Leave a comment here" id="floatingTextarea" name="disposisi" style="height: 100px"></textarea>
                        </div>
                        <input type="hidden" name="surat_id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


@foreach ($data as $item)
<div class="modal fade" id="modalDelete{{$item->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure want to delete this data?
                <p>{{$item->nomor_surat}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                <a href="/deleteSurat/{{$item->id}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
