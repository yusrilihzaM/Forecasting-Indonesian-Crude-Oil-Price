<div class="main-content">

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Hasil Forecasting Double Exponential Smoothing</h4>
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
                                            <?= (double)$ft['y_aksen_des'].','?>
                                            <?php
                                            endforeach;?>
                                        ]
                                    }],
                                    dataLabels: {
                                        enabled: true,
                                        enabledOnSeries: [0, 1],


                                    },

                                    xaxis: {
                                        categories: [
                                            <?php
                                                foreach($bulan as $bulan):
                                            
                                            ?>
                                            <?php $label=(string)$bulan['t'].','
                                            ?>
                                            <?=$label?>
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


                                <table id="datatable" class="table table-bordered dt-responsive norwrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tahun</th>
                                            <th>Bulan</th>
                                            <th>Harga Minyak USD/Barrel (At)</th>
                                            <th>Y'</th>
                                            <th>Y''</th>
                                            <th>a</th>
                                            <th>b</th>
                                            <th>Hasil Forecast USD/Barrel (Ft)</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n0 = 1; ?>
                                        <?php foreach ($hitung_des as $hitung_des) : ?>
                                        <tr>
                                            <td><?= $n0?></td>
                                            <td><?= $hitung_des['tahun']?></td>
                                            <td><?= $hitung_des['bulan']?></td>
                                            <td><?= $hitung_des['jumlah_minyak']?></td>
                                            <td><?= $hitung_des['y_aksen_des']?></td>
                                            <td><?= $hitung_des['y_dbl_aksen_des']?></td>
                                            <td><?= $hitung_des['a_des']?></td>
                                            <td><?= $hitung_des['b_des']?></td>
                                            <td><?= $hitung_des['hasil_forecast_des']?></td>
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
                                <table id="datatable" class="table table-bordered dt-responsive norwrap"
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
                                        <?php foreach ($hitung_des1 as $hitung_des1) : ?>
                                        <tr>
                                            <td><?=$n0?></td>
                                            <td><?=$hitung_des1['jumlah_minyak']?></td>
                                            <td><?=$hitung_des1['hasil_forecast_des']?></td>
                                            <td><?=$hitung_des1['at_ft_des']?></td>
                                            <td><?=$hitung_des1['abs_at_ft_bagiat_des']?></td>


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
                                <a href="<?=base_url()?>ramalses" type="button p-1 mb-2 "
                                    class="btn btn-success mdi mdi-plus mx-auto">Ramal Masa
                                    Depan</a>
                                <br>
                                <br>
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
                                        <?php $n0 = 1; ?>
                                        <?php foreach ($ramal_des as $masa_dpn) : ?>
                                        <tr>
                                            <td><?=$n0?></td>
                                            <td><?=$masa_dpn['tahun_des']?></td>
                                            <td><?=$masa_dpn['bulan_des']?></td>
                                            <td><?=$masa_dpn['jumlah_minyak_des']?></td>

                                        </tr>
                                        <?php $n0++ ?>
                                        <?php endforeach ?>
                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
<!-- end page-content-wrapper -->

<!-- End Page-content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>