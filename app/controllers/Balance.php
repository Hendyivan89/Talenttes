<?php

class Balance extends Controller {
	public function index(){
		$data['title'] = 'Data Balance';
		$data['balance'] = $this->model('Balance_model')->getBalance();
		$this->view('templates/header', $data);
		$this->view('balance/index', $data);
		$this->view('templates/footer');
	}

	public function detail($id){

		$data['title'] = 'Detail Balance';
		$data['balance'] = $this->model('Balance_model')->getBalanceByCustId($id);
		$this->view('templates/header', $data);
		$this->view('balance/detail', $data);
		$this->view('templates/footer');
	}

	public function edit($id){

		$data['title'] = 'Detail Balance';
		$data['balance'] = $this->model('Balance_model')->getAllMhasiswaById($id);
		$this->view('templates/header', $data);
		$this->view('balance/edit', $data);
		$this->view('templates/footer');
	}

	public function addBalance(){
		$data['title'] = 'Topup Balance';		
		$this->view('templates/header', $data);
		$this->view('balance/tambah');
		$this->view('templates/footer');
	}

	public function savebalance(){		
		if( $this->model('Balance_model')->addBalance($_POST) > 0 ) {
			$data['balance'] = $this->model('Balance_model')->getBalance();
			$this->model('Balance_model')->addHistoryBalance($_POST, 'deposit', $data['balance'][0]['amount']);
			Flasher::setMessage('Success','Added','success');
			header('location: '. BASEURL . '/balance');
			exit;			
		}else{
			Flasher::setMessage('Failed','Added','danger');
			header('location: '. BASEURL . '/balance');
			exit;	
		}
	}

	public function withdrawbalance(){		
		$datapost = $_POST;
		$id = $datapost['id'];
		$data['balance'] = $this->model('Balance_model')->getBalanceByCustId($id);
		

		if($datapost['amount'] <= $data['balance']['amount']) {
			
			$balance = $data['balance']['amount'] - $datapost['amount'];

			if( $this->model('Balance_model')->updateBalance($_POST, $balance) > 0 ) {
				$data['balance'] = $this->model('Balance_model')->getBalanceByCustId($id);
				$this->model('Balance_model')->addHistoryBalance($_POST, 'withdraw', $data['balance']['amount']);
				Flasher::setMessage('Success Withdraw','Added','success');
				header('location: '. BASEURL . '/balance');
				exit;			
			}else{
				Flasher::setMessage('Failed','Added','danger');
				header('location: '. BASEURL . '/balance');
				exit;	
			}
		} else {
			Flasher::setMessage('Your Balance is Insufficient','Added','danger');
			header('location: '. BASEURL . '/balance');
			exit;
		}
		
	}

	public function updateBalance(){	
		if( $this->model('Balance_model')->updateBalance($_POST) > 0 ) {
			Flasher::setMessage('Success','updated','success');
			header('location: '. BASEURL . '/balance');
			exit;			
		}else{
			Flasher::setMessage('Failed','updated','danger');
			header('location: '. BASEURL . '/balance');
			exit;	
		}
	}

	public function getDataChange(){

		$id = $_POST['id'];

		echo json_encode($this->model('Balance_model')->getBalanceByCustId($id));
	}
}