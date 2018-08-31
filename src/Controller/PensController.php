<?php
namespace App\Controller;

require_once(APP . '../vendor/mutantlabs/simplempd/MPDWrapper/SimpleMPDWrapper.php');
use \MPDWrapper\SimpleMPDWrapper;


class PensController extends AppController {


	public function index () {
		$mp = new \MPDWrapper\SimpleMPDWrapper("", "hannenz.homelinux.org", 6600, 0);
		$response = $mp->send ("listall");
		$result = [];
		foreach ($response['ret'] as &$item) {
			if (preg_match('/^(.*?)\:\s*(.*)$/', $item, $matches)) {
				$type = $matches[1];
				$name = $matches[2];
				$result[$type][] = $name;
			}
		}
		echo "<pre>";
		print_r($result); die();
	}
}
