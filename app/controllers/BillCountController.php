<?php

namespace app\controllers;

use app\services\ProductService;

use app\services\BillService;

class BillCountController extends Controller
{
	public $billService;

	public function __construct($route)
	{
		$this->billService = new BillService();
		parent::__construct($route);
	}

	public function indexAction()
	{
		$id = $this->route['id'];

		$billCount = $this->billService->getBillCount($id);
		$billNumber = $billCount[0]->number;

		$this->setMeta('Bill number: ' . $billNumber);

		$this->set(compact('billCount', 'billNumber'));
	}

	public function createAction()
	{
		$this->view = '_form';
	}

	public function storeAction()
	{
		$id = $this->route['id'];
		$data = $_POST;

		$this->billService->createBillCount($id, $data['sum'], $data['quantity'], $data['name']);

		$this->redirectTo('Successfully saved!', '/bill_count/index/' . $id);
	}

	public function deleteAction()
	{
		$id = $this->route['id'];

		$this->billService->removeBillCount($id);

		$this->redirectBack('Successfully removed!');
	}

	public function sumAction()
	{
		$id = $this->route['id'];
		
		$billCountSum = $this->billService->getBillCountSum($id);
		$bill = $this->billService->getBillById($id);
		$billSum['sum'] = $billCountSum->sum - ($bill->discount * $billCountSum->sum) / 100;

		$this->layout = false;
		$this->view = false;

		echo json_encode($billSum);
	}

}