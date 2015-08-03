<?php

#
# This file is part of the LibreOffice project.
#
# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at http://mozilla.org/MPL/2.0/.
#

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

    $pattern = '#^(?P<product>[^/ ]+)[/ ]+(?P<version>[0-9]+(?:\.[0-9]+)?)[^\(]+\((?P<buildid>[^;\( ]*) *; (?P<os>[^; ]*); (?P<arch>[^; ]*); BundledLanguages=(?<langs>[^;\)]*)\)#i';

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

# Map the build id's into a large integer
# Every released version has to be added here (all betas, RC's and final
# versions) as soon as they are out
$build_hash_to_version = array(
    ##################
    # 3.5.0 versions
    '7362ca8-b5a8e65-af86909-d471f98-61464c4' => '3.5.0.0.b1', # 3.5.0 Beta1
    '8589e48-760cc4d-f39cf3d-1b2857e-60db978' => '3.5.0.0.b2', # 3.5.0 Beta2
    'da8462e-760cc4d-f39cf3d-1b2857e-60db978' => '3.5.0.0.b2', # 3.5.0 Beta2 (MacOSX)
    'e40af8c-10029e3-615e522-88673a2-727f724' => '3.5.0.0.b3', # 3.5.0 Beta3
    'b6c8ba5-8c0b455-0b5e650-d7f0dd3-b100c87' => '3.5.0.1',    # 3.5.0 RC1
    'e371a95-bf68a13-5a1aa2b-d3c1ae9-b938258' => '3.5.0.2',    # 3.5.0 RC2
    '7e68ba2-a744ebf-1f241b7-c506db1-7d53735' => '3.5.0.3',    # 3.5.0 RC3 / Final

    # 3.5.1 versions
    '45a2874-aa8c38d-dff3b9c-def3dbd-62463c8' => '3.5.1.1',  # 3.5.1 RC1
    'dc9775d-05ecbee-0851ad3-1586698-727bf66' => '3.5.1.2',  # 3.5.1 RC2 / Final

    # 3.5.2 versions
    '1488b14-519dc6f-43021d0-52136ea-8d338cc' => '3.5.2.1',  # 3.5.2 RC1
    '281b639-6baa1d3-ef66a77-d866f25-f36d45f' => '3.5.2.2',  # 3.5.2 RC2 / Final

    # 3.5.3 versions
    '21cb047-d7e6025-9ba54fc-b4a51a8-f42372b' => '3.5.3.1',  # 3.5.3 RC1
    '235ab8a-3802056-4a8fed3-2d66ea8-e241b80' => '3.5.3.2',  # 3.5.3 RC2 / Final

    # 3.5.4 versions
    '7306755-f4f605c-738527d-1cf4bc1-9930dc8' => '3.5.4.1',  # 3.5.4 RC1
    '165a79a-7059095-e13bb37-fef39a4-9503d18' => '3.5.4.2',  # 3.5.4 RC2 / Final

    # 3.5.5 versions
    'c9944f7-48b7ff5-0507789-54a4c8a-8b242a8' => '3.5.5.1',  # 3.5.5 RC1
    '24b32b4-b87ec2e-85c8e98-87a4e20-9a1b8c1' => '3.5.5.2',  # 3.5.5 RC2
    '7122e39-92ed229-498d286-15e43b4-d70da21' => '3.5.5.3',  # 3.5.5 RC3 / Final

    # 3.5.6 versions
    '9cb76c3-dcba98b-297ab39-994e618-0f858f0' => '3.5.6.1',  # 3.5.6 RC1
    'e0fbe70-5879838-a0745b0-0cd1158-638b327' => '3.5.6.2',  # 3.5.6 RC2 / Final

    # 3.5.7 versions
    '3fa2330-e49ffd2-90d118b-705e248-051e21c' => '3.5.7.1',  # 3.5.7 RC1
    '3215f89-f603614-ab984f2-7348103-1225a5b' => '3.5.7.2',  # 3.5.7 RC2 / Final

    ##################
    # 3.6.0 versions
    '1f1cdd8-e28082e-41df8bf-b153627-a97a84' => '3.6.0.0.b1', # 3.6.0 Beta1
    'f010139-41cc8cc-da4127d-d2bb4b0-f433b8' => '3.6.0.0.b2', # 3.6.0 Beta2
    '3e2b862-dd05a58-d67668b-8ec3f67-dfb62d' => '3.6.0.0.b3', # 3.6.0 Beta3
    '73f9fb6-115b9dc-d7b744e-21dd070-d656a7' => '3.6.0.1',    # 3.6.0 RC1
    '815c576-a5d8898-9df72e7-b4d87fe-96ce64' => '3.6.0.2',    # 3.6.0 RC2
    '61d5034-02759b5-145085a-056ecdd-4e8a3e' => '3.6.0.3',    # 3.6.0 RC3
    '932b512-69e3009-7a10e5c-fc86223-a55908' => '3.6.0.4',    # 3.6.0 RC4 / Final

    # 3.6.1 versions
    '4db6344-f0536b8-bbcdb32-f398e1b-f43716' => '3.6.1.1',
    'e29a214-2bbed72-0621de6-a97528c-8f066d' => '3.6.1.2',  # Final

    # 3.6.2 versions
    'ba822cc-88e2710-134b205-7cd8c5c-680b12' => '3.6.2.1',
    'da8c1e6-fd468f4-454e206-f42a4a9-143cfd' => '3.6.2.2',  # Final

    # 3.6.3 versions
    'f8fce0b-300fad7-0c1a2b6-334b928-da36a9' => '3.6.3.1',
    '58f22d5-270d05a-e2abed1-ea17a85-9b5702' => '3.6.3.2',  # Final

    # 3.6.4 versions
    'a9a0717-273e462-768e6e3-978247f-65e65f' => '3.6.4.1',
    '2ef5aff-a6fb0ff-166bdff-cf087ad-0f1389' => '3.6.4.3',  # Final [3.6.4.2 was skipped]

    # 3.6.5 versions
    '5b93205-6e6b3fc-7830f6d-c08ad66-1d9bf4' => '3.6.5.2',  # Final [3.6.5.1 was skipped]

    # 3.6.6 versions
    'a61ad19-949f691-349cf55-3bea8d1-2c85eb' => '3.6.6.1',
    'f969faf-c24b504-8c77064-174276e-40b382' => '3.6.6.2', # Final

    # 3.6.7 versions
    '9418c72-a20f997-6f5dfc1-4f5ae61-61563f' => '3.6.7.1',
    'e183d5b-f8ccaf6-3804794-95b4be8-895629' => '3.6.7.2', # Final (last of 3.6 series)

    ##################
    # 4.0.0 versions
    '87906242e87d3ddb2ba9827818f2d1416d80cc7' => '4.0.0.0.b1', # 4.0.0 Beta1
    '4104d660979c57e1160b5135634f732918460a0' => '4.0.0.0.b2', # 4.0.0 Beta2
    '527dba6f6e0cfbbc71bd6e7b88a52699bb48799' => '4.0.0.1', # 4.0.0 RC1
    '408fe71bd18616c467b3dcd7ab6756528ffcae2' => '4.0.0.2', # 4.0.0 RC2
    '5991f37846fc3763493029c4958b57282c2597e' => '4.0.0.2', # 4.0.0 RC2 (Windows)
    '7545bee9c2a0782548772a21bc84a9dcc583b89' => '4.0.0.3', # 4.0.0 RC3 / Final
    '53fd80e80f44edd735c18dbc5b6cde811e0a15c' => '4.0.0.3', # 4.0.0 RC3 / Final (MacOSX)

    # 4.0.1 versions
    '2c0c17a6e4bee0ee28131ea4bdc47edc700d659' => '4.0.1.1',
    '84102822e3d61eb989ddd325abf1ac077904985' => '4.0.1.2', # Final

    # 4.0.2 versions
    '7e5467ff8f30d821f4fbf69cb2769163eb64c2c' => '4.0.2.1',
    '4c82dcdd6efcd48b1d8bba66bfe1989deee49c3' => '4.0.2.2', # Final

    # 4.0.3 versions
    'a67943cd4d125208f4ea7fa29439551825cfb39' => '4.0.3.1',
    'c6786add5a58268e11aa027c47054344040db1b' => '4.0.3.2',
    '0eaa50a932c8f2199a615e1eb30f7ac74279539' => '4.0.3.3', # Final

    # 4.0.4 versions
    '7fdd5ee61c1c7379dd088f5d50265f0adbccf53' => '4.0.4.1',
    '9e9821abd0ffdbc09cd8c52eaa574fa09eb08f2' => '4.0.4.2', # Final

    # 4.0.5 versions
    '5eca95953c59f90dec2cd6ed6dab4b1f4b3b24c' => '4.0.5.1',
    '5464147a081647a250913f19c0715bca595af2f' => '4.0.5.2', # Final

    # 4.0.6 versions
    '7168152d13aa529ba3718c9ae3700216a574137' => '4.0.6.1',
    '2e2573268451a50806fcd60ae2d9fe01dd0ce24' => '4.0.6.2', # Final

    ##################
    # 4.1.0 versions
    '06ebec34fb5a4351b2d356919d5c68a0d4c2e78' => '4.1.0.0.a1', # alpha1 (buildfix2)
    '3a2c2d2417101e45fe07cfd8358acf2204a98f3' => '4.1.0.0.b1', # beta1
    '794cd2a652270bfbe3a35910aa6d57964eac257' => '4.1.0.0.b1', # beta1 (buildfix1, only Windows)
    '33224f4f11a05cfad2249e812fcc2975fbb61f6' => '4.1.0.0.b2', # beta2
    '1b3956717a60d6ac35b133d7b0a0f5eb55e9155' => '4.1.0.1', # rc1 (apparently buildfix applied manually)
    '43286d64e6126b0915ae60d89d3177018fe63b9' => '4.1.0.1', # rc1 (buildfix1)
    'a7d538950185d02a6b950cd1cb2dfd79435f6e2' => '4.1.0.1', # rc1 (buildfix2, only Windows)
    '103a942746cfe346e87daab62acbd4268c38097' => '4.1.0.2',
    '0f08a823567f802c29cbaf2b327db19aaf72016' => '4.1.0.3',
    '719826cd009b9a1fa43e253db0616288c682826' => '4.1.0.3', # (hotfixes1, only Windows)
    '89ea49ddacd9aa532507cbf852f2bb22b1ace28' => '4.1.0.4', # Final

    ##################
    # 4.1.1 versions
    'a990db030b8125868501634ff662be1d89d0868' => '4.1.1.1',
    '7e4286b58adc75a14f6d83f53a03b6c11fa2903' => '4.1.1.2', # (hotfix1)
    # 4.1.2
    'bf15ac65c2167fb1ef3daf3710609d4a4c369a9' => '4.1.2.1',
    '281b75f427729060b6446ddb3777b32f957a8fb' => '4.1.2.2',
    '40b2d7fde7e8d2d7bc5a449dc65df4d08a7dd38' => '4.1.2.3', # unscheduled, Final
    # 4.1.3
    'b42498da0e3f91b17e51b55c8295ec4f8f22087' => '4.1.3.1',
    '70feb7d99726f064edab4605a8ab840c50ec57a' => '4.1.3.2', # Final
    # 4.1.4
    '414ce1317b94ce49e6044b84baf237918e9a659' => '4.1.4.1',
    '0a0440ccc0227ad9829de5f46be37cfb6edcf72' => '4.1.4.2', # Final
    # 4.1.5
    'e0a1805d063a472a7b281ae3977a26d42a48b20' => '4.1.5.1',
    'a02f36998a4af5e2f9fbec2b7e9f70a8b0bc934' => '4.1.5.2',
    '1c1366bba2ba2b554cd2ca4d87c06da81c05d24' => '4.1.5.3', # unscheduled, Final
    # 4.1.6
    'a59ce81388f477fc89db57f0c27f222f31884eb' => '4.1.6.1',
    '40ff705089295be5be0aae9b15123f687c05b0a' => '4.1.6.2', # Final

    ##################
    # 4.2.0 versions
    'c2b9ad37f8a8de9c7dbdd76c86aecf6388107056' => '4.2.0.0.a1', # alpha1
    'f4ca7b35f580827ad2c69ea6d29f7c9b48ebbac7' => '4.2.0.0.b1', # beta1
    '1a27be92e320f97c20d581a69ef1c8b99ea9885d' => '4.2.0.0.b2', # beta2
    '7bf567613a536ded11709b952950c9e8f7181a4a' => '4.2.0.1',
    'cd65d6220c5694ee7012d7863bcde3455c9e3c30' => '4.2.0.2',
    '601a398b803303d1a40a3299729531824fe0db56' => '4.2.0.2', # buildfix1
    'c63c03decdf780d8fb80823950665b782ec9ecd0' => '4.2.0.3',
    '05dceb5d363845f2cf968344d7adab8dcfb2ba71' => '4.2.0.4', # unscheduled, Final
    # 4.2.1
    'd7dbbd7842e6a58b0f521599204e827654e1fb8b' => '4.2.1.1', # rc1, was made final
    # 4.2.2
    '3be8cda0bddd8e430d8cda1ebfd581265cca5a0f' => '4.2.2.1', # rc1, was made final
    # 4.2.3
    '3d4fc3d9dbf8f4c0aeb61498a81f91c5b7922f13' => '4.2.3.1',
    '7c5c769e412afd32da4d946d2cb0c8b0674e95e0' => '4.2.3.2',
    '6c3586f855673fa6a1576797f575b31ac6fa0ba3' => '4.2.3.3',
    '882f8a0a489bc99a9e60c7905a60226254cb6ff0' => '4.2.3.3', # hotfix1, Final
    # 4.2.4
    'd4c441391e20647b3d2e8dde4d20aa868e77e515' => '4.2.4.1',
    '63150712c6d317d27ce2db16eb94c2f3d7b699f8' => '4.2.4.2', # Final
    # 4.2.5
    '881bb88abfe2992c6cede97c23e64a9885de87de' => '4.2.5.1',
    '61cb170a04bb1f12e77c884eab9192be736ec5f5' => '4.2.5.2', # Final
    '6ff819b65674ae6c83f3cbab9e4a4c2b292a7a94' => '4.2.5.2', # hotfix for windows (i.e. only built version for win)
    # 4.2.6
    '5fdddf655fba363e34f755715238d0943a44857e' => '4.2.6.1',
    '185f2ce4dcc34af9bd97dec29e6d42c39557298f' => '4.2.6.2', # Final
    '3fd416d4c6db7d3204c17ce57a1d70f6e531ee21' => '4.2.6.3', # unscheduled, 4.2.6-secfix
    # 4.2.7
    'ad618ebe74a072c4ad8fae3b902f6ff1be98983d' => '4.2.7.1',
    '933c0aa564ec4f8883ed5732c866db48dca4dac5' => '4.2.7.2', # Final
    # 4.2.8 - after-EOL-release
    '4044db1653798618515c987464157abee9229c11' => '4.2.8.1',
    '48d50dbfc06349262c9d50868e5c1f630a573ebd' => '4.2.8.2', # Final

    ##################
    # 4.3.0 versions
    '46cfcd5a05aa1d13fecd73f5a25b64b8d8dd6781' => '4.3.0.0.a1', # alpha1
    '2e39c7e59c8fc8b16a54c3d981dceef27fb0c07f' => '4.3.0.0.b1', # beta1
    'b7cfa1eab1cb1e94f71d6df6612b73f231d0bf92' => '4.3.0.0.b1', # beta1-hotfix1
    '02d957703b758bfbd3aee0d349f65c4273bead78' => '4.3.0.0.b2', # beta2
    'a06aa316117a6ff0f05c697c82831c227812d810' => '4.3.0.0.b1', # beta1-buildfix1
    '67f5430184326974072b65403ef1d9d934fc4481' => '4.3.0.1', # rc1
    '9ed0c4329cf13f882dab0ee8b9ecd7b05e4aafbb' => '4.3.0.1', # rc1-buildfix1
    '14ed55896fdfcb93ff437b85c4f3e1923d2b1409' => '4.3.0.2', # rc2
    'fcd3838c4097f7817b5b3984fd88a44e1edd8548' => '4.3.0.3', # rc3
    '08ebe52789a201dd7d38ef653ef7a48925e7f9f7' => '4.3.0.3', # rc3-buildfix1
    '62ad5818884a2fc2e5780dd45466868d41009ec0' => '4.3.0.4', # Final
    # 4.3.1
    'c4b15cd4d00dec6b266fa830b4ba73e31ae6ce73' => '4.3.1.1',
    '958349dc3b25111dbca392fbc281a05559ef6848' => '4.3.1.2', # Final
    # 4.3.2
    'f9b3ad49d92181b0a1fe7e76f785a2c2cd0847d3' => '4.3.2.1',
    'edfb5295ba211bd31ad47d0bad0118690f76407d' => '4.3.2.2', # Final
    # 4.3.3
    '65dc54c61032b7ebe54405cba6b4fb172b9af7d6' => '4.3.3.1', # initial tag, no builds done
    '7d55112667c8fcddb67bc3803796b46c93aa56b0' => '4.3.3.1', # rc1-buildfix1
    '9bb7eadab57b6755b1265afa86e04bf45fbfc644' => '4.3.3.2', # Final
    # 4.3.4
    'bc356b2f991740509f321d70e4512a6a54c5f243' => '4.3.4.1', # Final (unscheduled additional release)
    # 4.3.5
    '8fd0451cc08e6a5310bed8b7ad1c46b93c1c6889' => '4.3.5.1',
    '3a87456aaa6a95c63eea1c1b3201acedf0751bd5' => '4.3.5.2', # Final
    # 4.3.6
    '9629686a67dd1f357477c13325e45a66f3452bb9' => '4.3.6.1',
    'd50a87b2e514536ed401c18000dad4660b6a169e' => '4.3.6.2', # Final
    # 4.3.7
    'f08731f5dacd79f6348052311f5b237b002d78da' => '4.3.7.1',
    '8a35821d8636a03b8bf4e15b48f59794652c68ba' => '4.3.7.2', # Final

    ##################
    # 4.4.0 versions
    'e73cb2cc40530caa75d588833c4b690e4f49f630' => '4.4.0.0.a1', # alpha1 (calc rendering probs)
    '24f0a5815f581dd9a7f09d30213a379edee6e9ac' => '4.4.0.0.a2', # alpha2
    '9af3d21234aa89dac653c0bd76648188cdeb683e' => '4.4.0.0.b1', # beta1
    'be92f32b8f21603a6b7a75dd645f7475bdee519d' => '4.4.0.0.b2', # beta2
    '1ba9640ddd424f1f535c75bf2b86703770b8cf6f' => '4.4.0.1',
    'a3603970151a6ae2596acd62b70112f4d376b990' => '4.4.0.2',
    'de093506bcdc5fafd9023ee680b8c60e3e0645d7' => '4.4.0.3', # Final
    # 4.4.1
    'b5ac74bf8683a92078a2bc8aff97d4b436af63cb' => '4.4.1.1',
    '45e2de17089c24a1fa810c8f975a7171ba4cd432' => '4.4.1.2', # Final
    # 4.4.2
    '93fc8832889bf050a10ec6d0171dae213adc9b55' => '4.4.2.1',
    'c4e993994148596de57daf68d2e9ff859520e773' => '4.4.2.2', # unreleased
    'c4c7d32d0d49397cad38d62472b0bc8acff48dd6' => '4.4.2.2', # rc2-buildfix2 Final
    # 4.4.3
    'b2f347f2ac68821efc00b6f1793cda90af748118' => '4.4.3.1',
    '88805f81e9fe61362df02b9941de8e38a9b5fd16' => '4.4.3.2', # Final
    # 4.4.4
    '0396d3e8a6d28185695c6422dbdf78aa24ba67d1' => '4.4.4.1',
    '24c5f9979e61fde7b098af60756a4890e5713390' => '4.4.4.1', # buildfix1
    'f784c932ccfd756d01b70b6bb5e09ff62e1b3285' => '4.4.4.2',
    '2c39ebcf046445232b798108aa8a7e7d89552ea8' => '4.4.4.3', # Final
    # 4.4.5
    '1b6df295803ea040dab1b48b5424da8d78d94cf0' => '4.4.5.1',
    'a22f674fd25a3b6f45bdebf25400ed2adff0ff99' => '4.4.5.2', # Final
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
    'stable' => array('gitid'       => '8a35821d8636a03b8bf4e15b48f59794652c68ba',
                      'id'          => 'LibreOffice 4.3.7',
                      'version'     => '4.3.7',
                      'update_type' => 'text/html',
                      'update_src'  => 'http://www.libreoffice.org/download/libreoffice-still/?type=<type>&amp;lang=<lang>&amp;version=4.3.7',
                      'substitute'  => true ),

    'latest' => array('gitid'       => 'a22f674fd25a3b6f45bdebf25400ed2adff0ff99',
                      'id'          => 'LibreOffice 4.4.5',
                      'version'     => '4.4.5',
                      'update_type' => 'text/html',
                      'update_src'  => 'http://www.libreoffice.org/download/libreoffice-fresh/?type=<type>&amp;lang=<lang>&amp;version=4.4.5',
                      'substitute'  => true ),
);

