<?php

class Tournament extends BaseModel {

    public $id, $name, $held, $location, $status, $region, $description, $ends;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_held', 'validate_ends', 'validate_location', 'validate_status', 'validate_region', 'validate_description');
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Name cannot be empty';
        }

        if (strlen($this->name) > 100) {
            $errors[] = 'Name is too long';
        }

        if (strlen($this->name) < 3) {
            $errors[] = 'Name is too short';
        }

        return $errors;
    }

    public function validate_held() {
        $errors = array();
        if ($this->held == '' || $this->held == null) {
            $errors[] = 'Please enter a date when the tournament starts';
        }


        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->held) == false) {
            $errors[] = 'Insert starting date in format "YYYY-MM-DD"';
        }

        return $errors;
    }

    public function validate_ends() {
        $errors = array();
        if ($this->ends == '' || $this->ends == null) {
            $errors[] = 'Please enter a date when the tournament ends';
        }


        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->ends) == false) {
            $errors[] = 'Insert ending date in format "YYYY-MM-DD"';
        }

        return $errors;
    }

    public function validate_location() {
        $errors = array();
        if ($this->location == '' || $this->location == null) {
            $errors[] = 'Please enter a location';
        }

        if (strlen($this->location) > 100) {
            $errors[] = 'Location name too long';
        }

        if (strlen($this->location) < 3) {
            $errors[] = 'Location name too short';
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

        if (strlen($this->description) > 500) {
            $errors[] = 'Description is too long (limit is 500 characters)';
        }

        return $errors;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tournament (name, held, ends, location, status, region, description) VALUES (:name, :held, :ends, :location, :status, :region, :description) RETURNING id');
        $query->execute(array('name' => $this->name, 'held' => $this->held, 'ends' => $this->ends, 'location' => $this->location, 'status' => $this->status, 'region' => $this->region, 'description' => $this->description));

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
                'ends' => $row['ends'],
                'location' => $row['location'],
                'status' => $row['status'],
                'region' => $row['region'],
                'description' => $row['description']
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
                'ends' => $row['ends'],
                'location' => $row['location'],
                'status' => $row['status'],
                'region' => $row['region'],
                'description' => $row['description']
            ));

            return $tournament;
        }
        return null;
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Tournament SET name = :name, held = :held, ends = :ends, location = :location, status = :status, region = :region, description = :description WHERE id = :id');
        $query->execute(array('id' => $id, 'name' => $this->name, 'held' => $this->held, 'ends' => $this->ends, 'location' => $this->location, 'status' => $this->status, 'region' => $this->region, 'description' => $this->description));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Tournament WHERE id = :id');
        $query->execute(array('id' => $id));
    }

}
