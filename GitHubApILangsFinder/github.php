<?php

class GitHubLangChecker
{

    var $token = "596388b278c5df6583efee31631ee903516cd885";
    var $baseURL = "https://api.github.com";


    function __construct($username)
    {


    }


    function createConn(){

        $ch = curl_init($this->baseURL . );
        $authorization = "Authorization: Bearer " . $token; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));


    }

    function getRepositories(){



    }

    function getLangs(){




    }


    


    
}

function getGitHubUserData($url)
{
    $token = "596388b278c5df6583efee31631ee903516cd885";

    header('Content-Type: application/json');

 

    $config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

    curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//echo getGitHubUserData("");


echo getGitHubUserData("https://api.github.com/repos/jbj/avl_tree_set_rs/languages");