# Print the update xml
function print_update_xml($buildid, $os, $arch, $lang, $pkgfmt) {
    global $build_hash_to_version, $update_map, $localize_map, $debug;

    if(!array_key_exists($buildid, $build_hash_to_version)
       || $buildid == $update_map['stable']['gitid']
       || $buildid == $update_map['latest']['gitid']
       || ($arch == "PowerPC" && $os == "MacOSX")
    ) {
        error('No update for your LibreOffice version.');
    }

    # We upgrade X.Y.Z to X.Y+1.Z for all X iff Z < latest.Z
    # If today we are at: old: 3.5.4, new: 3.6.1
    #     3.4  3.5  3.6
    # .0   N    N    N
    # .1   N    N    *(N)
    # .2   O    O
    # .3   O    O
    # .4   O    O(*)
    # .5   O
    #
    # ie. we have essentially two rectangular regions.

#    print "ver : " . $build_hash_to_version[$buildid] . " - " .
#    	   $update_map['latest']['version'] . "\n";

    $user_ver = explode( '.', $build_hash_to_version[$buildid] );
    $latest_ver = explode( '.', $update_map['latest']['version'] );

    if ($latest_ver[2] >= $user_ver[2]) { # third digit at index 2
	$new = $update_map['latest'];
    } else {
	$new = $update_map['stable'];
    }

    # don't downgrade RC/prerelease users
    if(version_compare($new['version'], substr($build_hash_to_version[$buildid], 0, 5), '<')) {
         error('No update for your LibreOffice version.');
    }

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
                if ($arch == 'X86_64')
                    $target_type = 'mac-x86_64';
                else {
                    $target_type = 'mac-x86';
                    if ($new == $update_map['latest']) {
                        # no 4.4 update for 32bit anymore - see whether there's newer oldstable as fallback
                        $new = $update_map['stable'];
                        if($buildid == $new['gitid']) {
                            error('No 32bit update available - for OS X 10.8 or later, please install 64bit version of LibreOffice.');
                        }
                    }
		}
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

    $gitid = $new['gitid'];
    if (array_key_exists('gitid' . $os, $new))
        $gitid = $new['gitid' . $os];

    # inst:buildid is a legacy thing, and we need to set it in order to
    # update 3.5.0 Beta1 and Beta2 to further versions too
    # We can get rid of it when there is no Beta1 or Beta2 in use out there
    $out = '<?xml version="1.0" encoding="utf-8"?>
<inst:description xmlns:inst="http://update.libreoffice.org/description">
  <inst:id>' . $new['id'] . '</inst:id>
  <inst:gitid>' . $gitid . '</inst:gitid>
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
# to test me paste:
#
# HTTP_USER_AGENT='LibreOffice 3.5 (c9944f7-48b7ff5-0507789-54a4c8a-8b242a8; Windows; x86; BundledLanguages=en-US af ar as ast be bg bn bo br brx bs ca ca-XV cs cy da de dgo dz el en-GB en-ZA eo es et eu fa fi fr ga gd gl gu he hi hr hu id is it ja ka kk km kn ko kok ks ku lb lo lt lv mai mk ml mn mni mr my nb ne nl nn nr nso oc om or pa-IN pl pt pt-BR ro ru rw sa-IN sat sd sh si sk sl sq sr ss st sv sw-TZ ta te tg th tn tr ts tt ug uk uz ve vi xh zh-CN zh-TW zu)' HTTP_ACCEPT_LANGUAGE=cs-CZ php ./check.php
#

$info = get_update_info();

if (!array_key_exists('product', $info) || ($info['product'] != 'LibreOffice' && $info['product'] != 'LibreOfficeDev' && $info['product'] != 'LOdev'))
    error('<b>Error:</b> Only LibreOffice can access the update service.');

print_update_xml($info['buildid'], $info['os'], $info['arch'], $info['lang'], $info['pkgfmt']);
