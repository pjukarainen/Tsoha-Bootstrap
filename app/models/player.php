<?php

class Player extends BaseModel {

    public $id, $handle, $name, $sponsor, $country, $characters, $tournaments, $points, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT handle, name, sponsor, country, characters, points FROM Player');
        $query->execute();
        $rows = $query->fetchAll();
        $players = array();

        foreach ($rows as $row) {
            $players[] = new Player(array(
                'handle' => $row['handle'],
                'name' => $row['name'],
                'sponsor' => $row['sponsor'],
                'country' => $row['country'],
                'characters' => $row['characters'],
                'points' => $row['points']
            ));
        }

        return $players;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $player = new Player(array(
                'id' => $row['id'],
                'handle' => $row['handle'],
                'name' => $row['name'],
                'sponsor' => $row['sponsor'],
                'country' => $row['country'],
                'characters' => $row['characters'],
                'tournaments' => $row['tournaments'],
                'points' => $row['points'],
                'description' => $row['description']
            ));

            return $player;
        }
        return null;
    }

}
