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
        error_log($_SERVER['HTTP_USER_AGENT'] . "; " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "; " . $_SERVER['QUERY_STRING']);

    if ($agent == null && array_key_exists('HTTP_USER_AGENT', $_SERVER))
        $agent = $_SERVER['HTTP_USER_AGENT'];

    if ($agent == null)
        return array();

    $pattern = '#^(?P<product>[^/ ]+)[/ ]+(?P<version>[0-9]+(?:\.[0-9]+)?) +\((?P<buildid>[^;\( ]*) *; (?P<os>[^; ]*); (?P<arch>[^; ]*); BundledLanguages=(?<langs>[^;\)]*)\)#i';

    if (!preg_match($pattern, $agent, $match))
        return array();

    # additionally store language of the user interface
    $match['lang'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

    # check the package format for Linux packages
    # FIXME this should be improved, but serves the purpose for now
    $match['pkgfmt'] = '';
    if (array_key_exists('QUERY_STRING', $_SERVER))
    {
        if ($_SERVER['QUERY_STRING'] == 'pkgfmt=rpm')
            $match['pkgfmt'] = 'rpm';
        else if ($_SERVER['QUERY_STRING'] == 'pkgfmt=deb')
            $match['pkgfmt'] = 'deb';
    }

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
    ##################
    # 3.5.0 versions
    '7362ca8-b5a8e65-af86909-d471f98-61464c4' => 'LO-3.6',  # 3.5.0 Beta1
    '8589e48-760cc4d-f39cf3d-1b2857e-60db978' => 'LO-3.6',  # 3.5.0 Beta2
    'da8462e-760cc4d-f39cf3d-1b2857e-60db978' => 'LO-3.6',  # 3.5.0 Beta2 (MacOSX)
    'e40af8c-10029e3-615e522-88673a2-727f724' => 'LO-3.6',  # 3.5.0 Beta3
    'b6c8ba5-8c0b455-0b5e650-d7f0dd3-b100c87' => 'LO-3.6',  # 3.5.0 RC1
    'e371a95-bf68a13-5a1aa2b-d3c1ae9-b938258' => 'LO-3.6',  # 3.5.0 RC2
    '7e68ba2-a744ebf-1f241b7-c506db1-7d53735' => 'LO-3.6',  # 3.5.0 RC3 / Final

    # 3.5.1 versions
    '45a2874-aa8c38d-dff3b9c-def3dbd-62463c8' => 'LO-3.6',  # 3.5.1 RC1
    'dc9775d-05ecbee-0851ad3-1586698-727bf66' => 'LO-3.6',  # 3.5.1 RC2 / Final

    # 3.5.2 versions
    '1488b14-519dc6f-43021d0-52136ea-8d338cc' => 'LO-3.6',  # 3.5.2 RC1
    '281b639-6baa1d3-ef66a77-d866f25-f36d45f' => 'LO-3.6',  # 3.5.2 RC2 / Final

    # 3.5.3 versions
    '21cb047-d7e6025-9ba54fc-b4a51a8-f42372b' => 'LO-3.6',  # 3.5.3 RC1
    '235ab8a-3802056-4a8fed3-2d66ea8-e241b80' => 'LO-3.6',  # 3.5.3 RC2 / Final

    # 3.5.4 versions
    '7306755-f4f605c-738527d-1cf4bc1-9930dc8' => 'LO-3.6',  # 3.5.4 RC1
    '165a79a-7059095-e13bb37-fef39a4-9503d18' => 'LO-3.6',  # 3.5.4 RC2 / Final

    # 3.5.5 versions
    'c9944f7-48b7ff5-0507789-54a4c8a-8b242a8' => 'LO-3.5',  # 3.5.5 RC1
    '24b32b4-b87ec2e-85c8e98-87a4e20-9a1b8c1' => 'LO-3.5',  # 3.5.5 RC2
    '7122e39-92ed229-498d286-15e43b4-d70da21' => 'LO-3.5',  # 3.5.5 RC3 / Final

    # 3.5.6 versions
    '9cb76c3-dcba98b-297ab39-994e618-0f858f0' => 'LO-3.5',  # 3.5.6 RC1
    'e0fbe70-5879838-a0745b0-0cd1158-638b327' => 'LO-3.5',  # 3.5.6 RC2 / Final

    # 3.5.7 versions
    '3fa2330-e49ffd2-90d118b-705e248-051e21c' => 'LO-3.5',  # 3.5.7 RC1
    # To be uncommented when we abandon 3.5, and redirect everything to 3.6
    #'3215f89-f603614-ab984f2-7348103-1225a5b' => 'LO-3.5',  # 3.5.7 RC2 / Final

    ##################
    # 3.6.0 versions
    '1f1cdd8-e28082e-41df8bf-b153627-a97a84' => 'LO-3.6',  # 3.6.0 Beta1
    'f010139-41cc8cc-da4127d-d2bb4b0-f433b8' => 'LO-3.6',  # 3.6.0 Beta2
    '3e2b862-dd05a58-d67668b-8ec3f67-dfb62d' => 'LO-3.6',  # 3.6.0 Beta3
    '73f9fb6-115b9dc-d7b744e-21dd070-d656a7' => 'LO-3.6',  # 3.6.0 RC1
    '815c576-a5d8898-9df72e7-b4d87fe-96ce64' => 'LO-3.6',  # 3.6.0 RC2
    '61d5034-02759b5-145085a-056ecdd-4e8a3e' => 'LO-3.6',  # 3.6.0 RC3
    '932b512-69e3009-7a10e5c-fc86223-a55908' => 'LO-3.6',  # 3.6.0 RC4 / Final

    # 3.6.1 versions
    '4db6344-f0536b8-bbcdb32-f398e1b-f43716' => 'LO-3.6',  # 3.6.1.1
    'e29a214-2bbed72-0621de6-a97528c-8f066d' => 'LO-3.6',  # 3.6.1.2 / Final

    # 3.6.2 versions
    'ba822cc-88e2710-134b205-7cd8c5c-680b12' => 'LO-3.6',  # 3.6.2.1
    'da8c1e6-fd468f4-454e206-f42a4a9-143cfd' => 'LO-3.6',  # 3.6.2.2 / Final

    # 3.6.3 versions
    'f8fce0b-300fad7-0c1a2b6-334b928-da36a9' => 'LO-3.6',  # 3.6.3.1
    '58f22d5-270d05a-e2abed1-ea17a85-9b5702' => 'LO-3.6',  # 3.6.3.2 / Final

    # 3.6.4 versions
    'a9a0717-273e462-768e6e3-978247f-65e65f' => 'LO-3.6',  # 3.6.4.1
    # To be uncommented when 3.6.5 Final is out
    #'2ef5aff-a6fb0ff-166bdff-cf087ad-0f1389' => 'LO-3.6',  # 3.6.4.3 / Final [3.5.4.2 was skipped]
);

