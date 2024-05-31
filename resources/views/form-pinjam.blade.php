@extends('layout.app-style')
@section('content')
    <main id="main" class="main">
        <section class="form">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto p-5 br-5">
                        <form action="{{ route('datapinjam.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h2 class="nav-heading" style="font-family: 'General Sans', sans-serif;font-weight:500">Form
                                Peminjaman</h2>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Kelas/Jurusan</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Kode Barang</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="kodebarang" name="kodebarang" value="{{ old('kodebarang') }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%;">
                                    <span>Nama Barang</span>
                                </div>
                                <div class="col-10">
                                    <select class="js-example-basic-single form-control" id="namabarang" name="namabarang"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px"
                                        disabled>
                                        <option value="" selected disabled>Input kode terlebih dahulu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Mata Pelajaran</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="mapel" name="mapel" value="{{ old('mapel') }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%">
                                    <span>Nama Guru</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="namaguru" name="namaguru" value="{{ old('namaguru') }}"
                                        style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px">
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#kodebarang").on('input', function() {
            var id = $(this).val(); // Get the input value
            if (id) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('info.getName') }}", // Update the route to match your needs
                    data: {
                        id: id
                    }, // Send the id as a parameter
                    success: function(result) {
                        if (result.msg === 'berhasil') {
                            $('#namabarang').prop('disabled', false); // Enable the select element
                            $('#namabarang').find('option').remove().end();
                            $('#namabarang').append(result.data);
                        } else {
                            $('#namabarang').find('option').remove().end();
                            $('#namabarang').append('<option disabled>No data found</option>');
                        }
                        $('#namabarang').trigger('change');
                        $('#namabarang').select2({
                            theme: "bootstrap",
                            width: "100%"
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.responseText);
                        alert(xhr.responseText);
                    }
                });
            } else {
                $('#namabarang').prop('disabled', true); // Disable the select element
                $('#namabarang').find('option').remove().end();
                $('#namabarang').append('<option value="" selected disabled>Input kode terlebih dahulu</option>');
            }
        });
    </script>
@endsection
