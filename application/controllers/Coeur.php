<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coeur extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
	{
		parent::__construct();
		$this->load->model('Base_model','model',TRUE);		
		$this->load->helper('form');
		$this->load->helper('date'); 
		//$this->load->helper('Fonction');
		$this->load->library('form_validation');	
		$nom=$this->session->userdata('Nom');
		 date_default_timezone_set("Africa/Nairobi");
		$this->load->library('pagination');
	
	}
	public function index()
	{
		$this->load->view('Template/header');
		$this->load->view('Accueil');
		$this->load->view('Template/footer');
		
	}	
	public function traitementLogA($data =null)
	{
		$valeurEmail=$this->input->post('email');
		$valeurMdp=$this->input->post('pass');
	
		$mdp=sha1($valeurMdp);
		// var_dump($mdp);
		$data['Admin']=$this->model->get_VerificationLogA($valeurEmail,$mdp);
		
		if(!empty($data['Admin']))
		{
			
			$this->load->view('Admin/Template/header');
			$this->load->view('Admin/AccueilAdmin');
			$this->load->view('Admin/Template/footer');	
		}
		else{
		$this->form_validation	->set_error_delimiters('<div class="text-danger">','</div>');
		$this->session->set_flashdata('error','try again,invalid email password');
		
					$this->index();
		}
			
	}
	
	public function LoginAdmin($data =null)
	{
		$this->load->view('Template/header');
		$this->load->view('LoginAdmin');
		$this->load->view('Template/footer');		
	}
	public function Deconnect()
	{
		$this->index();
	}
	public function distanceEtape2($idRoute)
	{
		
		$devise['idDevise']=$this->model->get_DistanceEtape2($idRoute);
		$i=0;
		$distance=$this->distance($idRoute);
		//var_dump($distance);
		for($i;$i<sizeof($devise['idDevise']);$i++)
		{
			$Coef[$i]=$devise['idDevise'][$i]['idDevise'];
			//var_dump($Coef[$i]);
			$totalKm[$i]=$distance[$i] * $Coef[$i];
			//var_dump($totalKm[$i]);
		}
		//$this->load->view('Accueil');
		return $totalKm;
	}
	public function calculedistanceEtape2($idRoute)
	{
		$distance=$this->distanceEtape2($idRoute);
		//var_dump($distance);
		$a=0;
		$valeur=0;
		for($a;$a<sizeof($distance);$a++)
		{
			$valeur=$valeur+$distance[$a];
		}
		//var_dump($valeur);
		return $valeur;
	}
	
	public function calculeEtape3($idRoute)
	{
		
		$degradation=$this->model->get_calculeEtape3($idRoute);
		//var_dump($degradation);
		return $degradation;
	}
	public function calculeDegradation($idRoute)
	{
		
		$distance=$this->calculedistance($idRoute);
		$Coefficient=$this->calculeEtape3($idRoute);
		$AvecCoef=$this->calculedistanceEtape2($idRoute);
		//$Coefficient=($CoefficientString);
	//	var_dump($distance);
	//	var_dump($Coefficient);
	//	var_dump($AvecCoef);
		$degradation=(($distance*$Coefficient)/$AvecCoef);
	//	var_dump($degradation);
		return $degradation;
	}
	public function etatDegrationR()
	{
		
		$listeId=$this->model->get_idRoute();
		$a=0;
		for($a;$a<sizeof($listeId);$a++)
		{
			$idRoute[$a]=(int)$listeId[$a]['idRoute'];
			//$etat[$a]=$this->calculeDegradation($idRoute[$a]);
			//$etat=array();
			$etat[$a]=$this->calculeDegradation($idRoute[$a]);
			//var_dump($etat['etat']);
		
			
		}
		//var_dump($etat);
		return $etat;
		// return $etat;
	//try	{
		//$this->index();
		//var_dump($etat);
	//	$this->load->view('Accueil',$etat);
	
	//catch (Exception $e){
		
		
	}
	public function afficheee()
	{
		$etat=$this->etatDegrationR();
		
		//var_dump($etat);
	}
	
	
}
