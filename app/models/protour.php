<?php

class Protour extends BaseModel {

    public $id, $tournaments, $players;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Protour');
        $query->execute();
        $rows = $query->fetchAll();
        $protour = array();

        foreach ($rows as $row) {
            $protour[] = new Protour(array(
                'id' => $row['id'],
                'tournaments' => $row['tournaments'],
                'players' => $row['players']
            ));
        }

        return $protour;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Protour WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $protour = new Protour(array(
                'id' => $row['id'],
                'tournaments' => $row['tournaments'],
                'players' => $row['players']
            ));

            return $protour;
        }
        return null;
    }

}
