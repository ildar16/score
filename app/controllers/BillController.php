<?php

namespace app\controllers;

use app\services\BillService;

class BillController extends Controller
{
	public $billService;

	public function __construct($route)
	{
		$this->billService = new BillService();
		parent::__construct($route);
	}

	public function indexAction()
	{
		$this->setMeta('Bills');

		$orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
		$order    = isset($_GET['sorting'])  ? $_GET['sorting']  : '';

		if (isset($_POST['status']) && isset($_POST['date'])) {
			$bills = $this->billService->getFilteredBills($_POST['status'], $_POST['date']);

			$this->set(compact('bills'));
		} else {
			$allowed = ['id', 'number', 'status', 'data', 'data'];
			$key     = array_search($orderBy, $allowed);
			$orderBy = $allowed[$key];
			$sort   = ($order == 'desc') ? 'desc' : 'asc';
			
			$pagination = $this->billService->pagination(5);
	
			$bills = $this->billService->getBills($orderBy, $sort, $pagination);

			$this->set(compact('bills', 'pagination', 'orderBy'));
		}

		
	}

	public function createAction()
	{
		$this->setMeta('Create bill');

		$this->view = '_form';
	}

	public function storeAction()
	{
		$data = $_POST;

		$this->billService->createBill($data['number'], $data['status'], $data['date'], $data['discount']);

		$this->redirectTo('Successfully saved!', '/bill/index');
	}

	public function editAction()
	{
		$this->setMeta('Create bill');
		$this->view = '_form';

		$id = $this->route['id'];
		$bill = $this->billService->getBillById($id);

		$this->set(compact('bill'));
	}

	public function updateAction()
	{
		$data = $_POST;

		$this->billService->updateBill($this->route['id'], $data['number'], $data['status'], $data['date'], $data['discount']);

		$this->redirectBack('Successfully saved!');
	}

	public function deleteAction()
	{
		$id = $this->route['id'];

		$this->billService->delete($id);

		$this->redirectBack('Successfully removed!');
	}

	public function countAction()
	{
		$id = $this->route['id'];

		$billCount = $this->billService->getBillCount($id);
		$billNumber = $billCount[0]->number;

		$this->setMeta('Bill number: ' . $billNumber);

		$this->set(compact('billCount', 'billNumber'));
	}

}