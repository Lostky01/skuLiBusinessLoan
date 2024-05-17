@extends('layout.app-style')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Peminjaman</h1>
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
                        <h5 class="card-title">List Pinjam Barang RPL</h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <?php
                                $no = 1;
                                ?>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Tanggal/Jam</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Pelajaran</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Status</th>
                                    @if (session('role') == 'Admin')
                                    <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        @if($item->kode_barang != '')
                                        <td>{{ $item->kode_barang }}</td>
                                        @else
                                        <td>-</td>
                                        @endif
                                        <td>{{ $item->pelajaran }}</td>
                                        <td>{{ $item->nama_guru }}</td>
                                        @if ($item->status == 'Belum Dikembalikan')
                                            <td><span class="badge text-bg-warning">{{ $item->status }}</span></td>
                                        @else
                                            <td><span class="badge text-bg-success">{{ $item->status }}</span></td>
                                        @endif
                                        @if (session('role') == 'Admin' || session('role') == '1')
                                        <td>
                                            <div class="row">
                                                <div class="col-3">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('datapinjam.formeditpinjam', $item->id) }}"
                                                        style="background-color: #13B07E; width: 40px; border: none;"><i class="bi bi-pencil"></i></a>
                                                </div>
                                                <div class="col-3">
                                                    <form action="{{ route('deletepinjam', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary"
                                                            style="background-color: #e90606; width: 40px; border: none;"><i
                                                                class="bi bi-trash"></i></button>
                                                </div>
                                                </form>
                                            </div>
                                        </td>
                                        @endif
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
