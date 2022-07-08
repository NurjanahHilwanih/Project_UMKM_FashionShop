<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Supplier
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('supplier') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_supplier' => $supplier['id_supplier']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama">Nama Supplier</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama', $supplier['nama']); ?>" name="nama" id="nama" type="text" class="form-control" placeholder="Nama Supplier...">
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kota">Kota</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('kota', $supplier['kota']); ?>" name="kota" id="kota" type="text" class="form-control" placeholder="Kota...">
                        </div>
                        <?= form_error('kota', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="alamat">Alamat</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('alamat', $supplier['alamat']); ?>" name="alamat" id="alamat" type="text" class="form-control" placeholder="Alamat Supplier...">
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_tlp">Nomor Telepon</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('no_tlp', $supplier['no_tlp']); ?>" name="no_tlp" id="no_tlp" type="text" class="form-control" placeholder="No Telepon...">
                        <?= form_error('no_tlp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kontak">Kontak</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('kontak', $supplier['kontak']); ?>" name="kontak" id="kontak" type="text" class="form-control" placeholder="Kotak">
                        </div>
                        <?= form_error('kontak', '<small class="text-danger">', '</small>'); ?>
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