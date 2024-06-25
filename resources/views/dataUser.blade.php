@extends('layouts.app')

@section('title', 'Data User')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data User</h1>
            </div>

            <div class="section-body">
                <table class="table table-hover table-responsive table-bordered mt-2 text-center">
                    <thead class="table-dark">
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($data as $key => $row)
                        <tr>
                            <th scope="row">{{ $data->firstItem() + $key }}</th>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->role }}</td>
                            <td>
                                @if($row->role == 'atasan')
                                    <form action="/user/demote/{{ $row->id }}" method="post">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{ $row->id }}">
                                        <button type="submit" class="btn btn-warning m-2"><i class="fas fa-level-down-alt"></i> Demote</button>
                                    </form>
                                @else
                                    <form action="/user/promote/{{ $row->id }}" method="post">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{ $row->id }}">
                                        <button type="submit" class="btn btn-primary m-2"><i class="fas fa-level-up-alt"></i> Promosikan</button>
                                    </form>
                                @endif
                                <a href="/user/delete/{{$row->id}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
        </section>
    </div>



    <!-- Modal -->
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
                        <input type="text" class="form-control" id="exampleInputText1" name="nomor">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputFile1" class="form-label">File Surat</label>
                        <input type="file" class="form-control" id="exampleInputFile1" name="file">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText2" class="form-label">Pengirim</label>
                        <input type="text" class="form-control" id="exampleInputText2" name="pengirim">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText3" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="exampleInputText3" name="perihal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText4" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="exampleInputText4" name="keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
@endsection
