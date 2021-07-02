<?php

echo 'hello world';

$filename = 'test.csv';

$fp = fopen($filename, 'r+');
fputs($fp, $csvText);
rewind($fp);
$csv = [];
while ( ($data = fgetcsv($fp) ) !== FALSE ) {
    $csv[] = $data;
}

//echo '<pre>'; print_r($csv); echo '</pre>';
$final_array = [];
$i = 0;
foreach($csv as $data){

    $explode_data = explode("_", $data[5]);
    $final_array[] = array(
        'title' => $data[3],
        'url' => $data[4],
        'category' => $explode_data[0]
    );
    //echo '<pre>'; echo $data[3];  echo '</pre>';
    //echo '<pre>'; echo $data[4];  echo '</pre>';
    //echo '<pre>'; echo $data[5];  echo '</pre>';
}
array_shift($final_array);
//echo '<pre>'; print_r($final_array);  echo '</pre>';


/*Downfile File*/
foreach ($final_array as $fa){
    $ftitle = $fa['title'];
    $furl = $fa['url'];
    $fcategory = $fa['category'];
    
    $info = getimagesize($furl);
    $extension = image_type_to_extension($info[2]);

    echo '<pre>'; print_r($fa);  echo '</pre>';
    
    //copy($furl, $fcategory);
    file_put_contents($fcategory.'/'.$ftitle.$extension, file_get_contents($furl));




}








?>