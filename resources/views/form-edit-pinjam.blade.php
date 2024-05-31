@extends('layout.app-style')
@section('content')
    <main id="main" class="main">
        <section class="form">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto p-5 br-5">
                        <form action="{{ route('datapinjam.update', $data->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h2 class="nav-heading" style="font-family: 'General Sans', sans-serif;font-weight:500">Form Edit
                                Peminjaman</h2>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Kelas/Jurusan</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="kelas" name="kelas" value="{{ $data->kelas }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Kode Barang</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="kodebarang" name="kodebarang" value="{{ $data->kode_barang }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%;">
                                    <span>Nama Barang</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="namabarang" name="namabarang" value="{{ $data->nama_barang }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px"
                                        readonly>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Mata Pelajaran</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="mapel" name="mapel" value="{{ $data->pelajaran }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Nama Guru</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="namaguru" name="namaguru" value="{{ $data->nama_guru }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Status</span>
                                </div>
                                <div class="col-10">
                                    <select class="form-select" aria-label="select example" name="status" id="status"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                        <option value="Belum Dikembalikan"
                                            @if ($data->status == 'Belum Dikembalikan') selected @endif>Belum Dikembalikan</option>
                                        <option value="Sudah Dikembalikan"
                                            @if ($data->status == 'Sudah Dikembalikan') selected @endif>Sudah Dikembalikan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">

                                </div>
                                <div class="col-10">
                                    <button class="btn btn-primary" type="submit"
                                        style="background-color: #13B07E; width: 10vh; border: none;">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('show');
        }

        function selectItem(item) {
            var inputField = document.getElementById('namabarang');
            inputField.value = item;
            toggleDropdown();
        }

        function updateCodeField(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedId = selectedOption.value;
            var selectedText = selectedOption.text;

            var codeInput = document.getElementById('code');

            if (selectedId) {
                codeInput.value = selectedId;
                codeInput.setAttribute('data-text', selectedText);
            } else {
                codeInput.value = '';
                codeInput.removeAttribute('data-text');
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#kodebarang").on('input', function() {
                var kode = $(this).val();
                if (kode) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('info.getNameEdit') }}", // Make sure this route is correct
                        data: {
                            kode: kode
                        }, // Send the kode as a parameter
                        success: function(result) {
                            if (result.msg === 'berhasil') {
                                $('#namabarang').val(result
                                    .data); // Set the value of the text input
                            } else {
                                $('#namabarang').val('No data found');
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.responseText);
                            alert(xhr.responseText);
                        }
                    });
                } else {
                    $('#namabarang').val(''); // Clear the text input if kode is empty
                }
            });
        });
    </script>
@endsection
