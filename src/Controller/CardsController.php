<?php
namespace App\Controller;

use \Cake\Filesystem\Folder;
use \Cake\Filesystem\File;
use \Cake\Event\Event;

class CardsController extends AppController {

	public function beforeFilter(Event $event) {

		parent::beforeFilter($event);

		if ($_SERVER['SERVER_NAME'] == 'musicbox.localhost') {
			$this->musicPath = '/home/hannenz/Nextcloud/Johannes';
			if (!is_dir($this->musicPath)) {
				$this->musicPath = '/Users/johannesbraun/Music/Local/';
			}
		}
		else {
			$this->musicPath = '/home/pi/Music';
		}

		$folder = new Folder($this->musicPath);
		$tree = $folder->tree();
		$folders = $tree[0];
		$files = $tree[1];
		array_shift ($folders);

		foreach ($folders as &$folder) {
			$folder = str_replace($this->musicPath, '', $folder);
		}
		foreach ($files as &$file) {
			$file = str_replace($this->musicPath, '', $file);
		}

		$this->set(compact(['folders', 'files']));

	}



	public function index () {
		$this->loadComponent ('Paginator');
		$cards = $this->Paginator->paginate ($this->Cards->find());
		$this->set (compact ('cards'));
		// $this->render ('index_table');
	}



	public function add () {

		$card = $this->Cards->newEntity ();
		if ($this->request->is ('post')) {
			$card = $this->Cards->patchEntity ($card, $this->request->getData ());

			if ($this->Cards->save ($card)) {

				$this->Flash->success (sprintf("Card has been saved, id is %s", $card->id));

				return $this->setAction ('write', $card);


				return $this->redirect (['action' => 'index']);
			}
			$this->Flash->error (__("Failed to save card"));
		}
		$this->set ('card', $card);
	}




	public function edit ($id) {

		$card = $this->Cards->findById ($id)->firstOrFail ();
		if ($this->request->is (['post', 'put'])) {
			$this->Cards->patchEntity ($card, $this->request->getData ());
			if ($this->Cards->save ($card)) {
				$this->Flash->success (__("Card has been saved"));
				return $this->setAction ('write', $card);
				// exec (sprintf ("sudo /usr/bin/python /home/pi/MFRC522-python/Write.py %u && /usr/bin/aplay /home/pi/success.wav &", $card->id));
				// return $this->redirect (['action' => 'index']);
			}
			$this->Flash->error (__("Failed to save card"));
		}
		$this->set ('card', $card);
	}



	/**
	 * Renders the info page telling the user to hold the card to the box
	 * Then calls action doWrite via AJAX
	 */
	public function write ($card) {

		$this->set ('card', $card);
	}



	/**
	 * Actually writes data to the card
	 */
	public function doWrite ($id) {


		// Stop the RFID Reader so that we can write
		exec ("sudo service rfid_reader stop");

		// Write
		$cmd = sprintf ("sudo /usr/bin/python /home/pi/MFRC522-python/Write.py %u", $id);
		exec ($cmd, $out, $ret);

		// Restart RFID Reader
		exec ("sudo service rfid_reader start");

		die (json_encode([
			'ret' => $ret,
			'out' => $out
		]));

		/**
		 * TODO: 
		 * lTL;DR: Implement proper error handling!
		 *
		 * Should implement a timeout in writer script, then check if that
		 * timer has timed out, then issuing an error message. 
		 * Other errors could occur, too... 
		 */
		$this->Flash->success ('Karte wurde erfolgreich beschrieben');
		$this->redirect (['action' => 'index']);
	}



	public function delete ($id) {
		$this->request->allowMethod (['post', 'delete']);
		$card = $this->Cards->findById ($id)->firstOrFail ();
		if ($this->Cards->delete ($card)) {
			$this->Flash->success (__("Card has been deleted"));
			return $this->redirect (['action' => 'index']);
		}
	}



	public function play ($id) {
		$card = $this->Cards->findById ($id)->firstOrFail ();
		if (preg_match('/^action\:\/\/(.*)/', $card->uri, $matches)) {
			$this->doAction ($matches[1]);
		}
		else {
			exec ("/usr/bin/mpc stop");
			exec ("/usr/bin/mpc clear");
			$cmd = sprintf ("/usr/bin/mpc add '%s'", $card->uri);
			exec ($cmd);
			exec ("/usr/bin/mpc play");
		}
		die ("done.");

		//$this->set (compact ('card'));
	}

	protected function doAction ($action) {
		switch ($action) {
		case 'stop':
			exec ("/usr/bin/mpc stop");
			break;

		case 'volume-up':
			exec ("/usr/bin/mpc volume +10");
			break;

		case 'volume-down':
			exec ("/usr/bin/mpc volume -10");
			break;

		case 'mute':
			exec ("/usr/bin/mpc volume 0");
			break;

		case 'next':
			exec ("/usr/bin/mpc next");
			break;

		case 'prev':
			exec ("/usr/bin/mpc previous");
			break;

		case 'toggle':
			exec ("/usr/bin/mpc toggle");
			break;
		}
	}

	public function act ($hash) {
		/*
		 * If hash exists:
		 *      get Location
		 *      act upon (e.g. play folder, volume up...
		 * else
		 *      create new card
		 *      create new location
		 k
		 */
	}
}
