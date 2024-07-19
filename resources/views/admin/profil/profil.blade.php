<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">

</head>

<body>

    <div class="containerpp">
        <div href="" class="kembali" onclick="window.history.back();">
            <i class="fa-solid fa-reply"></i>
        </div>
        <div class="card">
            <div class="pp">
                <figure>
                    @if ($data->foto == '1')
                        <img id="previewImage"
                            src="https://static-00.iconduck.com/assets.00/user-secret-icon-434x512-87fxrwwg.png"
                            alt="">
                    @else
                        <img src="{{ asset('profil/' . $data->foto) }}" id="previewImage" alt="">
                    @endif
                </figure>
                <div class="editimg">
                    <form action="#" method="POST" id="formEditImg" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <label for="fileInput">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                        <input type="file" name="foto" id="fileInput" style="display: none;"
                            onchange="handleFileSelect(event)">
                        {{-- <button type="button" onclick="confirmCrop()">Submit</button> <!-- Change type to button --> --}}
                    </form>
                </div>
            </div>
            <div class="content">
                <h2>My Profil</h2>
                <form action="{{ route('profilupdate', $data->id_user) }}" method="POST" id="formDataUser">
                    @csrf
                    <label for="user">Username <h5>:</h5></label>
                    <input type="text" id="user" name="username" value="{{ $data->username }}">

                    <label for="jeneng">Nama <h5>:</h5></label>
                    <input type="text" id="jeneng" name="nama_lengkap" value="{{ $data->nama_lengkap }}">

                    <label for="hp">No Hp <h5>:</h5></label>
                    <input type="number" id="hp" name="telephone" style="-moz-appearance: textfield;"
                        value="{{ $data->telephone }}">

                    <label for="email">Email <h5>:</h5></label>
                    <input type="email" id="email" name="email" value="{{ $data->email }}">

                    {{-- <label for="pw">Password <h5>:</h5></label>
                    <input type="password" id="password" name="password">
                    <div class="mata">
                        <i class="fa-solid fa-eye" id="eyeIcon" onclick="togglePassword()"></i>
                    </div> --}}
                    <button type="submit">
                        Simpan
                    </button>
                </form>
            </div>
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
    <script>
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
                    url: '{{ route('fotoprofilupdate', $data->id_user) }}', // Use Laravel route helper
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
    </script>
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
            }
        }

        function cancelCrop() {
            // Hide overlay without applying crop
            document.getElementById('cropOverlay').style.display = 'none';

            // Destroy cropper
            cropper.destroy();
        }

        function submitForms() {
            document.getElementById("formEditImg").submit();
            document.getElementById("formDataUser").submit();
        }

        function togglePassword() {
            var pwInput = document.getElementById("pw");
            var eyeIcon = document.getElementById("eyeIcon");

            if (pwInput.type === "password") {
                pwInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                pwInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }


        // kembali
        // public function kembali()
        // {
        //     return redirect()->back();
        // }
    </script> --}}
</body>

</html>
