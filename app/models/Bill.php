<?php

namespace app\models;

use PDO;

class Bill extends Model
{
    public function selectAll($orderBy, $sort, $pagination)
    {
        $sql = "SELECT b.id, b.number, b.status, b.date, b.discount, count(bc.bill_id) as bills_count FROM bills b LEFT JOIN bill_composition bc ON b.id = bc.bill_id GROUP BY b.id ORDER BY {$orderBy} {$sort} LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $pagination['perpage'], \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $pagination['start'], \PDO::PARAM_INT);
        $stmt->execute();

        $result = array();

        while ($obj = $stmt->fetch(PDO::FETCH_OBJ)) $result[] = $obj;

        return $result;
    }

    public function filterBill($status, $date)
    {
        $sql = "SELECT b.id, b.number, b.status, b.date, b.discount, count(bc.bill_id) as bills_count FROM bills b LEFT JOIN bill_composition bc ON b.id = bc.bill_id WHERE b.status = :status AND b.date >= :date GROUP BY b.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':date', $date);
        $stmt->execute();

        $result = array();

        while ($obj = $stmt->fetch(PDO::FETCH_OBJ)) $result[] = $obj;

        return $result;
    }

    public function selectAllByIds($ids)
    {
        $sql = "SELECT * FROM bills WHERE FIND_IN_SET(id, :ids)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('ids', $ids);
        $stmt->execute();

        $result = array();

        while ($obj = $stmt->fetch(PDO::FETCH_OBJ)) $result[] = $obj;

        return $result;
    }

    public function selectAllById($id)
    {
        $sql = 'SELECT * FROM bills WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function insert($number, $status, $date, $discount)
    {
        $sql = 'INSERT INTO bills ( number, status, date, discount ) VALUES ( :number, :status, :date, :discount)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':discount', $discount);
        $stmt->execute();
    }

    public function update($id, $number, $status, $date, $discount)
    {
        $sql = 'UPDATE bills SET number = :number, status = :status, date = :date, discount = :discount WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':discount', $discount);
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM bills WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function selectBillCount($id)
    {
        $sql = 'SELECT bc.id, bc.bill_id, bc.sum, bc.quantity, bc.name, b.number FROM bills b left join bill_composition bc ON b.id = bc.bill_id  WHERE b.id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $result = array();

        while ($obj = $stmt->fetch(PDO::FETCH_OBJ)) $result[] = $obj;

        return $result;
    }

    public function insertBillCount($bill_id, $sum, $quantity, $name)
    {
        $sql = 'INSERT INTO bill_composition ( bill_id, sum, quantity, name ) VALUES ( :bill_id, :sum, :quantity, :name)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':bill_id', $bill_id);
        $stmt->bindParam(':sum', $sum);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function deleteBillCount($id)
    {
        $sql = 'DELETE FROM bill_composition WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function billCountSum($bill_id)
    {
        $sql = 'SELECT SUM(bc.sum) as sum FROM bill_composition bc WHERE bill_id = :bill_id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':bill_id', $bill_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function countTotalRows()
    {
        $sql = 'SELECT COUNT(*) AS total FROM bills';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}