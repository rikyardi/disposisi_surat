@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pusdiklat Muhammadiyah</div>
                <div class="card-body">
                    <div class="jumbotron jumbotron-fluid" style="background-color: white">
                        <div class="container text-center">
                            {{-- <h2 class="display-5">Pusdiklat Muhammadiyah</h2> --}}
                            <img src="{{ asset('img/logo.png') }}" style="width:350px;height:250px;">
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
