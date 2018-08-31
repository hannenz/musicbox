<h1>Karte bearbeiten</h1>
<?php
    echo $this->Form->create($card);
    echo $this->Form->control('name', ['autofocus' => true]);
?>
<div class="input-group">
	<span class="input-group-label">URI</span>
	<?php echo $this->Form->control ('uri', ['label' => false, 'class' => 'input-group-field']); ?>

	<div class="input-group-button"><button class="button" data-open="browser" type="button">Browse</button></div>
</div>
<?php
	if ($this->Form->isFieldError ('uri')) {
		echo $this->Form->error ('uri', 'Eine URI muss angegeben werden');
	}
?>
	<button type="submit" class="button primary">Speichern</button>
<?php
    echo $this->Form->end();
?>
<?php echo $this->Html->link ('Abbrechen', [
	'action' => 'index'
]);
?>


<div class="reveal" id="browser" data-reveal>
	<button class="close-button" data-close>&times;</button>
	<div>
		<select id="files">

			<optgroup label="Verzeichnisse">
				<?php foreach ($folders as $folder): ?>
					<?php $folder = str_replace('/home/pi/Music/', '', $folder); ?>
					<option value="<?= $folder ?>"><?= $folder ?></option>
				<?php endforeach ?>
			</optgroup>

			<optgroup label="Dateien">
				<?php foreach ($files as $file): ?>
					<?php $file = str_replace('/home/pi/Music/', '', $file); ?>
					<option value="<?= $file ?>"><?= $file ?></option>
				<?php endforeach ?>
			</optgroup>

		</select>

		<button onclick="javascript: var f=document.getElementById('files').value; console.log (f); document.querySelector('input[name=uri]').value = f; $('#browser').foundation('close'); ">Auswählen</button>
	</div>
</div>
