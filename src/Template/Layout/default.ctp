<!doctype html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MusicBox | <?= $this->fetch('title') ?></title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('/dist/css/main.css') ?>
	<?= $this->Html->script('/dist/js/vendor/jquery.min.js'); ?>
	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
</head>
<body>
	<div class="top-bar">
		<div class="top-bar-left">
			<ul class="dropdown menu" data-dropdown-menu>
				<li class="menu-text">MusicBox</li>
				<li>
					<?= $this->Html->link ('Karten', ['controller' => 'cards', 'action' => 'index']); ?>
					<!-- <ul class="menu vertical"> -->
					<!-- 	<li><a href="#">One</a></li> -->
					<!-- 	<li><a href="#">Two</a></li> -->
					<!-- 	<li><a href="#">Three</a></li> -->
					<!-- </ul> -->
				</li>
				<!-- <li><a href="#">Two</a></li> -->
				<!-- <li><a href="#">Three</a></li> -->
			</ul>
		</div>
		<div class="top-bar-right">
			<ul class="menu">
			<li><?= $this->Html->link ('Neue Karte registrieren', [ 'controller' => 'cards', 'action' => 'add']); ?></li>
				<li><input type="search" placeholder="Search"></li>
				<li><button type="button" class="button">Search</button></li>
			</ul>
		</div>
	</div>

    <?= $this->Flash->render() ?>

    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer class="main-footer">
		MusicBox | 2018 hannenz
    </footer>
	<script src="/dist/js/vendor/foundation.min.js"></script>
	<script src="/dist/js/main.min.js"></script>
</body>
</html>
