<?Php

    class Config_model extends CI_model {
        public function get_logo(){
            $this->db->select('*');
            $this->db->from('nu_configuracion');
            $this->db->where('nombreConfig', 'logo');
            $query=$this->db->get();
            if ($query->num_rows()>0) {
                return $query->result();
            }else{
                return NULL;
            }
        } 

    }
?>