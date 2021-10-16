<div class="main-content">

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Tambah Data Minyak </h4>
                        <ol class="breadcrumb m-0">
                            <!-- <li class="breadcrumb-item active">Kecamatan <?= $nama['kecamatan']?></li> -->
                        </ol>
                    </div>

                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">


                                <div class="row d-flex justify-content-center ">
                                    <div class="col-md-10 p-3">
                                        <div class="flash-data-news"
                                            data-flashdata="<?= $this->session->flashdata('flash') ?>">

                                        </div>
                                        <div class="flash-data-data"
                                            data-flashdata="<?= $this->session->flashdata('data') ?>">
                                        </div>
                                        <!-- <?= $alpha['alpha']?> -->

                                        </h3>

                                        <form action="<?= base_url('minyak/tambah_minyak') ?>" method="POST">

                                           
                                          
                                            <div class="form-group row">
                                                <label for="example-month-input" class="col-md-4 col-form-label">Tahun & bulan</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="month" placeholder="Masukan Tanggal" id="example-month-input" name="bulan_tahun">
                                                    <?= form_error('bulan_tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-number-input" class="col-md-4 col-form-label">Jumlah minyak</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="float" placeholder="Masukan Jumlah minyak m3" id="example-number-input" name="jumlah_minyak">
                                                    <?= form_error('jumlah_minyak', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                            
                                            <button type="submit"
                                                    class="btn btn-success mx-auto mdi mdi-content-save">Simpan</button>
                                               
                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->