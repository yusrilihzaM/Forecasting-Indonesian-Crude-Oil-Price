<div class="main-content">

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Data Minyak Mentah</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Indonesia</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               
                                
                                <div class="flash-data-news"
                                            data-flashdata="<?= $this->session->flashdata('flash') ?>">

                                        </div>
                                        <div class="flash-data-data"
                                            data-flashdata="<?= $this->session->flashdata('data') ?>">
                                        </div>
                                        
                                <a href ="<?=base_url()?>minyak/tambah_minyak" type="button p-1 mb-2 " class="btn btn-success mdi mdi-plus mx-auto">Tambah Data Minyak</a>
                                <br>
                                <br>
                                <!-- <?= var_dump($data_minyak)?> -->
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tahun</th>
                                            <th>Bulan</th>
                                            <th>Jumlah Minyak</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $n0 = 1; ?>
                                        <?php foreach ($data_minyak as $data_minyak) : ?>
                                        <tr>
                                            <td style="width: 4%;"><?= $n0?></td>
                                            <td><?= $data_minyak['tahun']; ?></td>
                                            <td><?= $data_minyak['bulan']; ?></td>
                                            <td><?= $data_minyak['jumlah_minyak']; ?></td>
                                            <td style="width: 15%;">
                                                <a class="btn btn-warning mdi mdi-circle-edit-outline"
                                                    href="<?= base_url(); ?>Minyak/edit_minyak/<?= $data_minyak['id_data_minyak']; ?>"
                                                    style=" color:white;"></a>
                                                <a class="btn btn-danger mdi mdi-trash-can-outline hapus-news"
                                                    href="<?= base_url(); ?>Minyak/hapus_minyak/<?= $data_minyak['id_data_minyak']; ?>"
                                                    style="color:white;"></a>
                                            </td>
                                        </tr>
                                        <?php $n0++ ?>
                                        <?php endforeach ?>
                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>



            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->