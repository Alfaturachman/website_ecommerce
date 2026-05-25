<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'NOMADENSTUFF' ?> — Online Thrift Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        body { background: #faf7f2; }
        a:hover { text-decoration: none; }
    </style>
</head>
<body>

    <?php $this->load->view('layouts/user/_navbar') ?>

    <main>
        <?php $this->load->view($page) ?>
    </main>

    <footer style="background:#1a1a1a;margin-top:4rem">
        <div style="max-width:1280px;margin:0 auto;padding:4rem 1.5rem 2rem">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <h4 style="font-weight:800;font-size:1.4rem;color:#fff;letter-spacing:-.5px">NOMADENSTUFF</h4>
                    <p style="color:rgba(255,255,255,.5);font-size:.9rem;line-height:1.7;margin-top:.75rem;max-width:360px">
                        Curated thrift store — every piece has a story. We bring you pre-loved clothing with character, quality, and soul.
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 style="font-weight:700;font-size:.8rem;color:rgba(255,255,255,.35);letter-spacing:2px;text-transform:uppercase;margin-bottom:1rem">Contact</h6>
                    <p style="color:rgba(255,255,255,.6);font-size:.9rem;line-height:1.8">
                        Jl. Taman Siswa, Sekaran, Gunung Pati<br>
                        Kota Semarang, Jawa Tengah 50229
                    </p>
                    <div style="display:flex;gap:.75rem;margin-top:.75rem">
                        <a href="https://www.instagram.com/nomadenstuff" target="_blank" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;color:#fff;transition:.3s" onmouseover="this.style.background='#d4a853'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                            <i class="fab fa-instagram" style="font-size:.9rem"></i>
                        </a>
                        <a href="https://wa.me/6288229889507" target="_blank" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;color:#fff;transition:.3s" onmouseover="this.style.background='#d4a853'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                            <i class="fab fa-whatsapp" style="font-size:.9rem"></i>
                        </a>
                        <a href="https://shopee.co.id/nomadenstuff_" target="_blank" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;color:#fff;transition:.3s;font-size:.8rem;font-weight:700" onmouseover="this.style.background='#d4a853'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                            S
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6 style="font-weight:700;font-size:.8rem;color:rgba(255,255,255,.35);letter-spacing:2px;text-transform:uppercase;margin-bottom:1rem">Links</h6>
                    <div style="display:flex;flex-direction:column;gap:.5rem">
                        <a href="<?= base_url('shop') ?>" style="color:rgba(255,255,255,.6);font-size:.9rem;transition:.3s">Shop All</a>
                        <a href="<?= base_url('shop/men') ?>" style="color:rgba(255,255,255,.6);font-size:.9rem;transition:.3s">Men's</a>
                        <a href="<?= base_url('shop/women') ?>" style="color:rgba(255,255,255,.6);font-size:.9rem;transition:.3s">Women's</a>
                        <a href="<?= base_url('myorder') ?>" style="color:rgba(255,255,255,.6);font-size:.9rem;transition:.3s">My Orders</a>
                    </div>
                </div>
            </div>
            <div style="border-top:1px solid rgba(255,255,255,.06);padding-top:1.5rem;margin-top:2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.5rem">
                <p style="color:rgba(255,255,255,.3);font-size:.8rem;margin:0">&copy; 2024 Alfaturachman Maulana Pahlevi</p>
                <p style="color:rgba(255,255,255,.3);font-size:.8rem;margin:0">Thrift with purpose.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>