<?php
//Testing language analysis from GitHUB API
require_once 'token.php';

class GitHubLangChecker

{

    var $baseURL = "https://api.github.com/";
    var $username;
    var $token;

    function __construct($username, $token)
    {

        $this->username = $username;
        $this->token = $token;
    }

    function createConn($pathURL)
    {

        //header('Content-Type: application/json');
        $url = $this->baseURL . $pathURL;
        $ch = curl_init($url);
        $authorization = "Authorization: Bearer " . $this->token; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        $config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
        curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRepositories()
    {

        return $this->createConn("users/" . $this->username . "/repos");
    }

    function getLangs()
    {

        //Get repos of user first
        //https://api.github.com/repos/jbj/avl_tree_set_rs/languages
        $array = json_decode($this->getRepositories(), true);
        var_dump($array);
        
    }
}

$gitHubLangCheck = new GitHubLangChecker("jbj", $token);
$gitHubLangCheck->getLangs();
