 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Base_model extends CI_Model
{
	public function get_VerificationLogA($valeurEmail,$valeurMdp)
	{
		$this->db->cache_off();
		$query = $this->db->query("SELECT * FROM Admin WHERE Email = '$valeurEmail' AND MotDePasse='$valeurMdp'");
		//var_dump($query);
		return $result =$query->result();
	}
	public function get_Admin()
	{
		//select tout les Admin
		$this->db->select('*');
		$this->db->from('Admin');
		$query=$this->db->get();
		return $result =$query->result();
	}
	public function get_Devise()
	{
		//select tout les Routes
		$this->db->select('*');
		$this->db->from('devise');
		$query=$this->db->get();
		return $result =$query->result();
	}
	public function get_Uneportion()
	{
		//select tout les Routes
		$this->db->select('*');
		$this->db->from('uneportion');
		$query=$this->db->get();
		return $result =$query->result();
	}
	public function get_Route()
	{
		//select tout les Routes
		$this->db->select('*');
		$this->db->from('Routes');
		$query=$this->db->get();
		return $result =$query->result();
	}
	public function insert_F($Nom,$email,$Mdp)
	{
		$sql="insert into Utilisateurs(Nom,email,Mdp) values ('%s','%s','%s')";
		$sql=sprintf($sql,$this->db->escape($Nom),$this->db->escape($email),$this->db->escape($Mdp));
		return $this->db->affected_rows();
	}
	public function get_Modifier($idRN,$Borne,$Depart,$Arriver)
		{
			$this->db->cache_off();
			$query = $this->db->query("update Routes set Borne='$Borne',DepartVille='$Depart',ArriveVille='$Arriver' where idRoute = '$idRN'");
			return $this->db->affected_rows();
		}
		
		public function get_ModifierEntretien($Etat,$distance,$PrixConstruction,$Delai)
		{
			$this->db->cache_off();
			$query = $this->db->query("update devise set Etat='$Etat',distance='$distance',PrixConstruction='$PrixConstruction' ,Delai='$Delai'where Etat = '$Etat'");
			return $this->db->affected_rows();
		}
	public function get_Supprimer($idRN)
		{
			$this->db->cache_off();
			$query = $this->db->query("DELETE FROM Routes WHERE idRoute = '$idRN'");
			return $this->db->affected_rows();
		}
	public function Compter()
	{
		//select tout les utilisateurs
		$this->db->cache_off();
		$query = $this->db->query("SELECT count(*) FROM Routes");
		return $result =$query->result();
	}
	//public function get_Ajout($idRoute,$RN,$Borne,$DepartVille,$ArriveVille)
	public function get_Ajout($RN,$Borne,$DepartVille,$ArriveVille)
		{	
		$sql="insert into Routes(RN,Borne,DepartVille,ArriveVille) values (".$RN.",".$Borne.",'".$DepartVille."','".$ArriveVille."')";
			//$sql="insert into Routes(idRoute,RN,Borne,DepartVille,ArriveVille) values ('".$idRoute."',".$RN.",".$Borne.",'".$DepartVille."','".$ArriveVille."')";
			//$sql=sprintf($sqlinsert,$this->db->escape($idRoute),$this->db->escape($RN),$this->db->escape($Borne),$this->db->escape($DepartVille),$this->db->escape($ArriveVille));
			//var_dump($sql);
			$this->db->query($sql);
			//return $this->db->affected_rows();
		}
		
	public function new_utilisateur($data)
	{
		//insert dans la table  Utilisateurs
		$this->db->insert('Utilisateurs',$data);
		return $insert_id =$this->db->insert_id();
	}
	
	public function get_Utilisateurs()
	{
		//select tout les utilisateurs
		$this->db->select('*');
		$this->db->from('Utilisateurs');
		$query=$this->db->get();
		return $result =$query->result();
	}
	

	public function get_Recherche($valeurEmail,$valeurMdp)
	{
		$this->db->cache_off();
		$query = $this->db->query("SELECT Prenom FROM Admin WHERE Prenom = '$valeurEmail' AND MotDePasse='$valeurMdp'");
		return $result =$query->result();
	}
	public function get_RecherchePers($valeurNom,$valeurMdp)
	{
		$this->db->cache_off();
		$query = $this->db->query("SELECT Nom FROM Personnel WHERE Nom = '$valeurNom' AND Mdp='$valeurMdp'");
		return $result =$query->result();
	}
	public function get_RechercheMatiere()
		{
			$this->db->cache_off();
			$query = $this->db->query("SELECT * FROM produit");
			return $result =$query->result();
		}
	public function get_Stock($LeNom)
		{
			$this->db->cache_off();
			$query = $this->db->query("SELECT * FROM produit WHERE NOT $LeNom=''");


			return $result =$query->result();
		}
	public function insert_Stock($LeNom,$total)
		{
			$sql="insert into Produit($LeNom) values ('%s') ";
			$sql=sprintf($sql,$this->db->escape($total));
			//var_dump($sql);
			$this->db->query($sql);
			return $this->db->affected_rows();
		}
	public function total_Stock()
		{
			$this->db->cache_off();
			$query = $this->db->query("SELECT sum(Lait) as Lait,sum(Sucre) as Sucre ,sum(Parfum) as Parfum ,sum(Colorant) as Colorant ,sum(fruit) as fruit,sum(conservateur) as conservateur FROM Produit");
			//var_dump($query);
			return $result =$query->result();
		}


/*	public function get_RechercheMatiere($LeNom)
	{
		$this->db->cache_off();
		$query = $this->db->query("SELECT $LeNom FROM produit");
		return $result =$query->result();
	}
	*/
	
	public function get_RouteModifier($idRN)
	{
		//select tout les utilisateurs
		$this->db->cache_off();
		$query = $this->db->query("SELECT * FROM Routes WHERE RN = '$idRN'");
		return $result =$query->result();
	} 
	public function get_UneParamaetre($idDevise)
	{
		//select tout les utilisateurs
		$this->db->cache_off();
		$query = $this->db->query("SELECT * FROM Devise WHERE idDevise = '$idDevise'");
		return $result =$query->result();
	} 
	

		public function get_Portion(){

            $sql = "SELECT  * FROM uneportion order by idRoute";
            $query = $this->db->query($sql);
            $portion = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   
                $portion[$i]['idRoute']=$row['idRoute'];
                $portion[$i]['DebutPortion']=$row['DebutPortion'];
				$portion[$i]['FinPortion']=$row['FinPortion'];
				$portion[$i]['idDevise']=$row['idDevise'];
                $i++;
            }

            return $portion;
        }

	public function get_PortionRoute($idRoute)
	{
		 $sql = "SELECT  * FROM uneportion WHERE idRoute = '$idRoute'";
            $query = $this->db->query($sql);
            $portionModif = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   
				 $portionModif[$i]['idPortion']=$row['idPortion'];
                $portionModif[$i]['DebutPortion']=$row['DebutPortion'];
				$portionModif[$i]['FinPortion']=$row['FinPortion'];
				$portionModif[$i]['idDevise']=$row['idDevise'];
                $i++;
            }

            return $portionModif;
	} 
	public function get_PortionRouteDeux($idRoute)
	{
		//select tout les utilisateurs
		$this->db->cache_off();
		$query = $this->db->query("SELECT * FROM uneportion WHERE idRoute = '$idRoute'");
		return $result =$query->result();
	} 
	
	public function get_ModifierPortion($idPortion,$DebutPortion,$FinPortion,$idDevise)
		{
			$this->db->cache_off();
			$query = $this->db->query("update uneportion set DebutPortion='$DebutPortion',FinPortion='$FinPortion' ,idDevise='$idDevise'where idPortion = '$idPortion'");
			return $this->db->affected_rows();
		}
		
	public function get_SupprimerPortion($idRoute)
	{
		//select tout les utilisateurs
		$this->db->cache_off();
		$query = $this->db->query("DELETE FROM uneportion WHERE idRoute = '$idRoute'");
		return $this->db->affected_rows();
	} 
	
	public function get_AjoutPortion($idRoute,$DebutPortion,$FinPortion,$idDevise)
		{	
			$sql="insert into uneportion(idRoute,DebutPortion,FinPortion,idDevise) values (".$idRoute.",".$DebutPortion.",'".$FinPortion."','".$idDevise."')";	
			$this->db->query($sql);
		}
		
		
