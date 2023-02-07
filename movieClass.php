<?php
    require_once('includes/database.php');
    class Movie{
        protected $id;
        protected $name;
        protected $producer;
        protected $distYear;
        protected $genre;
        protected $description;
        protected $image;

        //A general Getter function
        public function __get($property){
            if(property_exists($this,$property))
                return $this->$property;
        }

        // Check if the instanation has all the attributes of the class
        private function has_attribute($attribute){
            $object_properties=get_object_vars($this);
            return array_key_exists($attribute,$object_properties);
        }

        // Check if the all the objects in the array has all the attributes of the class
        private function  instantation($preferences_array){
            foreach ($preferences_array as $attribute=>$value){
                    if ($result=$this->has_attribute($attribute))
                        $this->$attribute=$value;
                    }
        }

        //A function that gets all of the rows from the preferences DB
        public static function fetch_movies(){  
            global $database;
            $result=$database->query("select * from movies");
            $actors=null;
            if ($result){
                $i=0;
                if ($result->num_rows>0){ 
                    while($row=$result->fetch_assoc()){ 
                        $movie=new Movie();
                        $movie->instantation($row);
                        $movies[$i]=$movie;
                        $i+=1;
                    }
                }
            }
            return $movies;
        }
        //A function that adds a new preference
        public static function add_preference( $name, $producer, $distYear,  $genre, $description,$image){
        global $database;
        $error=null;
        $sql="Insert into movies(name, producer, distYear, genre, description, image) values ('".$name."','".$producer."',
        '".$distYear."','".$genre."','".$description."','".$image."')";
        $result=$database->query($sql);
        if (!$result){
            $error='Can not add movie Error is:'.$database->get_connection()->error;
        }
        return $error;
    }

    }
?>