<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CardsTable extends Table {

    public function initialize (array $config) {
        $this->addbehavior ('Timestamp');
    }

	public function validationDefault (Validator $validator) {
		$validator
			->requirePresence ('uri')
			->notEmpty ('uri');

		return $validator;
	}
}
?>
