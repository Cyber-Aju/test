<?php
function getProjects()
{
    $redmine = service('redmine');
    $client = $redmine->getClient(session('redmine_api_key'));
    $users = $client->getApi('issue')->all();
    // $users = $client->getApi('project')->show('5');
    // (['limit' => 50, 'offset' => 50]);
    print_r($users);
    // $projects = [
    //     'cms', 'cbt', 'b2b'
    // ];
    return json_encode($users);
}

function commitStatus()
{
    // Jenkin response curl 
    // $groupedData;
    $jenkinResponsePath = APPPATH . 'views/releaseManagement/jenkinResponse.json';
    if (file_exists($jenkinResponsePath)) {
?>