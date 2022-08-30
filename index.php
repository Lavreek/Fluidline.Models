<?php
function getTitle($type) {
	switch ($type) {
		case 'dwg':
			return "DWG (.dwg)";
			break;

		case 'dxf':
			return "DXF 3d (.dxf)";
			break;

		case 'stp':
			return "STEP AP203 (.stp)";
			break;

		case 'igs':
			return "IGES (.igs)";
			break;	

		case 'm3d':
			return "Компас 3D (.m3d)";
			break;

		case 'sat':
			return "SAT (.sat)";
			break;

		case 'stl':
			return "STL (.stl)";
			break;

		default:
			return "";
			break;
	}
}

$files = array_diff(scandir(__DIR__."/formats/"), array('.', '..'));
$codes = explode("\n", file_get_contents(__DIR__."/codes.csv"));
$replace = array("\t", "\r");

foreach ($codes as $code) {
	if ($code != "") {
		$code = str_replace($replace, "", $code);

		foreach ($files as $file) {
			if (preg_match("/".$code."/", $file)) {
				$ext = (pathinfo(__DIR__."/formats/".$file))['extension'];
				file_put_contents(__DIR__."/result.txt", $code."\t".$file."\t".getTitle($ext)."\n", FILE_APPEND);
			}
		}	
	}
}