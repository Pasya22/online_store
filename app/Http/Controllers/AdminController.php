<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // LOGIN
    public function login()
    {
        return view('login.index');
    }
    public function register()
    {
        return view('login.register');
    }
    public function loginsubmit(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mengambil data pengguna dari model
        $user = AdminModel::GetDataById('user', 'username', $validatedData['username']);

        // Jika pengguna tidak ditemukan, kembalikan pesan error
        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Username tidak ditemukan'])->withInput();
        }

        // Memeriksa apakah password cocok
        if (!password_verify($validatedData['password'], $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Password salah'])->withInput();
        }

        // Menyimpan informasi login di sesi pengguna
        session(['user' => $user]);
        // session(['id_role' => $user->id_role]);

        // Mengirimkan pesan flash session
        return redirect()->route('dashboard')->with('success', 'Login berhasil. Selamat datang di dashboard!');
    }



    // DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function pembayarann()
    {
        $data  = [];
        $totalHarga = 0; 
        return view('admin.pembayaran',compact('data','totalHarga'));
    }

    // DATABARANG
    public function databarang()
    {
        $data = AdminModel::GetData('data_barang');

        // Ambil stok barang dari database
        $stok_barang = [];
        foreach ($data as $item) {
            $stok_barang[$item->id_barang] = $item->stok; // Anda perlu sesuaikan dengan nama kolom stok barang di tabel
        }

        return view('admin.databarang', compact('data', 'stok_barang'));
        // return view('admin.databarang');
    }
    public function listbarang($id)
    {
        // Mencari barang berdasarkan ID
        // $barang = AdminModel::GetDataById('data_barang', 'id_barang', $id);

        // if (!$barang) {
        //     return response()->json(['error' => 'Barang not found'], 404);
        // }

        // // Menyiapkan data barang dalam bentuk array
        // $data = [
        //     'id_barang' => $barang->id_barang,
        //     'nama_barang' => $barang->nama_barang,
        // ];

        // return response()->json(['data' => $data], 200);
    }
    public function tambahdatabarang()
    {
        // Initialize an empty array to store product data

        $data['kategori'] = AdminModel::GetData('data_kategori');

        // Pass the fetched data to the view
        return view('admin.tambahdatabarang.tambahdata', compact('data'));
    }

    // public function uploadGambar(Request $request)
    // {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'gambar' => 'required|image|mimes:png|max:2048', // Adjust max file size and allowed file types as needed
    //     ]);

    //     // Create the directory if it doesn't exist
    //     $uploadsPath = public_path('profil');
    //     if (!File::isDirectory($uploadsPath)) {
    //         File::makeDirectory($uploadsPath, 0777, true, true);
    //     }

    //     // Check if the request has the file
    //     if ($request->hasFile('gambar')) {
    //         // Get the original file name
    //         $imageName = $request->file('gambar')->getClientOriginalName();

    //         // Move the uploaded file to the public/profil directory
    //         $request->file('gambar')->move($uploadsPath, $imageName);

    //         // Return the image file name or any relevant data
    //         return response()->json(['imageFileName' => $imageName]);
    //     }

    //     // If no file is uploaded or an error occurs, return an error response
    //     return response()->json(['error' => 'No file uploaded or an error occurred.'], 400);
    // }


    public function tambahdatabarangsubmit(Request $request)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required|image|max:2048'
        ]);

        // Check if the product with the same name already exists
        $existingProduct = AdminModel::GetDataByColumn('data_barang', 'nama_barang', $request->nama_barang);
        if ($existingProduct) {
            return back()->with('error', 'Product with the same name already exists.');
        }

        if ($request->hasFile('gambar')) {
            // Handle image upload
            $image = $request->file('gambar');
            $imageName = $image->hashName();
            $uploadPath = public_path('upload');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory(
                    $uploadPath,
                    0777,
                    true,
                    true
                );
            }

            $image->move($uploadPath, $imageName);

            // Save product details to the database
            $data = [
                'id_kategori' => $request->id_kategori,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'gambar' => $imageName,
                'created_at' => now('Asia/Jakarta')
            ];

            AdminModel::CreateData('data_barang', $data);

            return redirect()->route('databarang')->with('success', 'Product added successfully.');
        } else {
            return back()->with('error', 'Failed to upload image.');
        }
    }
    public function editdatabarang($id)
    {
        $data['data_barang'] = AdminModel::GetDataById('data_barang', 'id_barang', $id);
        $data['data_kategori'] = AdminModel::GetData('data_kategori');
        return view('admin.tambahdatabarang.editdata', compact('data'));
    }
    public function editdatabarangsubmit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            // 'gambar' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $product = DB::table('data_barang')->where('id_barang', $id)->first();

        // Check if a file has been uploaded
        if ($request->hasFile('gambar')) {
            // Handle image upload
            $uploadPath = public_path('upload');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            // Delete the old image if it exists
            if ($product->image) {
                $oldImagePath = $uploadPath . '/' . $product->image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('foto');
            $imageName = $image->hashName();
            $image->move($uploadPath, $imageName);
            DB::table('data_barang')->where('id_barang', $id)->update([
                'id_kategori' => $request->kategori,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'gambar' => $imageName, // Save the image path to the database
                'stok' => $request->stok,
            ]);
        } else {
            // Update product details without changing the image
            DB::table('data_barang')->where('id_barang', $id)->update([
                'id_kategori' => $request->kategori,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
            ]);
        }
        return redirect()->route('databarang');
    }

    // PEMBAYARAN
    public function pembayaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_barang' => 'required|array',
            'jumlah_barang.*' => 'required|integer|min:1',
        ]);

        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Memasukkan data nama_barang dan jumlah_barang ke dalam array
        $data = [];
        $totalHarga = 0; // Inisialisasi total harga

        foreach ($request->jumlah_barang as $id_barang => $jumlahBarang) {
            $barang = AdminModel::GetDataById('data_barang', 'id_barang', $id_barang);

            if ($barang) {
                $totalBarang = $jumlahBarang * $barang->harga;
                // $totalHarga += $totalBarang; // Menambahkan harga barang ke total harga

                $diskon = AdminModel::joinDataDiskonById($id_barang);
                // dd($diskon);
                if ($diskon) {
                    $totalBarang -= ($totalBarang * $diskon->diskon) / 100;
                }
                $totalHarga += $totalBarang;
                $data[] = [
                    'id_barang' => $id_barang,
                    'nama_barang' => $barang->nama_barang,
                    'jumlah_barang' => $jumlahBarang,
                    'total' => $totalBarang
                ];
            }
        }
        // dd($data);
        // return view('admin.pembayaran');
        return view('admin.pembayaran', compact('data', 'totalHarga')); // Mengirimkan total harga ke tampilan
    }
    public function bayar(Request $request)
    {
        $id_user = session('user')->id_user;
        $validatedData = [];

        foreach ($request->id_barang as $key => $id_barang) {
            $total_harga = $request->total[$key];
            $jumlah_barang = $request->jumlah_barang[$key];

            // Retrieve the item from the database
            $barang = AdminModel::GetDataById('data_barang', 'id_barang', $id_barang);

            // Ensure the item exists
            if ($barang) {
                // Check if there's enough stock available
                if ($barang->stok >= $jumlah_barang) {
                    // Calculate the new stock quantity
                    $new_stock = $barang->stok - $jumlah_barang;
                    // Update the stock quantity in the database
                    AdminModel::updateData('data_barang', 'id_barang', $id_barang, ['stok' => $new_stock]);


                    // Add the payment data to the validated data array
                    $validatedData[] = [
                        'total_harga' => $total_harga,
                        'id_barang' => $id_barang,
                        'jumlah_barang' => $jumlah_barang,
                        'id_user' => $id_user,
                        'created_at' => Carbon::now('Asia/Jakarta')
                    ];
                } else {
                    // Handle insufficient stock (optional)
                    // For example, return an error message or redirect back with an error
                    return redirect()->back()->with('error', 'Insufficient stock for item: ' . $barang->nama_barang);
                }
            }
        }
        // dd($validatedData);
        // // Save the payment data to the database
        AdminModel::CreateData('data_pembayaran', $validatedData);

        // // Redirect to the desired page
        return redirect()->route('databarang');
    }



    // DATAKATEGORI
    public function datakategori()
    {
        $data = AdminModel::GetData('data_kategori');
        return view('admin.kategori', compact('data'));
    }
    public function hapusdatakategori($id)
    {
        AdminModel::DeleteById('data_kategori', 'id_kategori', $id);
        return redirect()->back();
    }
    public function tambahdatakategori()
    {
        return view('admin.tambahdatakategori.tambah');
    }
    public function tambahdatakategorisubmit(Request $request)
    {
        $validatedData = $request->validate([
            'kategori' => 'required'
        ]);

        $existingCategory = AdminModel::GetDataById('data_kategori', 'nama_kategori', $validatedData['kategori']);

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Kategori sudah ada');
        }

        $data = [
            'nama_kategori' => $validatedData['kategori']
        ];
        AdminModel::CreateData('data_kategori', $data);
        return redirect()->route('datakategori')->with('success', 'Kategori berhasil ditambahkan');
    }
    public function editdatakategori($id)
    {
        $data = AdminModel::GetDataById('data_kategori', 'id_kategori', $id);
        return view('admin.tambahdatakategori.edit', compact('data'));
    }
    public function editdatakategorisubmit(Request $request)
    {
        $validatedData = $request->validate([
            'kategori' => 'required',
            'id_kategori' => 'required'
        ]);
        $existingCategory = AdminModel::GetDataById('data_kategori', 'nama_kategori', $validatedData['kategori']);

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Kategori sudah ada');
        }
        DB::table('data_kategori')->where('id_kategori', $validatedData['id_kategori'])->update([
            'nama_kategori' => $validatedData['kategori'],
        ]);
        return redirect()->route('datakategori')->with('success', 'Kategori berhasil ditambahkan');
    }




    // LAPORAN
    public function laporan(Request $request)
    {
        $data = AdminModel::joinData();
        return view('admin.laporan', compact('data'));
    }
    public function laporanhapus($id)
    {
        AdminModel::DeleteById('data_pembayaran', 'id_pembayaran', $id);
        return redirect()->back();
    }



    // Profil
    public function profil($id)
    {
        $data = AdminModel::GetDataById('user', 'id_user',  $id);
        return view('admin.profil.profil', compact('data'));
    }
    public function profilupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'nama_lengkap' => 'required',
            'telephone' => 'required',
            'email' => 'required',
        ]);
        $getdata = AdminModel::getDataById('user', 'id_user', $id);
        $existingUser = DB::table('user')
            ->where([
                ['username', '=', $request->username],
                ['telephone', '=', $request->telephone],
                ['email', '=', $request->email],
            ])
            ->where('id_user', '!=', $id) // Exclude the current user from the check
            ->first();

        if ($existingUser) {
            return redirect()->back();
        }
        DB::table('user')->where('id_user', $id)->update([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);

        return redirect()->route('profil', $id);
    }
    public function fotoprofilupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $uploadsPath = public_path('profil');
        if (!File::isDirectory($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0777, true, true);
        }

        $userData = AdminModel::getDataById('user', 'id_user', $id);

        if (!$userData) {
            return back()->withInput()->with('failed', 'User not found!');
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($userData->foto) {
                $oldImagePath = public_path('profil/' . $userData->foto);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Simpan foto ke direktori public/profil
            $image = $request->file('foto');
            $imageName = $image->hashName();
            $image->move(public_path('profil'), $imageName);

            // Atur path foto untuk user
            $userData->foto = $imageName;
        }

        // Update data pengguna dengan foto baru
        $data = [
            'foto' => $userData->foto,
        ];

        $updatedImageUser = AdminModel::updateData('user', 'id_user', $id, $data);

        if ($updatedImageUser) {
            // return redirect()->route('profil', $id)->with('success-message', 'Updated-ImageUser.');
            return response()->json(['success' => true, 'message' => 'Profile picture updated successfully', 'image_name' => $imageName]);
        } else {
            return back()->withInput()->with('failed', 'Please check the form again!');
        }
    }




    // DISKON
    public function datadiskon()
    {
        $data = AdminModel::joinDataDiskon();

        return view('admin.datadiskon', compact('data'));
    }
    public function tambahdatadiskon()
    {
        $data['barang'] = AdminModel::GetData('data_barang');
        return view('admin.tambahdatadiskon.tambah', compact('data'));
    }
    public function tambahdatadiskonsubmit(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_barang' => 'required',
            'diskon' => 'required',
        ]);

        // Periksa apakah id_barang sudah ada dalam tabel diskon
        $existingDiscount = AdminModel::GetDataByColumn('diskon', 'id_barang', $request->id_barang);
        if ($existingDiscount) {
            return back()->with('error', 'Discount for this product already exists.');
        }

        // Data yang akan disimpan
        $data = [
            'id_barang' => $request->id_barang,
            'diskon' => $request->diskon
        ];

        // Tambahkan data diskon baru
        AdminModel::CreateData('diskon', $data);

        // Redirect ke halaman datadiskon
        return redirect()->route('datadiskon')->with('success', 'Discount added successfully.');
    }
    public function editdatadiskon($id)
    {
        $data['diskon'] = AdminModel::GetDataById('diskon', 'id_diskon', $id);
        $data['data_barang'] = AdminModel::GetData('data_barang');
        return view('admin.tambahdatadiskon.edit', compact('data'));
    }
    public function editdatadiskonsubmit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_barang' => 'required',
            'diskon' => 'required',
        ]);

        // Periksa apakah id_barang sudah ada dalam tabel diskon
        $existingDiscount = AdminModel::GetDataByIdd('diskon', 'id_barang', $request->id_barang);

        // Periksa apakah $existingDiscount adalah sebuah objek
        if ($existingDiscount->isNotEmpty()) {
            // Ambil objek pertama dari collection
            $firstExistingDiscount = $existingDiscount->first();

            // Periksa apakah id_barang sama dengan id_barang pada data yang diedit
            $editedData = AdminModel::GetDataById('diskon', 'id_diskon', $id);
            if ($firstExistingDiscount->id_barang !== $editedData->id_barang) {
                return back()->with('error', 'Discount for this product already exists.');
            }
        }

        // Data yang akan disimpan
        $data = [
            'id_barang' => $request->id_barang,
            'diskon' => $request->diskon
        ];

        // Tambahkan data diskon baru
        AdminModel::updateData('diskon', 'id_diskon', $id, $data);

        // Redirect ke halaman datadiskon
        return redirect()->route('datadiskon')->with('success', 'Discount added successfully.');
    }
    public function hapusdatadiskon($id)
    {
        AdminModel::DeleteById('diskon', 'id_diskon', $id);
        return redirect()->back();
    }
}
