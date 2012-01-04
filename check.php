<?php

$debug = 0;

# When something goes wrong
function error($message) {
    global $debug;

    $out = "<html>
<head><title>LibreOffice Update Service</title></head>
<body>
  <h1>LibreOffice Update Service</h1>
  <p>$message</p>
</body>
</html>\n";

    print $out;
    if ($debug)
        error_log($out);
    exit;
}

# Parse the User-Agent: string from the browser
function get_update_info($agent=null) {
    global $debug;

    if ($debug)
        error_log($_SERVER['HTTP_USER_AGENT'] . "; " . $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    if ($agent == null && array_key_exists('HTTP_USER_AGENT', $_SERVER))
        $agent = $_SERVER['HTTP_USER_AGENT'];

    if ($agent == null)
        return array();

    $pattern = '#^(?P<product>[^/ ]+)[/ ]+(?P<version>[0-9]+(?:\.[0-9]+)?) +\((?P<buildid>[^;\( ]*) *; (?P<os>[^; ]*); (?P<arch>[^; ]*); BundledLanguages=(?<langs>[^;\)]*)\)#i';

    if (!preg_match($pattern, $agent, $match))
        return array();

    # additionally store language of the user interface
    $match['lang'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

    return $match;
}

# Map the id's to the target versions
# Every released version has to be added here (all betas, RC's and final
# versions) as soon as they are out
$update_versions = array(
    '7362ca8-b5a8e65-af86909-d471f98-61464c4' => 'LO-3.5'  # 3.5.0 Beta1
    #'8589e48-760cc4d-f39cf3d-1b2857e-60db978' => 'LO-3.5'  # 3.5.0 Beta2
);

# Descriptions of the target versions
# The entry must point to the newest version
# 'gitid' is the content of program/versionrc:buildid of the newest version
# 'id' is what is going to be shown in the update information dialog
$update_map = array(
    'LO-3.5' => array('gitid'       => '8589e48-760cc4d-f39cf3d-1b2857e-60db978',
                      'id'          => 'LibreOffice 3.5.0 Beta2',
                      'version'     => '3.5.0 Beta2',
                      'update_type' => 'text/html',
                      'update_src'  => 'http://www.libreoffice.org/download/pre-releases/')
);

# Print the update xml
function print_update_xml($buildid, $os, $arch, $lang) {
    global $update_versions, $update_map, $debug;

    if (!array_key_exists($buildid, $update_versions))
        error('No update for your LibreOffice version.');

    $target_version = $update_versions[$buildid];

    if (!array_key_exists($target_version, $update_map))
        error('Internal error of the update service.');

    $new = $update_map[$target_version];

    # inst:buildid is a legacy thing, and we need to set it in order to
    # update 3.5.0 Beta1 and Beta2 to further versions too
    # We can get rid of it when there is no Beta1 or Beta2 in use out there
    $out = '<?xml version="1.0" encoding="utf-8"?>
<inst:description xmlns:inst="http://update.libreoffice.org/description">
  <inst:id>' . $new['id'] . '</inst:id>
  <inst:gitid>' . $new['gitid'] . '</inst:gitid>
  <inst:os>' . $os . '</inst:os>
  <inst:arch>' . $arch . '</inst:arch>
  <inst:version>' . $new['version'] . '</inst:version>
  <inst:buildid>9999</inst:buildid>
  <inst:update type="' . $new['update_type'] . '" src="' . $new['update_src'] . '" />
</inst:description>
';

    print $out;

    if ($debug)
        error_log($out);
}

# Main
#$info = get_update_info("LOdev 3.5 (7362ca8-b5a8e65-af86909-d471f98-61464c4; Windows; x86; BundledLanguages=en-US af ar as ast be bg bn bo br brx bs ca ca-XV cs cy da de dgo dz el en-GB en-ZA eo es et eu fa fi fr ga gd gl gu he hi hr hu id is it ja ka kk km kn ko kok ks ku lb lo lt lv mai mk ml mn mni mr my nb ne nl nn nr nso oc om or pa-IN pl pt pt-BR qtz ro ru rw sa-IN sat sd sh si sk sl sq sr ss st sv sw-TZ ta te tg th tn tr ts tt ug uk uz ve vi xh zh-CN zh-TW zu)");
$info = get_update_info();

if (!array_key_exists('product', $info) || ($info['product'] != 'LibreOffice' && $info['product'] != 'LOdev'))
    error('<b>Error:</b> Only LibreOffice can access the update service.');

print_update_xml($info['buildid'], $info['os'], $info['arch'], $info['lang']);
