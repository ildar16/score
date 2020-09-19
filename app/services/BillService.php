<?php

namespace app\services;

use app\models\Bill;

class BillService
{
	public $bill;

    public function __construct()
    {
        $this->bill = new Bill();
    }

	public function getBills($orderBy, $sort, $pagination)
    {
        try {
            return $this->bill->selectAll($orderBy, $sort, $pagination);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function getFilteredBills($status, $date)
    {
        try {
            return $this->bill->filterBill($status, $date);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function getBillsByIds($ids)
    {
        try {
            return $this->bill->selectAllByIds($ids);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function getBillById($id)
    {
        try {
            return $this->bill->selectAllById($id);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function createBill($number, $status, $date, $discount)
    {
        try {
            $this->bill->insert($number, $status, $date, $discount);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function updateBill($id, $number, $status, $date, $discount)
    {
        try {
            $this->bill->update($id, $number, $status, $date, $discount);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function delete($id)
    {
        try {
            $this->bill->delete($id);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function getBillCount($id)
    {
        try {
            return $this->bill->selectBillCount($id);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function createBillCount($id, $sum, $quantity, $name)
    {
        try {
            return $this->bill->insertBillCount($id, $sum, $quantity, $name);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function removeBillCount($id)
    {
        try {
            return $this->bill->deleteBillCount($id);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function getBillCountSum($id)
    {
        try {
            return $this->bill->billCountSum($id);
        } catch (Exception $e) {
            throw $e;
            $this->getErrorLog($e);
        }
    }

    public function pagination($perpage)
    {
        $page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1;
        $pages = $this->bill->countTotalRows();
        $total_pages = ceil($pages->total / $perpage);
        $start = $perpage * $page - $perpage;

        $result = array(
            'page' => $page,
            'total_pages' => $total_pages,
            'start' => $start,
            'perpage' => $perpage,
        );

        return $result;
    }


    public function getErrorLog($e)
    {
        return error_log('[' . date('Y-m-d H:i:s') . '] [ERROR] [' . $_SERVER['REMOTE_ADDR'] . '] ' . $e->getMessage() . "\n", 3, 'error.log');
    }
}