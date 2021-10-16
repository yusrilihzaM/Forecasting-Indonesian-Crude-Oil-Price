<?php
class Data_minyak_model extends CI_model
{
    public function get_all_data_minyak()
    {
        $this->db->select('*');
        
        $this->db->from('data_minyak');
        return $this->db->get()->result_array();
       
    }
    public function hps_data_minyak($id)
    {
        $this->db->where('id_data_minyak', $id);
        $this->db->delete('data_minyak');
        $this->db->empty_table('ramal_des');
        return $this->db->affected_rows();
    }   
    public function add_data_minyak($tahun,$bulan,$jumlah_minyak)
    {
        $data = array(
            'id_data_minyak'    => "",
            'tahun'    => $tahun,
            'bulan'    => $bulan,
            'jumlah_minyak'    => $jumlah_minyak
        );
 
        $this->db->insert('data_minyak', $data);
        return $this->db->affected_rows();
    }
    public function get_data_minyak_byid($id)
    {
        return $this->db->get_where('data_minyak', array('id_data_minyak' =>  $id))->row_array();
    }
    public function update_data_minyak($id_data_minyak,$jumlah_minyak,$tahun,$bulan)
    {
        $this->db->set('tahun',$tahun);
        $this->db->set('bulan',$bulan);
        $this->db->set('jumlah_minyak',$jumlah_minyak);
        $this->db->where('id_data_minyak',$id_data_minyak);
        $this->db->update('data_minyak');

        $this->db->empty_table('hitung_ses');
        $this->db->empty_table('hitung_des');
        // ulangi data minyak
        $sqlalpha="SELECT * FROM data_minyak ORDER BY id_data_minyak ASC";
        $queryalpha = $this->db->query($sqlalpha);
        $alpha= (double) $queryalpha->result_array();
        $sqldataminya="SELECT * FROM data_minyak ORDER BY id_data_minyak ASC";
        $querydataminya = $this->db->query($sqldataminya);
        $dataminyak=  $querydataminya->result_array();
        $dtseblumnya=0;
        $yaksendblsblm=0;
        foreach ($dataminyak as $dataminyak) {
            if($dataminyak['id_data_minyak']==1){
                $data = array(
                    'id_hitung_des'    => "",
                    'id_data_minyak'    => $dataminyak['id_data_minyak'] ,
                    'y_aksen_des'    =>  $dataminyak['jumlah_minyak'],
                    'y_dbl_aksen_des'    =>  $dataminyak['jumlah_minyak'],
                    'a_des'    =>  $dataminyak['jumlah_minyak'],
                    'b_des'    => '',
                    'hasil_forecast_des'    => '',
                    'at_ft_des'    => '',
                    'abs_at_ft_bagiat_des'    => ''
                );
                $dtseblumnya=$dataminyak['jumlah_minyak'];
                $yaksendblsblm=$dataminyak['jumlah_minyak'];
                $this->db->insert('hitung_des', $data);

                $datases = array(
                    'id_hitung_ses'    => "",
                    'id_data_minyak'    => $dataminyak['id_data_minyak'] ,
                    'y_aksen_ses'    =>  "",
                    'at_ft_ses'    =>  "",
                    'abs_at_ft_ses'    =>  "",
                    'at_ft2_ses'    => '',
                    'error_ses'    => ''
                );
                $this->db->insert('hitung_ses', $datases);
            }elseif($dataminyak['id_data_minyak']==2){
                $sqldataminyak1="SELECT * FROM data_minyak ORDER BY id_data_minyak ASC limit 1";
                $querydataminyak1 = $this->db->query($sqldataminyak1);
                $dataminyak1=(double)$querydataminyak1->row_array()['jumlah_minyak'];
                $Yaksenses=$alpha* $dataminyak1+(1-$alpha)*$dataminyak1;
                $at_ft_ses= $dataminyak['jumlah_minyak']-  $Yaksenses;
                $abs_at_ft_ses=abs(  $at_ft_ses/$dataminyak['jumlah_minyak']);
                $at_ft2_ses=$at_ft_ses*$at_ft_ses;
                $datases = array(
                    'id_hitung_ses'    => "",
                    'id_data_minyak'    => $dataminyak['id_data_minyak'] ,
                    'y_aksen_ses'    =>  $Yaksenses,
                    'at_ft_ses'    =>   $at_ft_ses,
                    'abs_at_ft_ses'    =>  $abs_at_ft_ses,
                    'at_ft2_ses'    => $at_ft2_ses,
                    'error_ses'    => $at_ft_ses
                );
             
                $this->db->insert('hitung_ses', $datases);
                
                $Yaksen=$alpha*$dataminyak['jumlah_minyak']+(1-$alpha)*$dtseblumnya;
                $dtseblumnya= $Yaksen;
                $Yaksendbl=$alpha* $Yaksen+(1-$alpha)*$yaksendblsblm;
                $yaksendblsblm=$Yaksendbl;
                $a=2*$Yaksen-$Yaksendbl;
                $b=$alpha/(1-$alpha)*($Yaksen-$Yaksendbl);
                $hasil_forecast=$a+$b;
                $at_ft= $dataminyak['jumlah_minyak']-  $hasil_forecast;
                $abs_at_ft=abs(  $at_ft/$dataminyak['jumlah_minyak']);
                $data = array(
                    'id_hitung_des'    => "",
                    'id_data_minyak'    => $dataminyak['id_data_minyak'] ,
                    'y_aksen_des'    =>   $Yaksen,
                    'y_dbl_aksen_des'    =>  $Yaksendbl,
                    'a_des'    => $a,
                    'b_des'    => $b,
                    'hasil_forecast_des'    =>  $hasil_forecast,
                    'at_ft_des'    =>  $at_ft,
                    'abs_at_ft_bagiat_des'    =>  $abs_at_ft
                );
                $this->db->insert('hitung_des', $data);
            }
            else{
                $Yaksen=$alpha*$dataminyak['jumlah_minyak']+(1-$alpha)*$dtseblumnya;
                $dtseblumnya= $Yaksen;
                $Yaksendbl=$alpha* $Yaksen+(1-$alpha)*$yaksendblsblm;
                $yaksendblsblm=$Yaksendbl;
                $a=2*$Yaksen-$Yaksendbl;
                $b=$alpha/(1-$alpha)*($Yaksen-$Yaksendbl);
                $hasil_forecast=$a+$b;
                $at_ft= $dataminyak['jumlah_minyak']-  $hasil_forecast;
                $abs_at_ft=abs(  $at_ft/$dataminyak['jumlah_minyak']);
                $data = array(
                    'id_hitung_des'    => "",
                    'id_data_minyak'    => $dataminyak['id_data_minyak'] ,
                    'y_aksen_des'    =>   $Yaksen,
                    'y_dbl_aksen_des'    =>  $Yaksendbl,
                    'a_des'    => $a,
                    'b_des'    => $b,
                    'hasil_forecast_des'    =>  $hasil_forecast,
                    'at_ft_des'    =>  $at_ft,
                    'abs_at_ft_bagiat_des'    =>  $abs_at_ft
                );
                $this->db->insert('hitung_des', $data);

                $sqldataminyak1="SELECT * FROM data_minyak NATURAL JOIN hitung_ses ORDER BY id_hitung_ses desc limit 1";
                $querydataminyak1 = $this->db->query($sqldataminyak1);
                $dataminyak1=(double)$querydataminyak1->row_array()['jumlah_minyak'];
                $yaksesessebulumnya=(double)$querydataminyak1->row_array()['y_aksen_ses'];
                $Yaksenses=$alpha*$dataminyak1+(1-$alpha)*$yaksesessebulumnya;
                $at_ft_ses= $dataminyak['jumlah_minyak']-  $Yaksenses;
                $abs_at_ft_ses=abs(  $at_ft_ses/$dataminyak['jumlah_minyak']);
                $at_ft2_ses=$at_ft_ses*$at_ft_ses;
                $datases = array(
                    'id_hitung_ses'    => "",
                    'id_data_minyak'    => $dataminyak['id_data_minyak'] ,
                    'y_aksen_ses'    =>  $Yaksenses,
                    'at_ft_ses'    =>   $at_ft_ses,
                    'abs_at_ft_ses'    =>  $abs_at_ft_ses,
                    'at_ft2_ses'    => $at_ft2_ses,
                    'error_ses'    => $at_ft_ses
                );
                $datacoba = array(
                    'hasil'    => $dataminyak1,
                   
                );
                $this->db->insert('hitung_ses', $datases);
                $this->db->insert('coba', $datacoba);
            }
            return $this->db->affected_rows();
        }
    }
   

}