<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Card extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false
    ];
}
?>
