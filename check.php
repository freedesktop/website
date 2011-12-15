<?php

# When something goes wrong
function error($message) {
    print "<html>
<head><title>LibreOffice Update Service</title></head>
<body>
  <h1>LibreOffice Update Service</h1>
  <p>$message</p>
</body>
</html>\n";
    exit;
}

# Parse the User-Agent: string from the browser
function get_update_info($agent=null) {
    if ($agent == null && array_key_exists('HTTP_USER_AGENT', $_SERVER))
        $agent = $_SERVER['HTTP_USER_AGENT'];

    if ($agent == null)
        return array();

    $pattern = '#^(?P<product>[^/ ]+)[/ ]+(?P<version>[0-9]+(?:\.[0-9]+)?) +\((?P<milestone>[^;\( ]*) *\(build:(?P<buildid>[^;\( ]*)\); (?P<os>[^; ]*); (?P<arch>[^; ]*); BundledLanguages=(?<langs>[^; ]*)\)#i';

    if (!preg_match($pattern, $agent, $match))
        return array();

    return $match;
}

# Map the versions
$update_map = array(
    '340m1' => array('buildid'     => 102,
                     'id'          => 'LibreOffice_3.4',
                     'version'     => '3.4.2',
                     'update_type' => 'text/html',
                     'update_src'  => 'http://www.libreoffice.org/download/')
);

# Print the update xml
function print_update_xml($milestone, $buildid, $os, $arch, $langs) {
    global $update_map;

    $new = $update_map[$milestone];

    if ($new == null)
        error('No update for your LibreOffice version.');

    if ($buildid >= $new['buildid'])
        error('Your LibreOffice is up to date.');

    print '<?xml version="1.0" encoding="utf-8"?>
<inst:description xmlns:inst="http://update.libreoffice.org/description">
  <inst:id>' . $new['id'] . '</inst:id>
  <inst:version>' . $new['version'] . '</inst:version>
  <inst:buildid>' . $new['buildid'] . '</inst:buildid>
  <inst:os>' . $os . '</inst:os>
  <inst:arch>' . $arch . '</inst:arch>
  <inst:update type="' . $new['update_type'] . '" src="' . $new['update_src'] . '" />
</inst:description>
';
}

# Main
#$info = get_update_info("LibreOffice/2.2 (340m1 (Build:100); Solaris; SPARC; BundledLanguages=en-US_fr) Ugh blah/ggg");
$info = get_update_info();

if (!array_key_exists('product', $info) || $info['product'] != 'LibreOffice')
    error('<b>Error:</b> Only LibreOffice can access the update service.');

print_update_xml($info['milestone'], $info['buildid'], $info['os'], $info['arch'], $info['langs']);
