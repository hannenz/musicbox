
<h2>Registrierte Karten</h2>
<p>Hier werden alle Karten gelistet, die auf der MusicBox registriert sind. Karten(registrierungen) können bearbeitet und gelöscht werden.</p>

<table class="">
	<?php foreach ($cards as $card): ?>
	<tr class="">
		<td class="card__id"><?php echo $card->id ?></td>
		<td>
			<h4 class="card__title"><?php echo $card->name; ?></h4>
			<div class="card__location"><?php echo $card->uri; ?></div>
		</td>
		<td class="card__action-area">
                <?php echo $this->Form->postLink ('Löschen',
                    ['action' => 'delete', $card->id],
					[
						'confirm' => 'Soll die Karte «'. (!empty ($card->name) ? $card->name : $card->id) . '» wirklich gelöscht werden?',
						'class' => 'link alert'
					]

                );
                ?>
				<?php echo $this->Html->link ('Bearbeiten', [
						'action' => 'edit',
						$card->id
					],
					[
						'class' => 'button small'
					]
				);
				?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

