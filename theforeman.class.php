<?php

class theforeman {

    private $fmurl;
    private $fmusername;
    private $fmpassword;

    public function __construct($url,$username,$password) {

        $this->fmurl = $url;
        $this->fmusername = $username;
        $this->fmpassword = $password;

    }

    public function query($endpoint = "dashboard") {

        $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, "$this->fmusername:$this->fmpassword");
            curl_setopt($ch, CURLOPT_URL,$this->fmurl . "/api/" . $endpoint);

        $output = curl_exec($ch);

        return $output;

    }

    public function hostlist() {

        $totalhosts = $this->query();
        $totalhosts = json_decode($totalhosts,true);
        $totalhosts = $totalhosts['total_hosts'];

        $hosts = "hosts?per_page=" . $totalhosts;
        $hosts = $this->query($hosts);
        $hosts = json_decode($hosts,true);

        foreach ($hosts as $host) {

            $hostnames[] = $host['host']['name'];

        }

        $hostnames = json_encode($hostnames);

        return $hostnames;

    }

    public function delete_host($host) {

        $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, "$this->fmusername:$this->fmpassword");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_URL,$this->fmurl . "/api/hosts/" . $host);

        $output = curl_exec($ch);

        return $output;

    }

}