<!-- <?php
    // foreach($hitung_ses as $hitung_ses){
        
    // echo((double)$hitung_ses['y_aksen_ses']);
    // echo(',');
    // }
    //   die;                                      
    ?> -->
<div class="main-content">

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Hasil Forecasting Single Exponential Smoothing</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Harga Minyak Mentah Indonesia</li>
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

                                <div class="flash-data-news" data-flashdata="<?= $this->session->flashdata('flash') ?>">
                                </div>
                                <div class="flash-data-data" data-flashdata="<?= $this->session->flashdata('data') ?>">
                                </div>
                                <h4 class="header-title">Chart Hasil Perhitungan</h4>
                                <p class="card-title-desc">Chart Hasil Forecasting
                                </p>
                                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                                <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> -->
                                <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3"></script> -->
                                <div id="chart">
                                </div>
                                <script>
                                var options = {
                                    chart: {
                                        type: 'line'
                                    },
                                    series: [{
                                        name: 'Data Real (At)',
                                        type: 'line',
                                        data: [
                                            <?php
                                                foreach($at as $at):
                                            
                                            ?>
                                            <?= (double)$at['jumlah_minyak'].','?>
                                            <?php
                                            endforeach;?>
                                        ]
                                    }, {
                                        name: 'Data Hasil Forecast (Ft)',
                                        type: 'line',
                                        data: [<?php
                                                foreach($ft as $ft):
                                            
                                            ?>
                                            <?= (double)$ft['y_aksen_ses'].','?>
                                            <?php
                                            endforeach;?>
                                        ]
                                    }],
                                    dataLabels: {
                                        enabled: true,
                                        enabledOnSeries: [0, 1],


                                    },

                                    xaxis: {
                                        categories: [<?php
                                                foreach($bulan as $bulan):
                                            
                                            ?>
                                            <?= (double)$bulan['t'].','?>
                                            <?php
                                            endforeach;?>
                                        ]
                                    },
                                    responsive: [{
                                        breakpoint: undefined,
                                        options: {},
                                    }]

                                }


                                var chart = new ApexCharts(document.querySelector("#chart"), options);

                                chart.render();
                                </script>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Perhitungan Permalan</h4>
                                <p class="card-title-desc">Harga Minyak Mentah Indonesia 2007-2017
                                </p>

                                <div class="flash-data-news" data-flashdata="<?= $this->session->flashdata('flash') ?>">

                                </div>
                                <div class="flash-data-data" data-flashdata="<?= $this->session->flashdata('data') ?>">
                                </div>
                                <!-- <?= var_dump($dt_kecamatan['id_kecamatan'])?> -->

                                <br>
                                <!-- <?= var_dump($data_air)?> -->
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tahun</th>
                                            <th>Bulan</th>
                                            <th>Harga Minyak USD/Barrel (At)</th>

                                            <th>Hasil Forecast USD/Barrel (Ft)</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n0 = 1; ?>
                                        <?php foreach ($hitung_ses as $hitung_ses) : ?>
                                        <tr>
                                            <td style="width: 4%;"><?= $n0?></td>
                                            <td style="width: 7%;"><?= $hitung_ses['tahun']; ?></td>
                                            <td><?= $hitung_ses['bulan']; ?></td>
                                            <td><?= $hitung_ses['jumlah_minyak']; ?> </td>
                                            <td><?= $hitung_ses['y_aksen_ses']; ?> </td>




                                        </tr>
                                        <?php $n0++ ?>
                                        <?php endforeach ?>
                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Perhitungan Mean Absolute Percentage Error (MAPE)</h4>
                                <p class="card-title-desc">Permalan Harga Minyak Mentah Indonesia
                                </p>

                                <div class="flash-data-news" data-flashdata="<?= $this->session->flashdata('flash') ?>">

                                </div>
                                <div class="flash-data-data" data-flashdata="<?= $this->session->flashdata('data') ?>">
                                </div>

                                <br>

                                <br>
                                <!-- <?= var_dump($data_air)?> -->
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Harga Minyak USD/Barrel (At)</th>
                                            <th>Hasil Forecast (Ft)</th>
                                            <th>at_ft</th>
                                            <th>abs_at_ft_bagiat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n0 = 1; ?>
                                        <?php foreach ($hitung_ses1 as $hitung_ses1) : ?>
                                        <tr>
                                            <td><?=$n0?></td>
                                            <td><?=$hitung_ses1['jumlah_minyak']?></td>
                                            <td><?=$hitung_ses1['y_aksen_ses']?></td>
                                            <td><?=$hitung_ses1['at_ft_ses']?></td>
                                            <td><?=$hitung_ses1['abs_at_ft_ses']?></td>


                                        </tr>
                                        <?php $n0++ ?>
                                        <?php endforeach ?>
                                    </tbody>


                                </table>
                                <h4>MAPE=<?=$MAPE?></h4>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Permalan Masa Depan</h4>
                                <p class="card-title-desc">Harga Minyak Mentah Indonesia
                                </p>

                                <div class="flash-data-news" data-flashdata="<?= $this->session->flashdata('flash') ?>">

                                </div>
                                <div class="flash-data-data" data-flashdata="<?= $this->session->flashdata('data') ?>">
                                </div>
                                <!-- <?= var_dump($dt_kecamatan['id_kecamatan'])?> -->


                                <!-- <?= var_dump($data_air)?> -->
                                <table id="datatable" class="table table-bordered dt-responsive nowrap table-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tahun</th>
                                            <th>Bulan</th>
                                            <th>Harga Minyak USD/Barrel (At)</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td>1</td>
                                            <td><?=$ramal_ses['tahun']?></td>
                                            <td><?=$ramal_ses['bulan']?></td>
                                            <td><?=$ramal_ses['hasil_forecast']?></td>
                                        </tr>
                                        <?php $n0++ ?>

                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>

                </div>



            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>