# Descriptions of the target versions
# The entry must point to the newest version
# 'gitid' is the content of program/versionrc:buildid of the newest version
# 'id' is what is going to be shown in the update information dialog
# 'update_src' specifies the target url.  When 'substitute' is set to true,
#   you can use there a string like
#   'http://www.libreoffice.org/download/?type=<type>&amp;lang=<lang>&amp;version=3.5.6'
#   where '<type>' and '<lang>' will be substitued with the right value
#   NOTE: '&' in the URL has to be escaped as &amp;
$update_map = array(
    'LO-3.5' => array('gitid'       => '3215f89-f603614-ab984f2-7348103-1225a5b',
                      'id'          => 'LibreOffice 3.5.7',
                      'version'     => '3.5.7',
                      'update_type' => 'text/html',
                      'update_src'  => 'http://www.libreoffice.org/download/?type=<type>&amp;lang=<lang>&amp;version=3.5.7',
                      'substitute'  => true ),

# To be uncommented when 3.5.7 RC2 is out, to get updates from 3.5.7 RC1
#    'LO-3.5-pre' => array('gitid'       => '',
#                          'id'          => 'LibreOffice 3.5.7 RC2',
#                          'version'     => '3.5.7 RC2',
#                          'update_type' => 'text/html',
#                          'update_src'  => 'http://www.libreoffice.org/download/pre-releases/'),

    'LO-3.6' => array('gitid'       => '2ef5aff-a6fb0ff-166bdff-cf087ad-0f1389',
                      'id'          => 'LibreOffice 3.6.4',
                      'version'     => '3.6.4',
                      'update_type' => 'text/html',
                      'update_src'  => 'http://www.libreoffice.org/download/'),
);

# Print the update xml
function print_update_xml($buildid, $os, $arch, $lang, $pkgfmt) {
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

    # substitute '<lang>' and '<type>' with the right values
    if (array_key_exists('substitute', $new) && $new['substitute'])
    {
        $target_type = '';
        switch ($os) {
            case 'Linux':
                if ($pkgfmt == '')
                    $pkgfmt = 'rpm';

                if ($arch == 'X86_64')
                    $target_type = $pkgfmt . "-x86_64";
                else
                    $target_type = $pkgfmt . "-x86";
                break;
            case 'MacOSX':
                if ($arch == 'PowerPC')
                    $target_type = 'mac-ppc';
                else
                    $target_type = 'mac-x86';
                break;
            case 'Windows':
                $target_type = 'win-x86';
                break;
        }

        $target_lang = strtok($lang, '-');
        if ($target_lang == false ||
            $lang == 'en-US' || $lang == 'ca-XV' || $lang == 'en-GB' || $lang == 'en-ZA' ||
            $lang == 'pa-IN' || $lang == 'pt-BR' || $lang == 'sa-IN' || $lang == 'sw-TZ' ||
            $lang == 'zh-CN' || $lang == 'zh-TW')
        {
            $target_lang = $lang;
        }
        if ($target_lang == '')
            $target_lang = 'en-US';

        $patterns = array();
        $replacementns = array();

        $patterns[0] = '/<type>/';
        $replacements[0] = $target_type;

        $patterns[1] = '/<lang>/';
        $replacements[1] = $target_lang;

        $update_src = preg_replace($patterns, $replacements, $update_src);
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

print_update_xml($info['buildid'], $info['os'], $info['arch'], $info['lang'], $info['pkgfmt']);
