@extends('layouts.app')

@section('title', 'Disposisi Surat')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Disposisi</h1>
            </div>
            <div class="section-body table-responsive">
                <table class="table table-hover table-responsive table-bordered mt-2 text-center data-sticky-header">
                    <thead class="table-dark">
                        <tr>
                            <td>No</th>
                            <td>Tanggal Surat</td>
                            <td>Nomor Surat Masuk</td>
                            <td>Perihal</td>
                            <td>Pengirim</td>
                            <td>Keterangan Disposisi</td>
                            <td>Keputusan</td>
                            <td>Hasil</td>
                            <td>Tindak Lanjut</td>
                            <td>Keterangan</td>
                            @if(Auth::user() && Auth::user()->role == 'atasan' )
                            <td>Aksi</td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($result as $key => $disposisi)
                        <tr>
                            <th scope="row">{{ $result->firstItem() + $key }}</th>
                            <td>
                                @php
                                    $date = explode(" ", $disposisi->created_at)
                                @endphp
                                {{ $date[0] }}
                            </td>
                            <td class="fw-bolder">
                                <a href="/viewFile/masuk/{{$disposisi->nomor_surat}}" class="fw-bolder text-decoration-none"> 
                                    {{ $disposisi->nomor_surat }}
                                </a>
                            </td>
                            <td>{{ $disposisi->perihal }}</td>
                            <td>{{ $disposisi->pengirim }}</td>

                            <td>
                                <table class="table table-hover table-responsive table-borderless mt-2 text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tgl</th>
                                            <th>Oleh</th>
                                            <th>Disposisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($disposisi->disposisi as $keterangan )
                                        <tr>
                                            <td>
                                                @php
                                                    $date = explode(" ", $keterangan->created_at)
                                                @endphp
                                                {{ $date[0] }}
                                            </td>
                                            <td>{{ $keterangan->user->name }}</td>
                                            <td>{{ $keterangan->disposisi }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">-</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </td>
                            <td>{{ $disposisi->keputusan }}</td>
                            <td>{{ $disposisi->hasil }}</td>
                            <td>{{ $disposisi->tindakan }}</td>
                            <td>{{ $disposisi->keterangan }}</td>
                            @if(Auth::user() && Auth::user()->role == 'atasan' )
                            <td>
                                    <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#editDisposisi{{ $disposisi->id }}"><i class="fas fa-edit"></i> Perbaharui</button>
                            </td>
                            @endif
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $result->links() }}

            </div>
        </section>
    </div>



    <!-- Modal -->
@foreach ($result as $item)
<div class="modal fade" id="editDisposisi{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Perbaharui Disposisi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updateDisposisi/{{ $item->id }}" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="exampleInputText1" class="form-label">Keputusan</label>
                        <input type="text" class="form-control" id="exampleInputText1" name="keputusan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText2" class="form-label">Hasil</label>
                        <input type="text" class="form-control" id="exampleInputText2" name="hasil">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText3" class="form-label">Tindakan</label>
                        <input type="text" class="form-control" id="exampleInputText3" name="tindakan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText4" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="exampleInputText4" name="keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach
@endsection
