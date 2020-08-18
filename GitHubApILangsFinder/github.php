<?php
//Testing language analysis from GitHUB API


class GitHubLangChecker
{

    var $token = "596388b278c5df6583efee31631ee903516cd885";
    var $baseURL = "https://api.github.com";
    var $username = "";

    function __construct($username)
    {

        $this->$username = $username;
    }

    function createConn($pathURL)
    {

        header('Content-Type: application/json');
        $ch = curl_init($this->baseURL . $this->token);
        $authorization = "Authorization: Bearer " . $pathURL; // Prepare the authorisation token
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

        echo $this->createConn("users/" . $this->username);

    }

    function getLangs()
    {

        //Get repos of user first
        //https://api.github.com/repos/jbj/avl_tree_set_rs/languages
        echo $this->createConn("users/" . $this->username);
    }
}

$gitHubLangCheck = new GitHubLangChecker($jbj);
$gitHubLangCheck->getRepositories();