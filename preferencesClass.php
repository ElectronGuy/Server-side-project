<?php

require_once('includes/database.php');
class Preference{
    
    protected $location;
    protected $frequency;
    protected $genre;
    protected $language;
    protected $platform;
    protected $companion;
    protected $length;
    protected $format;
    protected $influence;
    protected $status;
    protected $userName;

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
    public static function fetch_preferences(){  
    global $database;
    $result=$database->query("select * from preferences");
    $preferences=null;
    if ($result){
        $i=0;
        if ($result->num_rows>0){ 
            while($row=$result->fetch_assoc()){ 
                $preference=new Preference();
                $preference->instantation($row);
                $preferences[$i]=$preference;
                $i+=1;
            }
        }
    }
    return $preferences;
    }

    public static function findUser($user){
        global $database;
        $result=$database->query("select * from preferences where userName='".$user."'");
        if ($result){
            if ($result->num_rows>0){
                return "found";
            }
            return "notFound";
        }
    }

    public static function findStatusForUser($user){
        global $database;
        $result=$database->query("select * from preferences where userName='".$user."'");
        if ($result){
            if ($result->num_rows>0){
                $row=$result->fetch_assoc();
                $preference=new Preference();
                $preference->instantation($row);
                return $preference->status;
            }
        }
    }

    public static function getPreferencesForUser($user){
        global $database;
        $result=$database->query("select * from preferences where userName='".$user."'");
        if ($result){
            if ($result->num_rows>0){
                $row=$result->fetch_assoc();
                $preference=new Preference();
                $preference->instantation($row);
                return $preference;
            }
        }
    }
    

    //A function that adds a new preference
    public static function add_preference( $location, $frequency, $genre,  $language, $platform, $companion, $length, $format, $influence, $status, $userName){
        global $database;
        $error=null;
        $sql="Insert into preferences(location, frequency, genre, language, platform, companion, length, format, influence, status, userName) values ('".$location."','".$frequency."',
        '".$genre."','".$language."','".$platform."', '".$companion."', '".$length."', '".$format."', '".$influence."', '".$status."', '".$userName."')";
        $result=$database->query($sql);
        if (!$result){
            $error='Can not add preferences  Error is:'.$database->get_connection()->error;
        }
        return $error;
    }

    public static function update_preference($location, $frequency, $genre,  $language, $platform, $companion, $length, $format, $influence, $status, $userName){
        global $database;
        $error=null;
        $sql = "UPDATE preferences SET location='".$location."',frequency='".$frequency."',genre='".$genre."',language='".$language."',platform='".$platform."',companion='".$companion."',length='".$length."',format='".$format."',influence='".$influence."',status='".$status."' WHERE userName='".$userName."'";
        $result=$database->query($sql);
        if (!$result){
            $error='Can not add preferences  Error is:'.$database->get_connection()->error;
        }
        return $error;
    }

    //A function that returns the count of a value of an attribute in the preferences table
    public static function countValuesInAttribute($attribute, $value){
        global $database;
        $status = "done";
        $result=$database->query("select COUNT(*) from preferences where status='".$status."' AND ".$attribute."='".$value."'");
        if ($result){
                $row=$result->fetch_assoc();
                return $row['COUNT(*)'];
            }
        }
    }
?>