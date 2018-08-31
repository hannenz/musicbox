<h2>Registrierte Karten</h2>
<p>Hier werden alle Karten gelistet, die auf der MusicBox registriert sind. Karten(registrierungen) können bearbeitet und gelöscht werden.</p>

<ul class="cards">
	<?php foreach ($cards as $card): ?>
	<li class="card">
		<div class="card-section">

			<div class="card__id"><?php echo $card->id ?></div>
			<div class="card__body">
				<h3 class="card__title"><?php echo $card->name; ?></h3>
				<div class="card__location"><?php echo $card->uri; ?></div>
			</div>

			<?php if (!empty ($card->hash)): ?>
				<div class="card__hash">hash: <?php echo $card->hash; ?></div>
			<?php endif ?>

			<div class="card__action-area">
                <?php echo $this->Form->postLink ('Löschen',
                    ['action' => 'delete', $card->id],
					[
						'confirm' => __("Are you sure?"),
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
			</div>
		</div>
	</li>
	<?php endforeach; ?>
</ul>

