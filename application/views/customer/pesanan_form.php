<?php $this->load->view('layouts/header'); ?>

<?php
$harga_normal = $produk->harga;
$diskon = $produk->diskon_produk;
$harga_diskon = $harga_normal - ($harga_normal * $diskon / 100);
?>

<section class="order-page">
    <div class="order-container">
        <div class="order-product-card">
            <img src="<?= base_url('assets/img/produk/' . $produk->foto_1); ?>">

            <h2><?= $produk->nama_pakaian; ?></h2>
            <p><?= $produk->detail_model; ?></p>

            <div class="order-detail-list">
                <span>Ukuran <b><?= $produk->ukuran; ?></b></span>
                <span>Stok <b><?= $produk->stok; ?> pcs</b></span>
                <span>Harga Normal <b>Rp <?= number_format($harga_normal,0,',','.'); ?></b></span>
                <span>Diskon <b><?= $diskon; ?>%</b></span>
                <span>Harga Setelah Diskon <b>Rp <?= number_format($harga_diskon,0,',','.'); ?></b></span>
            </div>
        </div>

        <div class="order-form-card">
            <h1>Form Pemesanan</h1>
            <p>Lengkapi data untuk melanjutkan pemesanan Lavéra.</p>

            <form action="<?= base_url('pesanan/simpan'); ?>" method="post">

                <input type="hidden" name="id_pakaian_jadi" value="<?= $produk->id_pakaian_jadi; ?>">
                <input type="hidden" name="id_customer" value="<?= $customer->id_customer; ?>">

                <div class="order-form-grid">

                    <div class="order-input-group">
                        <label>Nama Lengkap</label>
                        <input type="text" value="<?= $customer->nama_user; ?>" readonly>
                    </div>

                    <div class="order-input-group">
                        <label>No. Telepon</label>
                        <input type="text" value="<?= $customer->no_telepon; ?>" readonly>
                    </div>

                    <div class="order-input-group order-full">
                        <label>Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" required><?= $customer->alamat; ?></textarea>
                    </div>

                    <div class="order-input-group">
                        <label>Metode Pengambilan</label>
                        <select name="metode_pengambilan" id="metodePengambilan" required>
                            <option value="">Pilih Metode</option>
                            <option value="delivery">Delivery</option>
                            <option value="pickup">Pick Up</option>
                        </select>
                    </div>

                    <div class="order-input-group">
                        <label>Ekspedisi</label>
                        <select name="ekspedisi" id="ekspedisiSelect">
                            <option value="">Pilih Ekspedisi</option>
                            <option value="J&T" data-price="12000">J&T - Rp 12.000</option>
                            <option value="SiCepat" data-price="14000">SiCepat - Rp 14.000</option>
                            <option value="JNE" data-price="13000">JNE - Rp 13.000</option>
                            <option value="Ninja" data-price="15000">Ninja - Rp 15.000</option>
                        </select>
                    </div>

                    <div class="order-input-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" value="1" min="1" max="<?= $produk->stok; ?>" required>
                    </div>

                    <div class="order-input-group">
                        <label>Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metodePembayaran" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="transfer">Transfer</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                </div>

                <div class="delivery-option-box" id="deliveryOptionBox">
                    <h4>
                        <i class="fa-solid fa-truck-fast"></i>
                        Opsi Ekspedisi
                    </h4>

                    <table class="delivery-mini-table">
                        <thead>
                            <tr>
                                <th>Ekspedisi</th>
                                <th>Estimasi Biaya</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>J&T</td>
                                <td>Rp 12.000</td>
                            </tr>
                            <tr>
                                <td>SiCepat</td>
                                <td>Rp 14.000</td>
                            </tr>
                            <tr>
                                <td>JNE</td>
                                <td>Rp 13.000</td>
                            </tr>
                            <tr>
                                <td>Ninja</td>
                                <td>Rp 15.000</td>
                            </tr>
                        </tbody>
                    </table>

                    <small>
                        Biaya ekspedisi dibayarkan langsung oleh pelanggan kepada pihak ekspedisi.
                    </small>
                </div>

                <div class="payment-info" id="transferInfo">
                    <h4><i class="fa-solid fa-building-columns"></i> Rekening Lavéra</h4>
                    <p>BCA: <b>7435667040</b></p>
                    <p>Atas Nama: <b>LAVERA FASHION</b></p>
                </div>

                <div class="payment-info" id="cashInfo">
                    <h4><i class="fa-solid fa-store"></i> Pembayaran Cash</h4>
                    <p>Silakan datang ke store Lavéra untuk melakukan pembayaran tunai.</p>
                </div>

                <div class="order-summary">
                    <div>
                        <span>Harga Normal</span>
                        <b>Rp <?= number_format($harga_normal,0,',','.'); ?></b>
                    </div>

                    <div>
                        <span>Diskon</span>
                        <b><?= $diskon; ?>%</b>
                    </div>

                    <div>
                        <span>Harga Setelah Diskon</span>
                        <b id="hargaDiskon" data-price="<?= $harga_diskon; ?>">
                            Rp <?= number_format($harga_diskon,0,',','.'); ?>
                        </b>
                    </div>

                    <div>
                        <span>Metode Pengambilan</span>
                        <b id="summaryPengambilan">-</b>
                    </div>

                    <div>
                        <span>Ekspedisi</span>
                        <b id="summaryEkspedisi">-</b>
                    </div>

                    <div>
                        <span>Estimasi Ongkir</span>
                        <b id="summaryOngkir">-</b>
                    </div>

                    <div class="subtotal">
                        <span>Subtotal</span>
                        <b id="subtotalText">Rp <?= number_format($harga_diskon,0,',','.'); ?></b>
                    </div>
                </div>

                <div class="order-buttons">
                    <a href="<?= base_url('collection'); ?>" class="order-cancel-btn">
                        Batal
                    </a>

                    <button type="submit" class="order-submit-btn">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Pesan
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

