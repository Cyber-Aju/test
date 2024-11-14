<?php
function commitStatus()
{
    // Jenkin response curl 
    $jenkinResponsePath = 'Views/releaseManagement/jenkinResponse copy.json';
    if (file_exists($jenkinResponsePath)) {
        $jenkinResponse = file_get_contents($jenkinResponsePath);
        // $data = $this->groupByCommits($jenkinResponse);
        $jenkinResponseArray = json_decode($jenkinResponse, true);

        //     filenames and no of files on grouped commit ids
        foreach ($jenkinResponseArray as $key => $value) {
            // echo ;
            // $fileBasedBranches[$value]['branch_name'] = [$jenkinResponseArray[$key]['branch_name'] => [$jenkinResponseArray[$key]['file_name']]];
            $branchName = $jenkinResponseArray[$key]['branch_name'];

            // Add the file name to the appropriate branch
            $fileBasedBranches[$branchName][] = $value['file_name'];
        }
        foreach ($fileBasedBranches as $branchName => $files) {
            $fileBasedBranches[$branchName] = array_unique($files);
        }

        $branchFiles = [];
        $allFiles = []; // To store unique files across all branches

        foreach ($jenkinResponseArray as $commit) {
            $branch = $commit['branch_name'];
            $fileName = $commit['file_name'];

            // Initialize branch array if not already done
            if (!isset($branchFiles[$branch])) {
                $branchFiles[$branch] = [];
            }

            // Add unique files to each branch
            $branchFiles[$branch] = array_unique(array_merge($branchFiles[$branch], [$fileName]));

            // Add file to overall unique file list
            if (!in_array($fileName, $allFiles)) {
                $allFiles[] = $fileName;
            }
        }

        // print_r($branchFiles); // Branch-specific files
        // print_r($allFiles);     // Overall unique files across all branches
        // die;


        // echo "<pre>";
        // print_r($stat);
        // echo count($grouped_data['upto_dev']);
        // print_r($newGroupdata);
        // print_r($jenkinResponseArray);
        // die;
    }



    // else {
    //     echo json_encode(['error' => 'JSON not found']);
    // }
    $data = null;
    $data_1 = null;
    //server : C:\xampp\htdocs\Git-check\server\server\server
    // return $this->template_view('releaseManagement/commitStatus', [$data, $data_1, $fileBasedBranches], 'Track File Status', ['Home' => ASSERT_PATH . 'dashboard/dashboardView', 'File Tracking' => ASSERT_PATH . 'commitstatus']);
}
?>