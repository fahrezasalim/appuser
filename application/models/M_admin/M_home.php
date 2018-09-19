<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model{
	function get_data($year){

  $sql= $this->db->query("
  select
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=01)AND (YEAR(periode)=".$year."))),0) AS `Januari`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=02)AND (YEAR(periode)=".$year."))),0) AS `Februari`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=03)AND (YEAR(periode)=".$year."))),0) AS `Maret`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=04)AND (YEAR(periode)=".$year."))),0) AS `April`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=05)AND (YEAR(periode)=".$year."))),0) AS `Mei`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=06)AND (YEAR(periode)=".$year."))),0) AS `Juni`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=07)AND (YEAR(periode)=".$year."))),0) AS `Juli`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=08)AND (YEAR(periode)=".$year."))),0) AS `Agustus`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=09)AND (YEAR(periode)=".$year."))),0) AS `September`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=10)AND (YEAR(periode)=".$year."))),0) AS `Oktober`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=11)AND (YEAR(periode)=".$year."))),0) AS `November`,
  ifnull((SELECT count(id_user) FROM (tb_sum)WHERE((Month(periode)=12)AND (YEAR(periode)=".$year."))),0) AS `Desember`

	");

  return $sql;

 }

 function count_user(){
         return $this->db->get('tb_user')->num_rows();     
 }
}
?>
