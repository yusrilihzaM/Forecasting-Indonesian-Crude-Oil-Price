<?php
class Hasil_forecast_model extends CI_model
{
    public function get_ses_minyak()
    {
        $sqldtall="SELECT jumlah_minyak FROM data_minyak NATURAL JOIN hitung_ses where y_aksen_ses!=''";
        $query1 = $this->db->query($sqldtall);
        return $query1->result_array();
       
    }
    public function get_ses_hasil()
    {
        $sqldtall="SELECT y_aksen_ses FROM data_minyak NATURAL JOIN hitung_ses where y_aksen_ses!=''";
        $query1 = $this->db->query($sqldtall);
        return $query1->result_array();
       
    }
    public function get_des_minyak()
    {
        $sqldtall="SELECT jumlah_minyak FROM data_minyak NATURAL JOIN hitung_des";
        $query1 = $this->db->query($sqldtall);
        return $query1->result_array();
       
    }
    public function get_des_hasil()
    {
        $sqldtall="SELECT y_aksen_des FROM data_minyak NATURAL JOIN hitung_des";
        $query1 = $this->db->query($sqldtall);
        return $query1->result_array();
       
    }
    public function get_all_ses()
    {
        $sqldtall="SELECT * FROM data_minyak NATURAL JOIN hitung_ses ";
        $query1 = $this->db->query($sqldtall);
        return $query1->result_array();
       
    }
    public function get_all_des()
    {
        $sqldtall="SELECT * FROM data_minyak NATURAL JOIN hitung_des ";
        $query1 = $this->db->query($sqldtall);
        return $query1->result_array();
       
    }
    public function get_label_bawah()
    {
        $sqldtall="SELECT * FROM data_minyak where id_data_minyak!=1 ";
        $query1 = $this->db->query($sqldtall);
        return $query1->result_array();


        return $this->db->get()->result_array();
    }
    public function get_mape_ses()
    {
        $sum="SELECT SUM(abs_at_ft_ses) as total FROM hitung_ses NATURAL JOIN data_minyak";    
        $query1 = $this->db->query($sum);
        $sumabs=  (double) $query1->row_array()['total'];
        $carin="SELECT COUNT(abs_at_ft_ses) as n FROM hitung_ses NATURAL JOIN data_minyak where abs_at_ft_ses!=''";
        $query2 = $this->db->query($carin);
        $n=  (integer) $query2->row_array()['n'];
        if ($n==0){
            
            $MAPE=0;
        }else{
            $MAPE=(100/$n)*$sumabs;
        }
       
        return $MAPE;
       
    }
    public function get_mape_des()
    {
        $sum="SELECT SUM(abs_at_ft_bagiat_des) as total FROM hitung_des NATURAL JOIN data_minyak";    
        $query1 = $this->db->query($sum);
        $sumabs=  (double) $query1->row_array()['total'];
        $carin="SELECT COUNT(abs_at_ft_bagiat_des) as n FROM hitung_des NATURAL JOIN data_minyak where id_data_minyak!=1";
        $query2 = $this->db->query($carin);
        $n=  (integer) $query2->row_array()['n'];
        if ($n==0){
            
            $MAPE=0;
        }else{
            $MAPE=(100/$n)*$sumabs;
        }
       
        return $MAPE;
       
    }
    public function get_masa_depan_ses()
    {
        $this->db->select('*');
        
        $this->db->from('ramal_ses');
      
        return $this->db->get()->result_array();
    }
    public function get_masa_depan_des()
    {
        $this->db->select('*');
        
        $this->db->from('ramal_des');
      
        return $this->db->get()->result_array();
    }
}