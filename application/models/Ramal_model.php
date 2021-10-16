<?php
class Ramal_model extends CI_model
{
    public function get_ramal_ses()
    {
        //start  ambil data alpha
        $this->db->select('alpha');
        $this->db->from('alpha');
        $alpha= (double)$this->db->get()->row_array()['alpha'];
     
        $sqldataterakhir="SELECT * FROM data_minyak NATURAL JOIN hitung_ses GROUP BY id_data_minyak DESC LIMIT 1";
        $querysqldataterakhir = $this->db->query($sqldataterakhir);
        $data_terakhir=$querysqldataterakhir->row_array();
    
        $tahun=(integer)$data_terakhir['tahun'];
        $sqlcountbulan="SELECT count(bulan) as jumlah_bulan FROM data_minyak NATURAL JOIN hitung_ses  GROUP BY id_data_minyak DESC LIMIT 1";
        $querysqlcountbulan = $this->db->query($sqlcountbulan);
        $countbulan=$querysqlcountbulan->row_array();
        $at_terakhir=(double)$data_terakhir['jumlah_minyak'];
        $ft_terakhir=(double)$data_terakhir['y_aksen_ses'];
       
        $bulan=(integer)$data_terakhir['bulan'];
        $jumlah_tahun= $countbulan%12;
        if ($jumlah_tahun==0){
            $tahun=$tahun+1;
            $bulan=1;
        }else{
           
            $bulan= $bulan+1;
        }
        $hasil_forecast=$alpha*($at_terakhir)+(1-$alpha)*$ft_terakhir;
        $data_hasil=[
            'tahun'=>$tahun,
            'bulan'=>$bulan,
            'hasil_forecast'=>$hasil_forecast
        ];
        return  $data_hasil;
    }


    
    public function add_ramal_des($bulan)
    {
        $sqltahun="SELECT tahun  FROM data_minyak  order by tahun desc limit 1" ;    
        $querytahun=$this->db->query($sqltahun);
        $tahun=(int) $querytahun->row_array()['tahun'];
        $sqlqueryhitungbulan="SELECT count(bulan) as totalbulan FROM data_minyak where tahun=$tahun";    
        $queryhitungbulan=$this->db->query($sqlqueryhitungbulan);
        $hitungbulan=(int) $queryhitungbulan->row_array()['totalbulan'];
        $tahunini=0;
        if($hitungbulan==12){
            $tahunini=$tahun+1;
        }
        else{
            $tahunini=$tahun;
        }
        $sqlquerya="SELECT a_des FROM hitung_des  natural join data_minyak  order by id_hitung_des desc limit 1";    
        $querya=$this->db->query($sqlquerya);
        $a=(double) $querya->row_array()['a_des'];
        
        $sqlqueryb="SELECT b_des FROM hitung_des  natural join data_minyak  order by id_hitung_des desc limit 1";    
        $queryb=$this->db->query($sqlqueryb);
        $b=(double) $queryb->row_array()['b_des'];

        $sql1="SELECT count(id_ramal_des) as total FROM ramal_des";    
        $query1 = $this->db->query($sql1);
        $countramal=  (int) $query1->row_array()['total'];
        if($countramal!=0){
            $sqlhps="DELETE FROM ramal_des ";    
            $this->db->query($sqlhps);
            for ($x = 1; $x <= $bulan; $x++){
                $jumlah_minyak_des=$a+$b*$x;
                // $this->Ramal_model->add_ramal(1,1,$x,1);
                $data = array(
                    'id_ramal_des'    => "",
                    'tahun_des'    => $tahunini,
                    'bulan_des'    => $x,
                    'jumlah_minyak_des'    => $jumlah_minyak_des
                );
                $this->db->insert('ramal_des',$data);
                if($hitungbulan%12!=0){
                    $tahunini=$tahun+1;
                }
            }
        }
        else
        {
            for ($x = 1; $x <= $bulan; $x++){
                $jumlah_minyak_des=$a+$b*$x;
                // $this->Ramal_model->add_ramal(1,1,$x,1);
                $data = array(
                    'id_ramal_des'    => "",
                    'tahun_des'    => $tahunini,
                    'bulan_des'    => $x,
                    'jumlah_minyak_des'    => $jumlah_minyak_des
                );
                $this->db->insert('ramal_des',$data);
                if($hitungbulan%12!=0){
                    $tahunini=$tahun+1;
                }
            }
        }
      
    }
    
}