@extends('layout.app-style')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Barang RPL</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-10">
                                <h5 class="card-title">List Barang RPL</h5>
                            </div>
                            <div class="col-2 mt-3">
                                <a class="btn btn-primary" href="{{ route('form.barang') }}"
                                style="background-color: #13B07E; width: 70%; border: none;">+ Tambah Barang</a>
                            </div>
                        </div>
                        <table class="table table-borderless datatable">
                            <thead>
                                <?php
                                $no = 1;
                                ?>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah Barang</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>
                                                <div class="col-2">
                                                    <form action="{{ route('deletebarang', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary"
                                                            style="background-color: #e90606; width: 40px; border: none;"><i
                                                                class="bi bi-trash"></i></button>
                                                </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('script')
@endsection
