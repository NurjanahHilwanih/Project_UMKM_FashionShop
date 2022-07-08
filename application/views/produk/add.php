<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Produk
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('produk') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open_multipart(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_produk">Nama Produk</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                            </div>
                            <input value="<?= set_value('nama'); ?>" name="nama" id="nama" type="text" class="form-control" placeholder="Nama Produk...">
                        </div>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_jenis">Jenis Produk</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-box-open"></i></span>
                            </div>
                            <select name="jenis_id" id="jenis_id" class="custom-select">
                                <option value="" selected disabled>Pilih Jenis Produk</option>
                                <?php foreach ($jenis as $j) : ?>
                                    <option <?= set_select('jenis_id', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('jenis/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga Beli</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-hand-holding-usd"></i></span>
                            </div>
                            <input value="<?= set_value('harga_beli'); ?>" name="harga_beli" id="harga_beli" type="text" class="form-control" placeholder="Harga...">
                        </div>
                        <?= form_error('harga_beli', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga Jual</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-hand-holding-usd"></i></span>
                            </div>
                            <input value="<?= set_value('harga_jual'); ?>" name="harga_jual" id="harga_jual" type="text" class="form-control" placeholder="Harga...">
                        </div>
                        <?= form_error('harga_jual', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Stok Awal</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                            </div>
                            <input value="<?= set_value('stok'); ?>" name="stok" id="stok" type="text" class="form-control" placeholder="Stok Awal...">
                        </div>
                        <?= form_error('stok', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Deskripsi</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <textarea name="deskripsi" id="deskripsi" type="text" class="form-control" placeholder="Deskripsi..."><?= set_value('deskripsi'); ?></textarea>
                        </div>
                        <?= form_error('deskripsi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Foto</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('foto'); ?>" name="foto" id="foto" type="file" class="form-control" placeholder="Foto...">
                        </div>
                        <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>