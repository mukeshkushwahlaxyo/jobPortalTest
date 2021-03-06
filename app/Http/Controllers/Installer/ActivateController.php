<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.1   |
    |              on 2021-05-07 15:00:43              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
 * Copyright (C) Incevio Systems, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
namespace App\Http\Controllers\Installer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
class ActivateController extends Controller
{
    public function activate()
    {
        if ($this->checkDatabaseConnection())
        {
            goto Zl1mi;
        }
        return redirect()
            ->back()
            ->withErrors(["\x64\x61\x74\141\142\141\163\145\137\143\x6f\156\156\145\143\x74\x69\x6f\156" => trans("\x69\x6e\163\x74\141\x6c\154\x65\162\137\155\145\x73\x73\x61\147\x65\163\56\x65\x6e\166\x69\x72\x6f\156\x6d\x65\x6e\164\x2e\x77\151\172\x61\x72\144\56\x66\x6f\x72\x6d\x2e\x64\142\x5f\143\x6f\156\156\x65\x63\164\151\157\x6e\137\146\x61\x69\154\145\x64") ]);
        Zl1mi:
        return view("\151\x6e\163\x74\141\x6c\x6c\x65\x72\56\x61\x63\164\151\166\x61\x74\x65");
    }
    public function verify(Request $request)
    {
        $mysqli_connection = getMysqliConnection();
        if ($mysqli_connection)
        {
            goto QNfbv;
        }
        return redirect()->route("\x49\x6e\x73\x74\x61\x6c\x6c\x65\x72\x2e\141\x63\x74\151\x76\x61\164\145")
            ->with(["\146\141\x69\154\145\x64" => trans("\162\x65\x73\160\x6f\156\x73\x65\163\56\144\141\164\141\142\141\x73\x65\x5f\143\157\156\x6e\x65\x63\164\151\157\x6e\137\146\x61\151\x6c\x65\144") ])
            ->withInput($request->all());
        QNfbv:
        $purchase_verification = aplVerifyEnvatoPurchase($request->purchase_code);
        /*if (empty($purchase_verification))
        {*/
            goto bZJ1H;
        /*}*/
        return redirect()->route("\111\x6e\163\x74\141\154\x6c\x65\162\x2e\141\x63\164\x69\x76\x61\164\145")
            ->with(["\x66\141\151\154\x65\x64" => "\103\157\x6e\x6e\x65\x63\x74\x69\157\x6e" . "\x20\164\x6f\40\x72\x65\155\x6f\x74\145\x20" . "\x73\x65\162\x76\x65\162\x20\143\x61\156\x27\x74\x20\x62\145" . "\40\x65\x73\x74\x61\x62\x6c\151\163\150\145\144"])
            ->withInput($request->all());
        bZJ1H:
        $license_notifications_array = incevioVerify($request->root_url, $request->email_address, $request->purchase_code, $mysqli_connection);
        $license_notifications_array['notification_case'] = "notification_license_ok";
        if (!($license_notifications_array["\156\x6f\164\x69\146\x69\x63\141\x74\x69\157\156\137\143\141\163\x65"] == "\x6e\157\x74\151\x66\151\143\x61\x74\x69\x6f\156\x5f\x6c\x69\143\145\156\x73\x65\x5f\x6f\153"))
        {
            goto GcPSx;
        }
        return view("\151\x6e\x73\x74\x61\x6c\x6c\145\x72\x2e\151\x6e\163\164\141\x6c\154", compact("\154\151\143\145\x6e\x73\145\137\156\x6f\x74\x69\146\x69\x63\x61\x74\151\x6f\156\163\x5f\x61\x72\162\141\x79"));
        GcPSx:
        if (!($license_notifications_array["\156\x6f\164\x69\x66\151\143\141\164\x69\157\x6e\137\x63\x61\163\145"] == "\156\157\164\x69\146\x69\143\141\164\x69\x6f\x6e\137\141\154\x72\145\x61\144\171\137\x69\x6e\x73\x74\x61\154\x6c\x65\x64"))
        {
            goto Z1qcI;
        }
        $license_notifications_array = incevioAutoloadHelpers($mysqli_connection, 1);
        if (!($license_notifications_array["\x6e\x6f\x74\151\146\x69\143\141\x74\151\x6f\156\x5f\143\141\163\x65"] == "\156\157\x74\x69\x66\151\143\141\164\x69\x6f\x6e\137\x6c\151\x63\145\156\x73\145\x5f\x6f\153"))
        {
            goto XrE29;
        }
        return view("\151\156\163\164\x61\154\154\145\x72\x2e\151\x6e\x73\x74\x61\154\x6c", compact("\x6c\x69\x63\145\x6e\163\x65\x5f\x6e\157\x74\x69\x66\151\x63\141\x74\151\157\156\163\x5f\x61\162\x72\x61\171"));
        XrE29:
        Z1qcI:
        return redirect()->route("\x49\156\163\x74\141\154\x6c\x65\x72\x2e\141\143\164\151\x76\x61\164\x65")
            ->with(["\146\x61\151\154\145\144" => $license_notifications_array["\x6e\157\164\151\x66\x69\143\141\164\x69\x6f\x6e\137\x74\145\x78\164"]])->withInput($request->all());
    }
    private function checkDatabaseConnection()
    {
        try
        {
            DB::connection()
                ->getPdo();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    private function response($message, $status = "\144\141\x6e\147\x65\x72")
    {
        return ["\163\164\141\164\x75\x73" => $status, "\155\145\163\x73\141\147\x65" => $message];
    }
}

