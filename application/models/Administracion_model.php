<?Php

    class Administracion_model extends CI_model {
       
        /**
         * funcion loginUser()
         * descripcion: funcion que se conecta a la bd y consulta el usuario
         * a logearse
         * 
         * @author Cesar Carrasco <educamo@hotmail.com>
         *
         * @param [array] $data
         *
         * @return void $query || null
         * @date: [20-05-2021]
         */
        public function loginUser($data) {
            $activo = 1;
            $delete = 0;
            $admin  = 1;
            $this->db->select('idUser, nombresUsuario, apellidosUsuario, username, imagenUsuario, administrador, activo');
            $this->db->from('nu_users');
            $this->db->where('username', $data['username']);
            $this->db->where('password', md5($data['password']));
            $this->db->where('administrador', $admin);
            $this->db->where('activo', $activo);
            $this->db->where('delete', $delete);

            $query=$this->db->get();

            if ($query->num_rows()>0) {
                return $query->result();
            }else{
                return NULL;
            }

        }

        /**
         * funcion getModulos()
         * descripcion: consulta en la bd los modulos activos y los permisos dependiendo
         * del usuario logueado
         * 
         * @author Cesar Carrasco <educamo@hotmail.com>
         * 
         * @return void $queryMod || null
         * @date: [20-05-2021]
         */
        public function getModulos(){
            $activo = 1;
            $tipo = 'modulo';
            $this->db->select('Modu.idMod, Modu.Modulo, Modu.url, Modu.icon, Per.idUser');
            $this->db->from('nu_modulos Modu');
            $this->db->join('nu_permisosusuarios Per', 'Modu.idMod = Per.idRelacion');
            $this->db->where('Modu.activo', $activo);
            $this->db->where('Modu.tipo', $tipo);
            $this->db->order_by('Modu.idMod', "asc");

            $queryMod = $this->db->get();
            if ($queryMod->num_rows()>0) {
                return $queryMod->result_array();
            }else{
                return NULL;
            }
        }

        /**
         * funcion getsubmodulos()
         * descripcion: consulta los submodulos en la bd y los permisos dependiendo
         * del usuario logueado
         * 
         * @author Cesar Carrasco <educamo@hotmail.com>     
         *
         * @param [string] $data
         *
         * @return void $queryMod || null
         * @date: [20-05-2021]
         */
        public function getsubmodulos($data){
            
            $activo = 1;
            $tipo = 'submodulo';
            $modulo = $data;
            $this->db->select('Modu.idMod, Modu.Modulo, Modu.nombre, Modu.url, Modu.icon, Per.idUser');
            $this->db->from('nu_modulos Modu');
            $this->db->join('nu_permisosusuarios Per', 'Modu.idMod = Per.idRelacion');
            $this->db->where('Modu.activo', $activo);
            $this->db->where('Modu.tipo', $tipo);
            $this->db->where('Modu.Modulo', $modulo);

            $queryMod = $this->db->get();

           // $data = $this->db->last_query( $queryMod);

            if ($queryMod->num_rows()>0) {
                return $queryMod->result_array();
            }else{
                return NULL;
            }

        }

        /**
         * funcion getUsuarios()
         * descripcion: 
         * 
         * @author Cesar Carrasco <educamo@hotmail.com>
         *
         * @param [string] $tab
         *
         * @return void $data
         * @date: [22-05-2021]
         */
        public function getUsuarios($tab){

            $data['msg'] = $tab;
            return $data;
        }

        /**
         * funcion _destruct()
         * descripcion: se ejecuta al no haber otra funcion que se ejecute
         * y sirve para cerrar la coneccion con la bd
         * 
         * @author Cesar Carrasco <educamo@hotmail.com>
         *
         * @date: [22-05-2021]
         */
        public function __destruct(){
            $this->db->close();
        }

    }
?> 