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
 namespace App\Http\Controllers\Installer\Helpers; class PermissionsChecker { protected $results = []; public function __construct() { $this->results["\160\x65\x72\x6d\x69\x73\163\151\x6f\x6e\x73"] = []; $this->results["\x65\x72\162\x6f\x72\x73"] = null; } public function check(array $folders) { foreach ($folders as $folder => $permission) { if (!($this->getPermission($folder) >= $permission)) { goto ZY8NX; } $this->addFile($folder, $permission, true); goto Q3_tg; ZY8NX: $this->addFileAndSetErrors($folder, $permission, false); Q3_tg: LHu3t: } mW0fZ: return $this->results; } private function getPermission($folder) { return substr(sprintf("\45\157", fileperms(base_path($folder))), -4); } private function addFile($folder, $permission, $isSet) { array_push($this->results["\160\145\162\x6d\151\163\163\151\x6f\156\x73"], ["\x66\x6f\154\x64\145\x72" => $folder, "\x70\x65\162\155\x69\x73\x73\x69\157\x6e" => $permission, "\151\x73\x53\x65\x74" => $isSet]); } private function addFileAndSetErrors($folder, $permission, $isSet) { $this->addFile($folder, $permission, $isSet); $this->results["\x65\162\162\157\x72\x73"] = true; } }
