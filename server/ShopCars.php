<?php

class ShopCars
{
    private $dbh;
    public function __construct()
    {
        if (!$this->dbh = new \PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD))
        {
            throw new \Exception(' error DB ');
        }/**
        else {
            $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        }
     * */
    }

    /**
     * @param string $sql
     * @param array $data
     * @return array
     * @throws DbException
     */
    private function query(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            throw new DbException('Ошибка запроса к БД');
            die;
        }
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * @throws DbException
     */
    public function allCars()
    {
        $data = $this->query(
           //"SELECT c.id, b.name, c.model FROM cars AS c INNER JOIN brands AS b ON c.id=b.id",
            "SELECT id, brand, model FROM cars ",
            []
        );
        return $data;
    }

    /**
     * @param $id
     * @return bool
     * @throws DbException
     */
    public function idCars($id)
    {
        $data = $this->query(
            "SELECT brand,model, year, engine, color, max_speed FROM cars WHERE id=:id",
            [':id' => $id]
        );
        return $data[0] ?? false;
    }

    // поиск по параметрам (в качестве параметров используется тот же комплекс type что и в предыдущем запросе.
    // Поле «год выпуска» - обязательно),

    public function getSerch($model='')
    {
        $sql = "SELECT * FROM cars WHERE model LIKE ".$model;
        $result = $this->dbh->query($sql);
        $res = $result->fetchAll(\PDO::FETCH_ASSOC);
        var_dump($res);




    }


}