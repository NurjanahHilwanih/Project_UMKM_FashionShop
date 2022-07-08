<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Produk
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('produk/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Produk
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Jenis Produk</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($produk) :
                    $no = 1;
                    foreach ($produk as $b) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['id_produk']; ?></td>
                            <td><?= $b['nama']; ?></td>
                            <td><?= $b['nama_jenis']; ?></td>
                            <td><?= $b['stok']; ?></td>
                            <td><?= number_format($b['harga_beli']); ?></td>
                            <td><?= number_format($b['harga_jual']); ?></td>
                            <th>
                                <a href="<?= base_url('produk/edit/') . $b['id_produk'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('produk/delete/') . $b['id_produk'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>