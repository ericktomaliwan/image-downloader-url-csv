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
    #get category
    $explode_data = explode("_", $data[5]);

    #Check for empty titles
    $local_title = empty($data[3]) ? 'no_title_'.$explode_data[1] : $data[3];

    #assign to array
    $final_array[] = array(
        'title' =>  $local_title ,
        'url' => $data[4],
        'category' => $explode_data[0]
    );
}
#Remove header
array_shift($final_array);

#Downfile File
foreach ($final_array as $fa){
    #assign to local variable
    $ftitle = $fa['title'];
    $furl = $fa['url'];
    $fcategory = $fa['category'];
    
    #Get file extension
    $info = getimagesize($furl);
    $extension = image_type_to_extension($info[2]);

    #print out all entries
    echo '<pre>'; print_r($fa);  echo '</pre>';
    
    #Assign to a folder
    //copy($furl, $fcategory);
    file_put_contents($fcategory.'/'.$ftitle.$extension, file_get_contents($furl));

}


?>