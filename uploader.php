<?php
    if(!isset($_FILES["uploadfile"])){ //redirects when loading page without mp3
        header("Location: http://jsedlacek.info/~mjl288/songfinder/index.php");
    }
    $path = $_FILES["uploadfile"]['tmp_name'];
    
    $command = "/usr/bin/echoprint-codegen $path 0 30"; //hashes mp3
    //echo "$command <br/>";
    $output = array();
    $return = 0;
    exec($command, $output, $return);
    $obj = json_decode(implode('', $output));
    if(isset($obj[0]->error)){
        echo $obj[0]->error . "<br/>";
        exit;
    }
    print "got the return code $return <br/>\n";
//    print_r($obj);
    
    $codeLink = "http://developer.echonest.com/api/v4/song/identify?api_key=81V20XZGU519ZAVVQ&version=4.12&code="  . $obj[0]->code;
    $result = @file_get_contents($codeLink); //returns false 
    if(!$result){
        echo "echonest is down <br/>";
        exit;
    }
    $obj = json_decode($result);
   // print_r($obj);


    if(!$obj->response->status->message=="Success"){
        echo "echonest is down <br/>";
        exit;
    }else if(count($obj->response->songs)==0){
        echo "song not found <br/>";
        exit;
    }
    //song found
    echo "Song title: " . $obj->response->songs[0]->title . "<br/>";
    echo "Artist Name: " . $obj->response->songs[0]->artist_name . "<br/>";
?>
