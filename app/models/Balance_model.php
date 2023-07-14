<?php

class Balance_model{
	
	private $table = 'balance';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getBalance()
	{
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->resultSet();
	}

	public function getBalanceByCustId($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		return $this->db->single();
	}

	public function addBalance($data)
	{
		$balancedata = $this->getBalance();

		if(count($balancedata) > 0) {
			$amount = $balancedata[0]['amount'] + $data['amount'];
			$query = "UPDATE balance SET amount=:amount WHERE id=:id";
			$this->db->query($query);
			$this->db->bind('amount',$amount);
			$this->db->bind('id',$balancedata[0]['id']);

			$this->db->execute();
		} else {
			$query = "INSERT INTO balance (amount) VALUES(:amount)";
			$this->db->query($query);
			$this->db->bind('amount',$data['amount']);
			//$this->db->bind('customer_id',$data['customer_id']);
			$this->db->execute();
		}
		

		return $this->db->rowCount();
	}

	public function updateBalance($data, $balance)
	{
		$query = "UPDATE balance SET amount=:amount WHERE id=:id";
		$this->db->query($query);
		$this->db->bind('amount',$balance);
		$this->db->bind('id',$data['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function addHistoryBalance($data, $type, $balance){
		if($type == 'withdraw') {
			$query = "INSERT INTO history (credit, type, balance) VALUES(:credit, :type, :balance)";
			$this->db->query($query);
			$this->db->bind('credit',$data['amount']);
			$this->db->bind('type',$type);
			$this->db->bind('balance',$balance);
			$this->db->execute();
		} else {
			$query = "INSERT INTO history (debit, type, balance) VALUES(:debit, :type, :balance)";
			$this->db->query($query);
			$this->db->bind('debit',$data['amount']);
			$this->db->bind('type',$type);
			$this->db->bind('balance',$balance);
			$this->db->execute();
		}
		
		
	}

	public function deleteBalance($id)
	{
		$this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		$this->db->execute();

		return $this->db->rowCount();
	}
}