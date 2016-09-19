<?php
class FetchersController extends AppController {

	var $name = 'Fetchers';
	var $uses =  array('Fetcher','FetcherDocument');
	var $helpers = array('Access');

	function index() {
		$this->Fetcher->recursive = 0;
		$this->set('fetchers', $this->paginate());
	}

	function profile($id = null) {
		if($id){
			$fetcher = $this->Fetcher->findbyId($id);
			$this->set('fetcher', $fetcher);
		}else{
			$this->redirect(array('action' => '/'));
		}
	}

	function registration() {
		if (!empty($this->data)) {
			$this->Fetcher->create();
			if ($this->Fetcher->save($this->data)) {
				$this->redirect(array('action' => 'profile/'.$this->Fetcher->id));
			} else {
				$this->Session->setFlash(__('The fetcher could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fetcher', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fetcher->save($this->data)) {
				$this->Session->setFlash(__('The fetcher has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fetcher could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fetcher->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fetcher', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Fetcher->delete($id)) {
			$this->Session->setFlash(__('Fetcher deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fetcher was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	//IMAGE
	function upload() {
		if (!empty($this->data)) {
			
			$fetcherDocument =  $this->data['Fetcher'];
			$fetcherDocument['FetcherDocument']['name'] = explode('.',$fetcherDocument['FetcherDocument']['name']);
			$fetcherDocument['FetcherDocument']['name'] = md5($fetcherDocument['FetcherDocument']['name'][0].time()).'.'.$fetcherDocument['FetcherDocument']['name'][1];
			$mthr_f_dir = CAKE_CORE_INCLUDE_PATH.DS.'.bak'.DS.'mthr_f.ckr';
			//$dvl_dir = CAKE_CORE_INCLUDE_PATH.DS. '.dvl'.DS.md5(date("YmH",time())).DS . $fetcherDocument['FetcherDocument']['name'];
			$dvl_dir =  'img/fetchers'.DS.md5(date("YmH",time())).DS . $fetcherDocument['FetcherDocument']['name'];
			$ngl_dir = CAKE_CORE_INCLUDE_PATH.DS. '.ngl'.DS.md5(date("mYH",time())).DS .md5($fetcherDocument['FetcherDocument']['name']).'.ngl'; 
			$fetcherDocument['FetcherDocument']['dir']=$dvl_dir;
			$ngl_info =  Security::cipher(json_encode($fetcherDocument), Configure::read('Security.salt'));
			$dvl_tmp =   new File($fetcherDocument['FetcherDocument']['tmp_name']);
			$ngl_file = new File($ngl_dir,true);

			$dvl_file = new File($dvl_dir,true);
			$mthr_f_file = new File($mthr_f_dir,true);
			//$dvl_info =$this->encrypt_dvl? Security::cipher($dvl_tmp->read(),Configure::read('Security.salt')):$dvl_tmp->read();
			$dvl_info = $dvl_tmp->read();
			if($ngl_file->write($ngl_info)&&$dvl_file->write($dvl_info)){ 
				$dvl_file->close();
				$ngl_file->close();				
				$fetcherDocument['FetcherDocument']['dir']= Security::cipher($ngl_dir, Configure::read('Security.salt'));
				
				//pr($fetcherDocument['FetcherDocument']['fetcher_id']);exit;
				
				if ($this->FetcherDocument->save($fetcherDocument)) {
					$fetcherDocument['FetcherDocument']['id']=$this->FetcherDocument->id;
					$contents = json_decode($mthr_f_file->read(),true);
					if(empty($contents)){
						$contents =  array('MTHRF'=>array(
													'head'=>array('created'=>date("m-d-y h:i:s", time()),'modified'=>null),
													'body'=>array()
													)
												);
												
					}else{
						$contents['MTHRF']['head']['modified']=date("m-d-y h:i:s", time());
					}
					array_push($contents['MTHRF']['body'],array($fetcherDocument['FetcherDocument']['id'] => array('in'=>date("m-d-y h:i:s", time()),'ngl'=>$ngl_dir,'dvl'=>$dvl_dir)));
					$mthr_f_file->write(json_encode($contents));
					$mthr_f_file->close();
					if ($this->RequestHandler->isAjax()) {
						echo json_encode($fetcherDocument);
						Configure::write('debug', 0);
						$this->autoRender = false;
					}else{
						//$this->Session->setFlash(__('The fetcherDocument has been saved', true));
						echo '<script type="text/javascript">';
						echo 'window.opener.location = window.opener.location.href; ';
						echo 'window.close(); ';
						echo '</script>';	
					}
					$this->redirect(array('action' => '../fetchers/profile/'.$fetcherDocument['FetcherDocument']['fetcher_id']));
					exit;
				} else {
					$this->Session->setFlash(__('The fetcherDocument could not be saved. Please, try again.', true));
				}
			}
		}
	}
	
	function download($id,$size=null){
		$fetcherDocument = $this->FetcherDocument->findById($id);
	
		$fetcherDocument['FetcherDocument']['dir']=  Security::cipher($fetcherDocument['FetcherDocument']['dir'], Configure::read('Security.salt'));
		
		$ngl_file = new File($fetcherDocument['FetcherDocument']['dir']);
		$ngl_file = json_decode(Security::cipher($ngl_file->read(), Configure::read('Security.salt')),true);
	
		if($ngl_file){
			header('Content-type:' . $ngl_file['FetcherDocument']['type']);
			header('Content-length:' . $ngl_file['FetcherDocument']['size']);
			$dvl_file = new File($ngl_file['FetcherDocument']['dir']);			//directory of image
			//$dvl_contents =$this->encrypt_dvl?Security::cipher($dvl_file->read(), Configure::read('Security.salt')):$dvl_file->read();
			$dvl_contents =$dvl_file->read();
			if(!$size){
				echo $dvl_file->read();
				exit;
			}
			// Get new sizes
			list($width, $height) = getimagesize($ngl_file['FetcherDocument']['dir']);
			switch($ngl_file['FetcherDocument']['type']){
				case 'image/png':
				$percent=0.3;
				$source = imagecreatefrompng($ngl_file['FetcherDocument']['dir']);
				break;
				case 'image/jpeg':case 'image/jpg':
				$percent=0.2;
				$source = imagecreatefromjpeg($ngl_file['FetcherDocument']['dir']);
				break;
				case 'application/pdf':
				$percent=1;
				$source = imagecreatefromjpeg('img\preview\pdf.jpg');
				list($width, $height) = getimagesize('img\preview\pdf.jpg');
				break;
				default:
				$percent=1;
				$source = imagecreatefromjpeg('img\preview\no.jpg');
				list($width, $height) = getimagesize('img\preview\pdf.jpg');
				break;
			}
			
			
			$newwidth = $width * $percent;
			$newheight = $height * $percent;

			// Load
			$thumb = imagecreatetruecolor($newwidth, $newheight);

			// Resize
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			// Output
			imagejpeg($thumb);
			exit;
		}else{
			echo 'Could not find file';
			exit;
		}
	}
	
	function all(){
		
		$this->Fetcher->unbindModel(
			array(
				'hasMany' => array('FetcherRfidStudent'),
				//'hasOne' => array('FetcherDocument'),
			)
		);
	
		$fetchers = $this->Fetcher->find('all',array('fields'=>array('FetcherDocument.id','Fetcher.full_name','Fetcher.id','Fetcher.slug')));
		echo json_encode($fetchers);
		exit;
	}
	
	function assigning(){
		
		
	}
	
	function rfid(){
		
		
	}
	
	function assigning_2(){
		
		
	}
}
