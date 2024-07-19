<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/ceeses.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
        <div id="intro">
            <h1>Selamat Datang!</h1>
            <h3>Portfolio Ilham_Raga</h3>
        </div>
        <div id="main-content">
            <div class="container">
                <div class="content">
                    <div class="cv" onclick="expandCV()">
                        <h4>CV</h4>
                    </div>
                    <div class="beranda">
                        <h2>My Portfolio</h2>
                    </div>
    
                    <div class="profil">
                        <div class="judul">
                            <h3>My Profil</h3>
                        </div>
                        <div class="foto">
                            <figure class="img-figure">
                                <img data-src="img/aseek.png" alt="" class="img-profil">
                                <!-- <video autoplay muted class="video-profil">
                                    <source src="img/jajal.mp4" type="video/mp4" >
                                    Your browser does not support the video tag.
                                </video>  -->
                            </figure>
                         
                            <div class="nama">
                                <h3>ILHAM RAGA KUSUMA</h3>
                            </div>
                            <div class="sosmed">
                                <a href="https://www.instagram.com/lhami_r" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-instagram"></i>
                                </a>
    
                                <a href="https://www.tiktok.com/@ilhamm_sudah_vaksin" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-brands fa-tiktok fa-bounce"></i>
                                </a>
                            </div>
                        </div>
                        <div class="right">
                            <div class="card">
                                <div class="detail">
                                    <ul>
                                        <li><h4>Alamat</h4><p> : Dsn sidomulyo Rt4/Rw1 Ds. Sidomulyo kec. Selorejo Kab. Blitar JAWA-TIMUR</p></li>
                                        <li><h4>TTL</h4><p> : BLITAR, 06 MEI 2006</p></li>
                                        <li><h4>Gender</h4><p> : LAKI-LAKI</p></li>
                                        <li><h4>kontak</h4><p> : 0812-5243-5354</p></li>
                                        <li><h4>Sekolah</h4><p> : SMK PGRI Wlingi</p></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="keahlian">
                                <h1>KEAHLIAN</h1>
                                <div class="nilai">
                                    <div class="css">
                                        <div class="front">
                                            <figure>
                                                <img src="img/html.png" alt="">
                                            </figure>
                                        </div>
                                        <div class="back">
                                            0%
                                        </div>
                                    </div>
                                    <div class="css">
                                        <div class="front">
                                            <figure>
                                                <img src="img/css.png" alt="">
                                            </figure>
                                        </div>
                                        <div class="back">
                                            <p>0%</p>
                                        </div>
                                    </div>
                                    <div class="css">
                                        <div class="front">
                                            <figure>
                                                <img src="img/js.png" alt="">
                                            </figure>
                                        </div>
                                        <div class="back">
                                            <p>0%</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="keterangan">
                                    <div class="ket">
                                        <h4>Keterangan</h4>
                                        <p>saya masih belajar</p>
                                    </div>
                                    <div class="ket-css">
                                        <h4>HTML</h4>
                                        <p>ini keterangan yang ke 1</p>
                                    </div>
                                    <div class="ket-css">
                                        <h4>CSS</h4>
                                        <p>ini keterangan yang ke 1</p>
                                    </div>
                                    <div class="ket-css">
                                        <h4>JavaScript</h4>
                                        <p>ini keterangan yang ke 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    
                    <div class="projet">
                        <div class="judul">
                            <h4>Projet Saya</h4>
                        </div>
                        <div class="grub-isi">
                            <div class="isi">
                                <div class="keterangan">
                                    <div class="tek-ket">
                                        <h5>Membuat Footer1</h5>
                                    </div>
                                </div>
                                <div class="haasil">
                                    <div class="lihat">
                                        <a href="{{route('/fotter')}}">
                                            <div class="btn-lihat">
                                                Lihat
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="isi">
                                <div class="keterangan">
                                    <div class="tek-ket">
                                        <h5>x</h5>
                                    </div>
                                </div>
                                <div class="haasil">
                                    
                                </div>
                            </div>
                            <div class="isi2">
                                <div class="haasil2">
                                    <div class="btn-lihat">
                                        
                                    </div>
                                </div>
                                <div class="keterangan2">
                                    <div class="tek-ket">
                                        <h5>x</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="isi2">
                                <div class="haasil2">
    
                                </div>
                                <div class="keterangan2">
                                    <div class="tek-ket">
                                        <h5>x</h5>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
  


<script src="{{asset('js/jees.js')}}"></script>

</body>
</html>