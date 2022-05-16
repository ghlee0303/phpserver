<?php
include "./db.php";

/*class Sample
{
    // member variable
    private $name;
    private $age;

    // constructor
    public function __construct()
    {
        $this->name = "yse";
        $this->age = "10";
    }

    // method
    public function tell()
    {
        echo "my name is {$this->name} .";
        echo " and my age is {$this->age} .";
    }

    // method. return $this
    public function add_age($age)
    {
        $this->age += $age;
        return $this;
    }

    // static method
    public static function factory()
    {
        return new Sample();
    }

    public static function factory2()
    {
        return self::factory();
    }    
}

$sample = new Sample();
$sample->tell();

echo "<br />";
Sample::factory()->add_age(3)->tell();*/

class array_class
{
    // member variable
    private $name;
    private $age;

    // constructor
    public function __construct()
    {
        $this->name = "yse";
        $this->age = "10";
    }

    // method
    public function tell()
    {
        echo "my name is {$this->name} .";
        echo " and my age is {$this->age} .";
    }

    // method. return $this
    public function add_age($age)
    {
        $this->age += $age;
        return $this;
    }

    // static method
    public static function factory()
    {
        return new array_class();
    }

    public static function factory2()
    {
        return self::factory();
    }
}

/*
$sample = new Sample();
$sample->tell();

echo "<br />";
Sample::factory()->add_age(3)->tell();*/

function insert_array($array, $query_row, $query_result) {
    
    while ($query_row != null ) {
        $index = $query_row['type'] + 1;
        if (empty($query_row['complete'])) {
            $array[$index][1] = $array[$index][1] + 1;
            $array[0][1] = $array[0][1] + 1;
        } else {
            $array[$index][0] = $array[$index][0] + 1;
            $array[0][0] = $array[0][0] + 1;
        }

        /*
        $array[$index][0] = $array[$index][0] + 1;
        $array[0][0] = $array[0][0] + 1;*/
        
        $query_row = mysqli_fetch_array($query_result);
    }

    return $array;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_array = 0;

    if($_POST['jud'] == 1) {
        $data_array = array( array(), array(), array(), array());

        //data_array 배열 초기화
        foreach ($data_array as $key => $value) {
            for($index = 0; $index < 2; $index = $index + 1) {
                $data_array[$key][$index] = 0;
            }
        }
        $query_sql = "SELECT * FROM post WHERE maintenance is null AND delete_yn is null";
    } else if ($_POST['jud'] == 2) {

        $data_array = array(array(), array(), array(), array());

        //data_array 배열 초기화
        foreach ($data_array as $key => $value) {
            for ($index = 0; $index < 2; $index = $index + 1) {
                $data_array[$key][$index] = 0;
            }
        }
        $query_sql = "SELECT * FROM post WHERE install_spot_id IN (SELECT id FROM install_spot WHERE quarter(date_format(date, '$_POST[year]-%m-%d')) = $_POST[quarter]) AND delete_yn is null AND maintenance is null";
        // 받은 분기 값, 삭제 되었는지 아닌지, 유지보수 항목인지 쿼리
    }

    $query_result = mysqli_query($mysqli, $query_sql);
    
    if (!($query_result)) {
        echo "data_array 쿼리실패\n";
        echo mysqli_error($mysqli);
        echo "\n";
    }

    $query_row = mysqli_fetch_array($query_result);
    $data_array = insert_array($data_array, $query_row, $query_result);

    echo json_encode($data_array, JSON_UNESCAPED_UNICODE);
}


?>