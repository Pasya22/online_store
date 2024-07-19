@extends('layouts.app')
@section('title', 'Edit Data Produk')

@section('content')
    <div class="tambahdataproduk">
        <style>
            .gambar-barang-edit {
                width: 100px;
                height: 100px;
                position: absolute;
                right: 0;
            }
        </style>
        <div class="container">
            <h2>Edit Data Barang</h2>
            <form action="{{ route('editdatabarangsubmit', $data['data_barang']->id_barang) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group label-select-container">
                    <label for="kategori">Kategori:</label>
                    <select id="kategori" name="kategori">
                        @foreach ($data['data_kategori'] as $item)
                            {{-- Periksa apakah kategori saat ini sama dengan kategori yang ingin ditampilkan --}}
                            @if ($item->id_kategori == $data['data_barang']->id_kategori)
                                <option value="{{ $item->id_kategori }}" selected>{{ $item->nama_kategori }}</option>
                            @else
                                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- <input type="hidden" value="{{ $data['data_barang']->id_barang }}"> --}}
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" id="nama_barang" value="{{ $data['data_barang']->nama_barang }}"
                        name="nama_barang" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" id="harga" name="harga" value="{{ $data['data_barang']->harga }}" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" id="stok" name="stok" value="{{ $data['data_barang']->stok }}" required>
                </div>
                <img src="{{ asset('upload/' . $data['data_barang']->gambar) }}" class="gambar-barang-edit"
                    alt="Gambar Barang">
                <div class="form-group">
                    <label for="fileInput">Gambar:</label>
                    <input type="file" id="fileInput" name="gambar" accept="image/*"  onchange="handleFileSelect(event)">
                </div>
                <div class="form-group">
                    <button type="submit">Edit Barang</button>
                </div>
            </form>
        </div>
    </div>

        <div class="overlay" id="cropOverlay">
        <div class="cropper-container">
            <img src="" alt="" id="cropperImage">
            <div class="cropper-buttons">
                <button onclick="confirmCrop()"><i class="fa-solid fa-circle-check"></i></button>
                <button onclick="cancelCrop()"><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
    {{-- <script>
        var cropper;
        var selectedFile;

        function handleFileSelect(event) {
            // Hapus kanvas cropper jika ada
            if (cropper) {
                cropper.destroy();
            }

            selectedFile = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('cropperImage');
                output.src = dataURL;

                // Show crop overlay
                document.getElementById('cropOverlay').style.display = 'block';

                // Initialize cropper on overlay
                cropper = new Cropper(output, {
                    aspectRatio: 1, // Set aspect ratio (optional)
                    viewMode: 1, // Set view mode (optional)
                });
            };
            reader.readAsDataURL(selectedFile);
        }

        function confirmCrop() {
            if (cropper) {
                // Get cropped image data
                var canvas = cropper.getCroppedCanvas();
                var croppedImageData = canvas.toDataURL();

                // Update preview image with cropped image
                var previewImage = document.getElementById('previewImage');
                previewImage.src = croppedImageData;

                // Hide overlay
                document.getElementById('cropOverlay').style.display = 'none';

                // Destroy cropper
                cropper.destroy();

                // Send cropped image data to server using Ajax
                var formData = new FormData();
                formData.append('foto', dataURLtoFile(croppedImageData,
                    'cropped_image.png')); // Convert data URL to File object
                formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token if necessary

                // Ajax request
                $.ajax({
                    url: '{{ route('editdatabarang',$data['data_barang']->id_barang) }}', // Use Laravel route helper
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // If your server returns JSON response
                        // You can parse the response here and handle it accordingly
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        alert('Error uploading profile picture. Please try again.');
                    }
                });
            }
        }

        // Function to convert data URL to File object
        function dataURLtoFile(dataURL, filename) {
            var arr = dataURL.split(','),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n);

            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }

            return new File([u8arr], filename, {
                type: mime
            });
        }

                function cancelCrop() {
            // Hide overlay without applying crop
            document.getElementById('cropOverlay').style.display = 'none';

            // Destroy cropper
            cropper.destroy();
        }
    </script> --}}
@endsection
