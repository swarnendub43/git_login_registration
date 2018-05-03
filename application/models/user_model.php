<?php
class User_model extends CI_model{
 
 
 
public function register_user($user,$record,$roles){
 
 if($user && isset($record)){
$this->db->insert('user',$user );
$this->db->insert('roles',$roles);
return $this->db->id();
 }
}
 
public function login_user($email,$pass){
 
  $this->db->select('*');
  $this->db->from('user');
  $this->db->where('user_email',$email);
  $this->db->where('user_password',$pass);
  $this->db->select('user.*,roles.*');
  $this->db->from('user');
  $this->db->join('roles','user.rid=roles.rid','left');
/* $select = "select $roles.rolename,$roles.rid";
 $from = "roles";
 $where = "LEFT JOIN user ON roles.rid = user.rid";
 $sql = $select. " ".$from." ".$where;
 $roles->query($sql);*/
 
  if($query=$this->db->get())
  {
      return $query->row_array();
  }
  else{
    return false;
  }
 
 
}


public function email_check($email){
 
  $this->db->select('*');
  $this->db->from('user');
  $this->db->where('user_email',$email);
  $query=$this->db->get();
 
  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }
 
}
 
 
}
 
 
?>