/////////////////////////////////////////UTILISATEUR MODEL/////////////////////////////////////////////////////////////////////////////////
		
		
		public function get_RouteUtilisateur(){
            $sql = "SELECT * FROM routes order by idRoute";
            $query = $this->db->query($sql);
            $route = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   
                $route[$i]['RN']=$row['RN'];
                $route[$i]['Borne']=$row['Borne'];
				$route[$i]['DepartVille']=$row['DepartVille'];
				$route[$i]['ArriveVille']=$row['ArriveVille'];
                $i++;
            }

            return $route;
        }

		
	public function get_RechercheMot($recherche)
	{
		$this->db->cache_off();
		
		$query = $this->db->query("Select * FROM routes WHERE DepartVille like '%$recherche%' OR ArriveVille like '%$recherche%'");	
		return $result =$query->result();
	} 
	/*	
	public function get_TrieNom()
	{
		$this->db->cache_off();
		$query = $this->db->query("Select * FROM routes order by DepartVille asc");	
		return $result =$query->result();
	} */
	public function get_TrieNom(){

            $sql = "SELECT * FROM routes order by DepartVille asc";
            $query = $this->db->query($sql);
            $route = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   
                $route[$i]['RN']=$row['RN'];
                $route[$i]['Borne']=$row['Borne'];
				$route[$i]['DepartVille']=$row['DepartVille'];
				$route[$i]['ArriveVille']=$row['ArriveVille'];
                $i++;
            }

            return $route;
        }
	public function get_TrieLong()
	{
		$this->db->cache_off();
		$query = $this->db->query("Select * FROM routes order by Borne asc");	
		return $result =$query->result();
	} 
	public function get_TrieEtat()
	{
		$this->db->cache_off();
		$query = $this->db->query("Select * FROM routes order by Borne asc");	
		return $result =$query->result();
	} 
	
	
	
	/////////////////////////////////////////CALCULE ETAT ROUTE MODEL/////////////////////////////////////////////////////////////////////////////////
		public function get_Distance($idRoute){

            $sql = "SELECT * FROM uneportion WHERE idRoute = '$idRoute' ";
            $query = $this->db->query($sql);
            $portion = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   
				$portion[$i]['idPortion']=$row['idPortion'];
				$portion[$i]['idRoute']=$row['idRoute'];
                $portion[$i]['DebutPortion']=$row['DebutPortion'];
				$portion[$i]['FinPortion']=$row['FinPortion'];
				$portion[$i]['idDevise']=$row['idDevise'];
                $i++;
            }

            return $portion;
        }
	public function get_DistanceEtape1($idRoute){

            $sql = "SELECT DebutPortion,FinPortion FROM uneportion WHERE idRoute = '$idRoute' ";
            $query = $this->db->query($sql);
            $distance = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   

                $distance[$i]['DebutPortion']=$row['DebutPortion'];
				$distance[$i]['FinPortion']=$row['FinPortion'];
                $i++;
            }

            return $distance;
        }
	public function get_DistanceEtape2($idRoute){

            $sql = "SELECT idDevise FROM uneportion WHERE idRoute = '$idRoute' ";
            $query = $this->db->query($sql);
            $devise = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   
				$devise[$i]['idDevise']=$row['idDevise'];
                $i++;
            }

            return $devise;
        } 
		/*
		public function get_DistanceEtape3($idRoute){

            $sql = "SELECT * FROM degradation WHERE idRoute = '$idRoute' ";
            $query = $this->db->query($sql);
            $degradation = array();
            $i = 0;

            foreach($query->result_array() as $row)
            {   
				$degradation[$i]['pourcentage']=$row['pourcentage'];
                $i++;
            }

            return $degradation;
        } */
		public function get_calculeEtape3($idRoute){

            $sql = "SELECT sum(pourcentage) as somme FROM degradation WHERE idRoute = '$idRoute' ";
            $query = $this->db->query($sql);
            $degradation = $query->result_array();     
            return (int)$degradation[0]['somme'];
        }
		public function get_idRoute(){

            $sql = "SELECT idRoute FROM uneportion";
            $query = $this->db->query($sql);
            $degradation = $query->result_array();     
            return $degradation;
        }
		
		
		public function RechercheMultiple($valeur){
			//$terme=strtolower($valeur);
           // $sql = "SELECT DISTINCT DepartVille.r,nom.l FROM Routes r,listeVilleAndrana l where Routes.idRoute=listeVilleAndrana.idRoute LIKE $terme ";
			$sql = "SELECT Borne,DepartVille,ArriveVille FROM Routes where CONCAT(DepartVille,ArriveVille) LIKE '%$valeur%'";
			var_dump($sql);
            $query = $this->db->query($sql);
			
            $resultRecherche = $query->result_array();     
            return $resultRecherche;
			var_dump($resultRecherche);	
        }
		
}