<script>
    const jumlah = document.getElementById('jumlah');
    const hargaDiskon = document.getElementById('hargaDiskon');
    const subtotalText = document.getElementById('subtotalText');

    jumlah.addEventListener('input', function(){
        let price = parseInt(hargaDiskon.dataset.price);
        let qty = parseInt(this.value || 1);

        subtotalText.innerHTML = 'Rp ' + (price * qty).toLocaleString('id-ID');
    });

    const metode = document.getElementById('metodePembayaran');
    const transferInfo = document.getElementById('transferInfo');
    const cashInfo = document.getElementById('cashInfo');

    metode.addEventListener('change', function(){
        transferInfo.style.display = this.value === 'transfer' ? 'block' : 'none';
        cashInfo.style.display = this.value === 'cash' ? 'block' : 'none';
    });

    const metodePengambilan = document.getElementById('metodePengambilan');
    const ekspedisiSelect = document.getElementById('ekspedisiSelect');
    const deliveryOptionBox = document.getElementById('deliveryOptionBox');

    const summaryPengambilan = document.getElementById('summaryPengambilan');
    const summaryEkspedisi = document.getElementById('summaryEkspedisi');
    const summaryOngkir = document.getElementById('summaryOngkir');

    deliveryOptionBox.style.display = 'none';
        ekspedisiSelect.disabled = true;

        metodePengambilan.addEventListener('change', function(){

            if(this.value === 'delivery'){

                deliveryOptionBox.style.display = 'block';
                ekspedisiSelect.disabled = false;
                ekspedisiSelect.required = true;

                summaryPengambilan.innerHTML = 'Delivery';

            }else if(this.value === 'pickup'){

                deliveryOptionBox.style.display = 'none';
                ekspedisiSelect.disabled = true;
                ekspedisiSelect.required = false;
                ekspedisiSelect.value = '';

                summaryPengambilan.innerHTML = 'Ambil di Store';
                summaryEkspedisi.innerHTML = '-';
                summaryOngkir.innerHTML = '-';

            }else{

                deliveryOptionBox.style.display = 'none';
                ekspedisiSelect.disabled = true;
                ekspedisiSelect.required = false;
                ekspedisiSelect.value = '';

                summaryPengambilan.innerHTML = '-';
                summaryEkspedisi.innerHTML = '-';
                summaryOngkir.innerHTML = '-';
            }

        });

        ekspedisiSelect.addEventListener('change', function(){

            const selectedOption = this.options[this.selectedIndex];
            const ongkir = selectedOption.dataset.price;

            if(this.value !== ''){

                summaryEkspedisi.innerHTML = this.value;

                summaryOngkir.innerHTML =
                    'Rp ' + parseInt(ongkir).toLocaleString('id-ID');

            }else{

                summaryEkspedisi.innerHTML = '-';
                summaryOngkir.innerHTML = '-';

            }

        });
</script>

<?php $this->load->view('layouts/footer'); ?>