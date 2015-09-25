theforeman.class.php
======================

PHP class to interact with the foreman's API, returns all results in JSON.

Currently a work in progress as I convert my functions to the class.

#### Usage:

    <?php
    
    $url = 'foreman.serverhostna.me';
    
    $username = 'apiuser';
    $password = 'changeme';
    
    $foreman = new theforeman($url,$username,$password)

##### query

Query the API with any of the endpoints available. Defaults to dashboard if you don't provide an endpoint.

    $query = $foreman->query('statistics');

##### hostlist

Lists all the hosts.

    $hostlist = $foreman->hostlist();

##### deletehost

Delete a host

    $deletehost = $foreman->delete_host('cancelledhost.serverhostna.me');
