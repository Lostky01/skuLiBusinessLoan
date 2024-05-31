@extends('layout.app-style')
@section('content')
    <main id="main" class="main">
        <section class="form">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto p-5 br-5">
                        <form action="{{ route('databarang.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h2 class="nav-heading" style="font-family: 'General Sans', sans-serif;font-weight:500">Form
                                Add Barang</h2>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%;">
                                    <span>Kode Barang</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="kodebarang" name="kodebarang" value="{{ old('kodebarang') }}"
                                    style="padding: 15px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.636); background: #F0F2F5; line-height: normal; border-radius: 10px"
                                    placeholder="">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-2" style="line-height: -5%;">
                                    <span>Nama Barang</span>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="namabarang" name="namabarang" value="{{ old('namabarang') }}"
                                    style="padding: 15px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.636); background: #F0F2F5; line-height: normal; border-radius: 10px"
                                    placeholder="">
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
@endsection
