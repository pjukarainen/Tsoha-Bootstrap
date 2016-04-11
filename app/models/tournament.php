<?php

class Tournament extends BaseModel {

    public $id, $name, $held, $location, $status, $region, $description, $standings;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tournament (name, held, location, status, region, description) VALUES (:name, :held, :location, :status, :region, :description) RETURNING id');
        $query->execute(array('name' => $this->name, 'held' => $this->held, 'location' => $this->location, 'status' => $this->status, 'region' => $this->region, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
//        Kint::trace();
//        Kint::dump($row);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tournament');
        $query->execute();
        $rows = $query->fetchAll();
        $tournaments = array();

        foreach ($rows as $row) {
            $tournaments[] = new Tournament(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'held' => $row['held'],
                'location' => $row['location'],
                'status' => $row['status'],
                'region' => $row['region'],
                'description' => $row['description'],
                'standings' => $row['standings']
            ));
        }

        return $tournaments;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tournament WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $tournament = new Tournament(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'held' => $row['held'],
                'location' => $row['location'],
                'status' => $row['status'],
                'region' => $row['region'],
                'description' => $row['description'],
                'standings' => $row['standings']
            ));

            return $tournament;
        }
        return null;
    }

    public static function topEight($id) {
        $query = DB::connection()->prepare('SELECT standings FROM Tournament WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $topEight = new Tournament(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'held' => $row['held'],
                'location' => $row['location'],
                'status' => $row['status'],
                'region' => $row['region'],
                'description' => $row['description'],
                'standings' => $row['standings']
            ));

            return $topEight;
        }
        return null;
    }

}
