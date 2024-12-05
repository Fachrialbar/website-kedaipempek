<?php
	include 'database.php';

	$where = '';

	if(isset($_GET['kategori'])){
		$where = ' where kategori = "'.$_GET['kategori'].'"';
	}

	$query_select = 'select * from produk ' . $where;
	$run_query_select = mysqli_query($conn, $query_select);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home - pempek cek linda</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap');
		* {
			padding:0;
			margin:0;
		}
		body {
			font-family: 'Nunito Sans', sans-serif;
			background-color: #ffff;
		}
		a {
			color: inherit;
			text-decoration: none;
		}

		/* navbar */
		.navbar {
			padding: 0.5rem 1rem;
			background-color: #000000;
			color: #fff;
			position: fixed;
			width: 100%;
			top:0;
			left:0;
			z-index: 99;
		}

		/*  sidebar */
		.sidebar {
			position: fixed;
			width: 250px;
			top:0;
			bottom:0;
			background-color: #fff;
			padding-top: 40px;
			transition: all .5s;
			z-index: 98;
		}
		.sidebar-hide {
			left:-250px;
		}
		.sidebar-show {
			left:0;
		}
		.sidebar-body {
			padding:15px;
		}
		.sidebar-body h2 {
			margin-bottom: 8px;
		}
		.sidebar-body ul {
			list-style: none;
		}
		.sidebar-body ul li a {
			width: 100%;
			display: inline-block;
			padding: 7px 15px;
			box-sizing: border-box;
		}
		.sidebar-body ul li a:hover {
			background-color: #0000ff;
			color: #fff;
		}
		.sidebar-body ul li:not(:last-child) {
			border-bottom:1px solid #ccc;
		}

		/* banner */
		.banner {
			border-bottom:1px solid #ccc;
			padding: 150px 15px 40px;
			background-image: url('assets/img/pempek2.jpg');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: bottom;
			position: relative;
		}
		.banner:before {
			content:'';
			display: block;
			position: absolute;
			top:0;
			left:0;
			width:100%;
			height:100%;
			background-image: linear-gradient(to right, rgba(255,255,255,1), rgba(255,255,255,.5));
		}
		.banner-text {
			position: relative;
		}

		/*About*/

		.about {
        	width: 100%;
        	padding: 20px;
        	box-sizing: border-box;
    	}

    	.about_main {
        	display: flex;
        	flex-direction: column; /* Default untuk mobile */
        	align-items: center;
        	justify-content: center;
    	}

    	.image img {
        	width: 100%; /* Responsif */
        	max-width: 500px; /* Maksimal lebar gambar */
        	border-radius: 0 75px 75px 0;
    	}

    	.about_text {
        	text-align: center; /* Rata tengah untuk teks */
        	padding: 20px;
    	}

    	.about_text h1 {
        	font-size: 2rem; /* Ukuran font responsif */
        	margin-bottom: 10px;
    	}

    	.about_text p {
        	font-size: 1rem; /* Ukuran font responsif */
        	line-height: 1.5; /* Jarak antar baris */
    	}

    	/* Media Query untuk layar lebih besar */
    		@media (min-width: 768px) {
        .about_main {
            flex-direction: row; /* Mengubah ke baris untuk layar lebih besar */
        }

        .about_text {
            text-align: left; /* Rata kiri untuk teks di layar lebih besar */
            padding: 0 20px; /* Padding horizontal */
        }

        .about_text h1 {
            font-size: 2.5rem; /* Ukuran font lebih besar untuk layar lebih besar */
        }

        .about_text p {
            font-size: 1.1rem; /* Ukuran font lebih besar untuk layar lebih besar */
        }
    	}


		/* content */
		.content {
			padding: 25px 0;
		}
		.container {
			width: 540px;
			padding-left: 15px;
			padding-right: 15px;
			box-sizing: border-box;
			margin-left: auto;
			margin-right: auto;
		}
		.row {
			margin-left: -15px;
			margin-right: -15px;
			display: flex;
			flex-wrap: wrap;
		}
		.col-6 {
			flex: 0 0 50%;
			box-sizing: border-box;
			margin-bottom: 15px;
			padding-left: 15px;
			padding-right: 15px;
		}
		.card-menu {
			border:1px solid #ccc;
			background-color: #fff;
			border-radius: 5px;
		}
		.card-menu img {
			width: 100%;
			height: 150px;
			object-fit: cover;
			border-top-right-radius: 5px;
			border-top-left-radius: 5px;
		}
		.card-body {
			padding:8px;
		}
		.menu-name {
			height: 45px;
			overflow: hidden;
			display: -webkit-box;
			text-overflow: ellipsis;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			margin-bottom: 8px;
		}
		.menu-price {
			font-weight: bold;
			text-align: right;
		}

		@media (max-width: 768px){
			.container {
				width: 100%;
			}
		}

		/*Footer*/

		footer {
    		width: 100%;
    		background: #a9a9a934; /* Warna latar belakang footer */
    		padding: 20px 0; /* Padding atas dan bawah */
    		text-align: center; /* Memusatkan teks di dalam footer */
		}

		.footer_main {
    		display: flex; /* Menggunakan flexbox untuk tata letak */
    		justify-content: center; /* Memusatkan konten secara horizontal */
    		align-items: center; /* Memusatkan konten secara vertikal */
		}

		.footer_tag {
    		max-width: 800px; /* Maksimal lebar untuk footer */
    		margin: 0 auto; /* Margin otomatis untuk memusatkan */
		}

		.footer_tag h2 {
    		color: #000; /* Warna teks untuk judul */
    		margin-bottom: 10px; /* Jarak bawah untuk judul */
		}

		.footer_tag p {
    		color: #333; /* Warna teks untuk paragraf */
    		margin: 5px 0; /* Jarak atas dan bawah untuk paragraf */
		}
	</style>
