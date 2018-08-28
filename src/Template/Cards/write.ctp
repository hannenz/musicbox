<p style="text-align: center">Karte mit ID#<span id="cardID"><?= $card->id; ?></span> kann jetzt geschrieben werden. Halten Sie die Karte jetzt an die Box.</p>

<figure class="write-info" style="text-align: center">
<svg xmlns="http://www.w3.org/2000/svg" height="400" width="400" version="1.1" viewBox="0 0 264.58333 264.58334">
	<g stroke-linejoin="round" transform="translate(0 -32.417)" stroke="#555753" stroke-linecap="round">
		<g style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" stroke-width=".822" fill="#fff">
			<path stroke-linejoin="round" d="M41.983 163.374l86.94-16.797 85.233 2.22-119.029 15.332z" fill-rule="evenodd" stroke-linecap="butt"/>
			<path d="M128.924 47.952v98.598l85.232 2.22V55.775z"/>
			<path d="M41.983 106.608l86.94-58.627v98.598l-86.94 16.797z"/>
		</g>
		<g transform="rotate(3.998 6248.85 -1005.749) scale(4.53283)" fill="none">
			<path style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" d="M59.958 111.67a3.31 3.31 0 0 1 1.655 2.867 3.31 3.31 0 0 1-1.655 2.866" stroke-width=".772"/>
			<path style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" d="M56.648 117.4a3.31 3.31 0 0 1-1.655-2.866 3.31 3.31 0 0 1 1.655-2.867" stroke-width=".772"/>
			<g stroke-width=".772">
				<path style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" d="M60.733 110.32a4.86 4.86 0 0 1 2.43 4.21 4.86 4.86 0 0 1-2.43 4.21"/>
				<path style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" d="M55.872 118.74a4.86 4.86 0 0 1-2.43-4.21 4.86 4.86 0 0 1 2.43-4.21"/>
				<path style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" d="M61.538 108.93a6.47 6.47 0 0 1 3.236 5.604 6.47 6.47 0 0 1-3.236 5.604"/>
				<path style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" d="M55.067 120.14a6.47 6.47 0 0 1-3.235-5.604 6.47 6.47 0 0 1 3.236-5.604"/>
			</g>
			<circle style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" stroke-width="1.058" cy="114.59" cx="58.265" r="1.27"/>
		</g>
		<rect id="card" ry="8.539" stroke-width=".822" fill="#fff" style="color-rendering:auto;color:#000;isolation:auto;mix-blend-mode:normal;paint-order:fill markers stroke;shape-rendering:auto;solid-color:#000;image-rendering:auto" fill-rule="evenodd" rx="8.539" transform="rotate(15)" width="43" height="67" y="77.9" x="182.49">
			<animate
				attributeName="y"
				from="100"
				to="30"
				dur="3s"
				restart="always"
				repeatCount="indefinite"
				calcMode="spline"
				keySplines=".0 .75 .25 1"
				values="100; 30"
			/>
			<animate
				attributeName="x"
				from="140"
				to="180"
				dur="3s"
				restart="always"
				repeatCount="indefinite"
				calcMode="spline"
				keySplines=".0 .75 .25 1"
				values="130; 170"
			/>
		</rect>
	</g>
</svg>
</figure>

<p style="text-align: center"> <?php echo $this->Html->link ('Abbrechen', ['action' => 'index'], ['class' => 'link']); ?> </p>

<script>
$(function() {
	var id = document.getElementById ('cardID').innerText;
	$.get ('/cards/doWrite/' + id, function (resp) {
		var r = JSON.parse (resp);
		if (parseInt(r.ret) == 0) {
			// window.location = '/cards'
			document.getElementById ('card').style.fill = '#00c000';
			window.setTimeout (function () {
				window.location = '/cards';
			}, 1500);

		}
		else {
			alert ("Karte konnte nicht geschrieben werden...");
		}
	});
});
</script>
