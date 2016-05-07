<?php

class Player extends BaseModel {

    public $id, $handle, $name, $sponsor, $country, $characters, $points, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_handle', 'validate_name', 'validate_country', 'validate_characters', 'validate_points', 'validate_description');
    }

    public function validate_handle() {
        $errors = array();
        if ($this->handle == '' || $this->handle == null) {
            $errors[] = 'Handle cannot be empty';
        }

        if (strlen($this->handle) > 100) {
            $errors[] = 'Handle is too long';
        }


        return $errors;
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

    public function validate_country() {
        $errors = array();
        if ($this->country == '' || $this->country == null) {
            $errors[] = 'Please insert a country';
        }

        if (strlen($this->country) > 100) {
            $errors[] = 'Country name is too long';
        }

        return $errors;
    }

    public function validate_characters() {
        $errors = array();
        if ($this->characters == '' || $this->characters == null) {
            $errors[] = 'Please choose a character';
        }

        return $errors;
    }

    public function validate_points() {
        $errors = array();
        if ($this->points < 0 || !is_numeric($this->points)) {
            $errors[] = 'Please insert a number that is 0 or higher';
        }

        if ($this->points > 4999) {
            $errors[] = 'Please insert a number lower than 5000';
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

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Player ORDER BY points DESC');
        $query->execute();
        $rows = $query->fetchAll();
        $players = array();

        foreach ($rows as $row) {
            $players[] = new Player(array(
                'id' => $row['id'],
                'handle' => $row['handle'],
                'name' => $row['name'],
                'sponsor' => $row['sponsor'],
                'country' => $row['country'],
                'characters' => $row['characters'],
                'points' => $row['points'],
                'description' => $row['description']
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
                'points' => $row['points'],
                'description' => $row['description']
            ));

            return $player;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Player (handle, name, sponsor, country, characters, points, description) VALUES (:handle, :name, :sponsor, :country, :characters, :points, :description) RETURNING id');
        $query->execute(array('handle' => $this->handle, 'name' => $this->name, 'sponsor' => $this->sponsor, 'country' => $this->country, 'characters' => $this->characters, 'points' => $this->points, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Player SET handle = :handle, name = :name, sponsor = :sponsor, country = :country, characters = :characters, points = :points, description = :description WHERE id = :id');
        $query->execute(array('id' => $id, 'handle' => $this->handle, 'name' => $this->name, 'sponsor' => $this->sponsor, 'country' => $this->country, 'characters' => $this->characters, 'points' => $this->points, 'description' => $this->description));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Player WHERE id = :id');
        $query->execute(array('id' => $id));
    }

}
