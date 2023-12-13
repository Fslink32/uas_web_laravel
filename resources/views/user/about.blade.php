@extends('user.layouts.page')
@section('content')
    <section class="container">
        <div class="row">
            <div class="p-2 col-3">
                <div class="card">
                    <img src="{{ url("/") }}/build/images/azril.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Azril Tazidan.O.N</h5>
                        <p class="card-text">
                            NIM : 17211002
                            <br>
                            Kelas : TI-5A
                            <br>
                        </p>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            <div class="p-2 col-3">
                <div class="card">
                    <img src="{{ url("/") }}/build/images/Foto.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Miftahul Rizal</h5>
                        <p class="card-text">
                            NIM : 17211015
                            <br>
                            Kelas : TI-5A
                            <br>
                        </p>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            <div class="p-2 col-3">
                <div class="card">
                    <img src="{{ url("/") }}/build/images/zakhy.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Muhamad Zakhy.S</h5>
                        <p class="card-text">
                            NIM : 17211010
                            <br>
                            Kelas : TI-5A
                            <br>
                        </p>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            <div class="p-2 col-3">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Satrio Rully.P</h5>
                        <p class="card-text">
                            NIM : 17211020
                            <br>
                            Kelas : TI-5A
                            <br>
                        </p>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
