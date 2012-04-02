<?php

# License: MPL 1.1 / GPLv3+ / LGPLv3+
#
# Copyright (C) 2012 Jan Holesovsky <kendy@suse.cz>, SUSE (initial developer)

$debug = false;

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

# Localization of the URLs
$localize_map = array(
    'http://www.libreoffice.org/download/' => array(
        'cs' => 'http://cs.libreoffice.org/stahnout/',
        'da' => 'http://da.libreoffice.org/hent-libreoffice/',
        'de' => 'http://de.libreoffice.org/download/',
        'eo' => 'http://eo.libreoffice.org/elsxuti/',
        'es' => 'http://es.libreoffice.org/descarga/',
        'fi' => 'http://fi.libreoffice.org/lataa/',
        'fr' => 'http://fr.libreoffice.org/telecharger/',
        'ga' => 'http://ga.libreoffice.org/iosluchtu/',
        'gd' => 'http://gd.libreoffice.org/faigh-e/',
        'hu' => 'http://hu.libreoffice.org/letoeltes/',
        'it' => 'http://it.libreoffice.org/download/',
        'ja' => 'http://ja.libreoffice.org/download/',
        'lt' => 'http://lt.libreoffice.org/parsisiuntimas/',
        'nl' => 'http://nl.libreoffice.org/download/',
        'pt' => 'http://pt.libreoffice.org/transferir-e-instalar/',
        'pt-br' => 'http://pt-br.libreoffice.org/baixe-ja-o-libreoffice-em-portugues-do-brasil/',
        'sl' => 'http://sl.libreoffice.org/prenosi/',
        'zh-tw' => 'http://zh-tw.libreoffice.org/download/',
    ),
    'http://www.libreoffice.org/download/pre-releases/' => array(
        'da' => 'http://da.libreoffice.org/hent-libreoffice/test/',
        'de' => 'http://de.libreoffice.org/download/testversionen/',
        'es' => 'http://es.libreoffice.org/descarga/pre-lanzamientos/',
        'fi' => 'http://fi.libreoffice.org/lataa/testiversioita/',
        'fr' => 'http://fr.libreoffice.org/telecharger/pre-versions/',
        'ga' => 'http://ga.libreoffice.org/iosluchtu/reamhleagan/',
        'gd' => 'http://gd.libreoffice.org/faigh-e/deuchainn-lann/',
        'hu' => 'http://hu.libreoffice.org/letoeltes/el-zetes-kiadasok/',
        'it' => 'http://it.libreoffice.org/download/pre-release/',
        'ja' => 'http://ja.libreoffice.org/download/pre-releases/',
        'lt' => 'http://lt.libreoffice.org/parsisiuntimas/testuojamosios-versijos/',
        'nl' => 'http://nl.libreoffice.org/download/pre-releases/',
        'pt' => 'http://pt.libreoffice.org/pre-lancamentos/',
        'pt-br' => 'http://pt-br.libreoffice.org/baixe-ja-o-libreoffice-em-portugues-do-brasil/prelancamento/',
        'sl' => 'http://sl.libreoffice.org/prenosi/prenosi-poskusnih-gradenj/',
        'zh-tw' => 'http://zh-tw.libreoffice.org/download/pre-releases/',
    )
);

# Map the id's of the versions we want to update to the target version
# Every released version has to be added here (all betas, RC's and final
# versions) as soon as they are out
$update_versions = array(
    # 3.5.0 versions
    '7362ca8-b5a8e65-af86909-d471f98-61464c4' => 'LO-3.5',  # 3.5.0 Beta1
    '8589e48-760cc4d-f39cf3d-1b2857e-60db978' => 'LO-3.5',  # 3.5.0 Beta2
    'da8462e-760cc4d-f39cf3d-1b2857e-60db978' => 'LO-3.5',  # 3.5.0 Beta2 (MacOSX)
    'e40af8c-10029e3-615e522-88673a2-727f724' => 'LO-3.5',  # 3.5.0 Beta3
    'b6c8ba5-8c0b455-0b5e650-d7f0dd3-b100c87' => 'LO-3.5',  # 3.5.0 RC1
    'e371a95-bf68a13-5a1aa2b-d3c1ae9-b938258' => 'LO-3.5',  # 3.5.0 RC2
    '7e68ba2-a744ebf-1f241b7-c506db1-7d53735' => 'LO-3.5',  # 3.5.0 RC3 / Final

    # 3.5.1 versions
    '45a2874-aa8c38d-dff3b9c-def3dbd-62463c8' => 'LO-3.5',  # 3.5.1 RC1
    # To be uncommented when 3.5.2 Final is out
    #'dc9775d-05ecbee-0851ad3-1586698-727bf66' => 'LO-3.5',  # 3.5.1 RC2 / Final

    # 3.5.2 versions
    # "-pre" to be deleted when 3.5.2 Final is out
    '1488b14-519dc6f-43021d0-52136ea-8d338cc' => 'LO-3.5-pre',  # 3.5.2 RC1
    # To be uncommented when 3.5.3 Final is out
    #'281b639-6baa1d3-ef66a77-d866f25-f36d45f' => 'LO-3.5',  # 3.5.2 RC2 / Final
);

# Descriptions of the target versions
# The entry must point to the newest version
# 'gitid' is the content of program/versionrc:buildid of the newest version
# 'id' is what is going to be shown in the update information dialog
$update_map = array(
    'LO-3.5' => array('gitid'       => 'dc9775d-05ecbee-0851ad3-1586698-727bf66',
                      'id'          => 'LibreOffice 3.5.1',
                      'version'     => '3.5.1',
                      'update_type' => 'text/html',
                      'update_src'  => 'http://www.libreoffice.org/download/'),

# To be removed when 3.5.2 RC2 becomes Final
    'LO-3.5-pre' => array('gitid'       => '281b639-6baa1d3-ef66a77-d866f25-f36d45f',
                          'id'          => 'LibreOffice 3.5.2 RC2',
                          'version'     => '3.5.2 RC2',
                          'update_type' => 'text/html',
                          'update_src'  => 'http://www.libreoffice.org/download/pre-releases/'),

# To be uncommented when 3.5.3 RC2 is out, to get updates from 3.5.3 RC1
#    'LO-3.5-pre' => array('gitid'       => '',
#                          'id'          => 'LibreOffice 3.5.3 RC2',
#                          'version'     => '3.5.3 RC2',
#                          'update_type' => 'text/html',
#                          'update_src'  => 'http://www.libreoffice.org/download/pre-releases/'),
);

# Print the update xml
function print_update_xml($buildid, $os, $arch, $lang) {
    global $update_versions, $update_map, $localize_map, $debug;

    if (!array_key_exists($buildid, $update_versions))
        error('No update for your LibreOffice version.');

    $target_version = $update_versions[$buildid];

    if (!array_key_exists($target_version, $update_map))
        error('Internal error of the update service.');

    $new = $update_map[$target_version];

    # try to localize
    $update_src = $new['update_src'];
    if (array_key_exists($update_src, $localize_map))
    {
        $lang = strtolower($lang);
        $src_array = $localize_map[$update_src];

        if (array_key_exists($lang, $src_array))
            $update_src = $src_array[$lang];
        else
        {
            $lang_only = strtok($lang, '-');
            if ($lang_only != false && array_key_exists($lang_only, $src_array))
                $update_src = $src_array[$lang_only];
        }
    }

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
  <inst:update type="' . $new['update_type'] . '" src="' . $update_src . '" />
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
