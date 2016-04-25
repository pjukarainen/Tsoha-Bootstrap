<?php

class Tournament extends BaseModel {

    public $id, $name, $held, $location, $status, $region, $description, $standings;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_held', 'validate_location', 'validate_status', 'validate_region', 'validate_description');
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Name cannot be empty';
        }

        return $errors;
    }

    public function validate_held() {
        $errors = array();
        if ($this->held == '' || $this->held == null) {
            $errors[] = 'Please enter a date';
        }

//        $exampleDate = "2016-08-23";
//        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $exampleDate)) {
//            $errors[] = 'Insert date in format "MM-DD-YYYY - MM-DD-YYYY';
//        }

        return $errors;
    }

    public function validate_location() {
        $errors = array();
        if ($this->location == '' || $this->location == null) {
            $errors[] = 'Please enter a location';
        }

        return $errors;
    }

    public function validate_status() {
        $errors = array();
        if ($this->status == null) {
            $errors[] = 'Please choose a status';
        }

        return $errors;
    }

    public function validate_region() {
        $errors = array();
        if ($this->region == null) {
            $errors[] = 'Please choose a region';
        }

        return $errors;
    }

    public function validate_description() {
        $errors = array();
        if ($this->description == '' || $this->description == null) {
            $errors[] = 'Please write a description';
        }

        return $errors;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tournament (name, held, location, status, region, description) VALUES (:name, :held, :location, :status, :region, :description) RETURNING id');
        $query->execute(array('name' => $this->name, 'held' => $this->held, 'location' => $this->location, 'status' => $this->status, 'region' => $this->region, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
        
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tournament ORDER BY id ASC');
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

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Tournament SET name = :name, held = :held, location = :location, status = :status, region = :region, description = :description WHERE id = :id');
        $query->execute(array('id' => $id, 'name' => $this->name, 'held' => $this->held, 'location' => $this->location, 'status' => $this->status, 'region' => $this->region, 'description' => $this->description));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Tournament WHERE id = :id');
        $query->execute(array('id' => $id));
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