</head>
<body>

	<!-- navbar -->
	<div class="navbar">
		<a href="#" id="btnBars">
			<i class="fa fa-bars"></i>
		</a>
	</div>

	<!-- sidebar -->
	<div class="sidebar sidebar-hide">
		<div class="sidebar-body">
			
			<h2>Kategori</h2>
			<ul>
				<li><a href="?kategori=Makanan">Makanan</a></li>
				<li><a href="?kategori=Minuman">Minuman</a></li>
				<li><a href="login.php">login (untuk admin)</a>
				<li><a href="input_pesanan.php">pesan (pesan di sini)</a>
			</ul>

		</div>
	</div>

	<!-- banner -->
	<div class="banner">
		<div class="banner-text">
		</div>
	</div>
	

	<!--About-->

	<div class="about" id="About">
    	<div class="about_main">
        	<div class="image">
            	<img src="assets/img/pempek.jpg" alt="Pempek">
        	</div>
        	<div class="about_text">
            	<h1><span>Tentang</span> Pempek</h1>
            	<p>
                	Pempek adalah makanan tradisional khas Palembang, Sumatera Selatan, yang terbuat dari campuran ikan giling, tepung sagu, dan bumbu-bumbu seperti garam dan penyedap. Pempek memiliki berbagai varian, antara lain pempek lenjer, pempek kapal selam, pempek adaan, pempek kulit, dan pempek kriting, masing-masing dengan bentuk dan cita rasa yang unik.
            	</p>
        	</div>
    	</div>
	</div>

	<div class="menu" id="Menu">
    	<center><h1><span>Menu</span></h1></center>
	</div>

	<!-- content -->
	<div class="content">
		<div class="container">
			
			<!-- list menu makanan -->
			<div class="row">

				<!-- menu item -->
				<?php
					if(mysqli_num_rows($run_query_select) > 0){
						while($row = mysqli_fetch_array($run_query_select)){
				?>
				<div class="col-6">

					<a href="detail.php?id=<?= $row['idproduk'] ?>">
						<div class="card-menu">
							<img src="uploads/products/<?= $row['foto'] ?>">
							<div class="card-body">
								<div class="menu-name"><?= $row['namaproduk'] ?></div>
								<div class="menu-price">Rp<?= number_format($row['hargaproduk'], 0, ',', '.') ?></div>
								<a href="input_pesanan.php" class="menu_btn">Pesan</a>
							</div>
						</div>
					</a>

				</div>
			<?php }}else{ ?>

				<div>Menu tidak tersedia</div>

			<?php } ?>

			</div>

		</div>
	</div>

	<!--Footer-->

    <footer>
        <div class="footer_main">

            <div class="footer_tag">
                <h2>Contact</h2>
                <p>+64 81287791142</p>
                <p>Pempekckl@gmail.com</p>
            </div>

        </div>

    </footer>

	<script type="text/javascript">
		
		var btnBars = document.getElementById('btnBars')
		var sidebar = document.querySelector(".sidebar")

		btnBars.addEventListener('click', function(e){
			e.preventDefault();

			sidebar.classList.toggle('sidebar-show')

		})

	</script>

</body>
</html>