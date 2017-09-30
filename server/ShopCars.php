<?php

class ShopCars
{
    private $dbh;
    public function __construct()
    {
        if (!$this->dbh = new \PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD))
        {
            throw new \Exception(' error DB ');
        }
    }

    private function query( $sql,$data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            throw new Exception(NO_CONNECT);
            die;
        }
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            throw new Exception(NO_CONNECT);
            die;
        }
        return true;
    }

    public function allCars()
    {
        $data = $this->query(
            "SELECT id, brand, model FROM cars ",
            []
        );
        $resultJSON = json_encode($data);
        return $resultJSON;
    }

    /**
     * @param $id
     * @return bool
     * @throws DbException
     */
    public function idCars($id)
    {
        $data = $this->query(
            "SELECT brand, model, year, engine, color, max_speed, price FROM cars WHERE id=:id",
            [':id' => $id]
        );
        $resultJSON = json_encode($data[0]);
        return $resultJSON;
    }


    public function getSerch($arrParams)
    {
        $arrParams = json_decode($arrParams, true);

        if(empty($arrParams['year']) )
        {
            throw new Exception(NO_DATE);
        }

        $year = $this->dbh->quote($arrParams['year']);
        $where = $year;
        if (!empty($arrParams['brand']))
        {
            $brand = $this->dbh->quote($arrParams['brand']);
            $where .= " AND brand=".$brand;
        }
        if (!empty($arrParams['model']))
        {
            $model = $this->dbh->quote($arrParams['model']);
            $where .= " AND model=".$model;
        }
        if (!empty($arrParams['engine']))
        {
            $engine = $this->dbh->quote($arrParams['engine']);
            $where .= " AND engine=".$engine;
        }
        if (!empty($arrParams['color']))
        {
            $color = $this->dbh->quote($arrParams['color']);
            $where .= " AND color=".$color;
        }
        if (!empty($arrParams['max_speed']))
        {
            $max_speed = $this->dbh->quote($arrParams['max_speed']);
            $where .= " AND max_speed=".$max_speed;
        }
        if (!empty($arrParams['price']))
        {
            $price = $this->dbh->quote($arrParams['price']);
            $where .= " AND price=".$price;
        }

        $data = $this->query(
            "SELECT brand, model, year, engine, color, max_speed, price FROM cars WHERE year=".$where,
            []
        );
        $resultJSON = json_encode($data);
        return $resultJSON;
    }

    public function getOrders($order)
    {
        if(!empty($order['id_cars'])&& !empty($order['first_name'])
            && !empty($order['second_name']) && !empty($order['payment']))
        {
            $id_cars = $this->dbh->quote($order['id_cars']);
            $first_name = $this->dbh->quote($order['first_name']);
            $second_name = $this->dbh->quote($order['second_name']);
            $payment = $this->dbh->quote($order['payment']);

            $sql = "INSERT INTO orders (id_cars, first_name, second_name, payment)
                VALUES ( $id_cars, $first_name, $second_name, $payment)";
            $this->execute($sql);
        }
             
    }

}













