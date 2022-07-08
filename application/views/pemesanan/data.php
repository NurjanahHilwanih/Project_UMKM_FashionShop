<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Riwayat Data Pemesanan
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('pemesanan/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Pemesanan
                    </span>
                </a>
            </div>
            <div class="col-auto">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Tanggal Keluar</th>
                    <!-- <th>Nama Konsumen</th> -->
                    <th>Nama Produk</th>
                    <th>Jumlah Keluar</th>
                    <th>Harga </th>
                    <th>Total Harga</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //    var_dump($pemesanan);
                $no = 1;
                if ($pemesanan) :

                    foreach ($pemesanan as $bk) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $bk['tanggal']; ?></td>
                            <!-- <td><?= $bk['nama_konsumen']; ?></td> -->
                            <td><?= $bk['nama_produk']; ?></td>
                            <td><?= $bk['jumlah']; ?></td>
                            <td><?= number_format($bk['harga_jual']); ?></td>
                            <td><?= number_format($bk['total_harga']); ?></td>
                            <td><?= $bk['username']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>