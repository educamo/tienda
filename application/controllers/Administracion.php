<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administracion extends CI_Controller
{
	## declaracion de variables
	protected  $urlBase;

	public function __construct()
	{
		parent::__construct();

		## carga de	modelos
		$this->load->model(array('Administracion_model'));

		## asignacion de variables
		$this->urlBase = base_url('administracion');

		$this->lang->load("Administracion");

	}

	/**
	 * funcion index
	 * descripcion: carga por default
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 * 
	 * @return void
	 * @date: [15-05-2021]
	 */
	public function index()
	{
		$this->loadViews('administrador/dashboard');
	}

	/**
	 * funcion login
	 * descripcion: se encarga de cargar el login y crear la session
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 * 
	 * @date [15-05-2021]
	 */
	public function login()
	{
		$data = $this->obtenerLogo();
		$dataPage['logo'] = $data[0]->valorConfig;
		$dataPage['config'] = $data[0]->nombreConfig; 
		$dataPage['title'] = "Login Panel de Administración - Tienda";

		if (isset($_POST['username']) && isset($_POST['password'])) {
			$login = $this->Administracion_model->loginUser($_POST);
			if ($login) {
				$arrayUser = array(
					'idUser' 			=> $login[0]->idUser,
					'nombresUsuario' 	=> $login[0]->nombresUsuario,
					'apellidosUsuario'  => $login[0]->apellidosUsuario,
					'imagenUsuario'     => $login[0]->imagenUsuario,
					'username' 			=> $login[0]->username,
					'administrador' 	=> $login[0]->administrador,
					'activo' 			=> $login[0]->activo,
				);
				$this->session->set_userdata($arrayUser);
			}
		}
		
		$this->loadViews('administrador/login',$dataPage);
	}

	/**
	 * Funcion configuracion
	 * descripcion: se encarga de llamar la vista del modulo de configuracion
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 * 
	 * @return void
	 * @date: [17-05-2021]
	 */
	public function configuracion (){
		$data['urlbase'] = $this->urlBase;
								
		$this->loadViews('administrador/configuracion', $data);

	}

	/**
	 * funcion usuarios
	 * descripcion: se encarga de cargar la vista del modulo de usuaios
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 * 
	 * @return void
	 * @date: [16-05-2021]
	 */
	public function usuarios (){
		$modulo = 'usuarios';
		$data['urlBase'] = $this->urlBase;
		$subModulos = $this->getSubmodulos($modulo);

		$data['subModulos'] = $subModulos;
								
		$this->loadViews('administrador/usuarios', $data);

	}

	/**
	 * funcion cuentasUsuarios
	 * descripcion: carga las vistas de las tabs del modulo usuarios
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 *
	 * @return void
	 * @date: [19-05-2021]
	 */
	public function cuentasusuarios(){

		$tab = $this->input->post('tab');

		$data= $this->getUsuarios($tab);
		if ($tab == 'meguser') {
			$vista = $this->load->view('administrador/cuentasusuarios', $data, true); 
		}else {
			$vista = $this->load->view('administrador/permisosusuarios', $data, true);
		}
		echo json_encode($vista);
		
	}


	/* funciones privadas */

	
	/**
	 * funcion obtenerLogo
	 * descripcion: se encarga de cargar el logo desde la configuracion
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 *
	 * @return [Array] $data
	 * @date: [16-05-2021]
	 */
	private function obtenerLogo(){
		$data = $this->Config_model->get_logo();
		return $data;
	}
	
	/**
	 * funcion para cargar vistas
	 * descripcion: se cargan las vistas dependiendo si existe una session
	 * o si no redirecciona al login
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 * 
	 * @param [String] $view
	 * @param [Array] $data
	 *
	 * @return void
	 * @date: [17-05-2021]
	 */
	private function loadViews($view, $data = null)	{
		
		// Si la ssesion esta iniciada
		if (isset($_SESSION['username'])) {

			// si la la vista es login se redirecciona al home del Dashboard
			if ($view == 'administrador/login') {
				redirect(base_url() . "administracion", "location", $data);
			}
			// carga la vista del template y dashboard	
			$dataPage = $data;	
			$data = $this->dashBoard();

			if ($this->uri->segment(2)) {
				# code...
				$data['title']		= "Panel de Administración - ".$this->uri->segment(2);
			}

			
			
			$this->load->view('administrador/includes/paneles', $data);
			$this->load->view('administrador/includes/header');
			$this->load->view($view, $dataPage);
			$this->load->view('administrador/includes/footer');
			

			// Si no tenemos session iniciada
		} else {
			if (($view == 'administrador/login')) {
				$this->load->view($view, $data);

				//si la vista es otra cualquiera se redirecciona a login
			} else {
				redirect(base_url() . "administracion/login", "location");
			}
		}
	}

	/**
	 * funcion dashBoard
	 * descripcion: se encarga de cargar los elementos principales del
	 * Dashboard y panel de administracion
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 *
	 * @return [Array] $dataPage
	 * @date: [17-05-2021]
	 */
	private function dashBoard(){

		$data = $this->obtenerLogo();
		$modulos = $this->Administracion_model->getModulos();
		
		if (isset($_SESSION['username']) && isset($_SESSION['imagenUsuario'])) {
			
			$dataPage = array(
				'logo' => $data[0]->valorConfig,
				'config' => $data[0]->nombreConfig,
				'title' => "Panel de Administración - Tienda",
				'imguser' => $_SESSION['imagenUsuario'],
				'modulos' => $modulos,
				
			);
		}else {
			$dataPage = array(
				'logo' => $data[0]->valorConfig,
				'config' => $data[0]->nombreConfig,
				'title' => "Panel de Administración - Tienda",
				'imguser' => 'admin.jpg',
				
			);

		}

		return $dataPage;

	}

	/**
	 * funcion getsubModulos
	 * descripcion: carga los datos de los subModulos
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 *
	 * @param [String] $data
	 *
	 * @return [Array] $subModulos
	 * @date: [17-05-2021]
	 */
	private function getsubModulos($data) {

		$subModulos = $this->Administracion_model->getsubmodulos($data);

		return $subModulos;
	}
	
	/**
	 * funcion getUsuarios
	 * descripcion: carga los datos de las tabs del modulo de usuarios desde el modelo
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 *
	 * @return void
	 * @date: [19-0-2021]
	 */
	private function getUsuarios($tab){
		$datos = $this->Administracion_model->getUsuarios($tab);
		return $datos;
	}
	
	/**
	 * funcion logout
	 * descripcion: se encarga de destruir la sesion activa
	 * 
	 * @author Cesar Carrasco <educamo@hotmail.com>
	 *
	 * @return void
	 * @date: [15-05-2021]
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . "administracion/login", "location");
	}
}
