<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<h1>Heading 1</h1>

		<p>Lorem ipsum dolor sit amet, <strong>consectetur</strong> <em>adipiscing elit</em>. <a href="#">Ut eu turpis vel magna sagittis semper eu id massa</a>. Ut quis placerat urna. Donec sed sagittis lacus. Morbi malesuada ante tristique, venenatis tortor vitae, rutrum lectus. Integer bibendum mollis convallis. Proin ut neque id ex molestie pellentesque. Mauris quis velit ut sem fermentum poitor.</p>

		<h1>Heading 1</h1>
		<h2>Heading 2</h2>
		<h3>Heading 3</h3>
		<h4>Heading 4</h4>
		<h5>Heading 5</h5>
		<h6>Heading 6</h6>

		<ul>
			<li>Lorem ipsum dolor sit amet</li>
			<li>Consectetur adipiscing elit
				<ul>
					<li>Lorem ipsum dolor sit amet</li>
					<li>Consectetur adipiscing elit</li>
					<li>Ut eu turpis vel magna sagittis semper eu id massa</li>
				</ul>
			</li>
			<li>Ut eu turpis vel magna sagittis semper eu id massa</li>
		</ul>

		<ol>
			<li>Lorem ipsum dolor sit amet</li>
			<li>Consectetur adipiscing elit
				<ol>
					<li>Lorem ipsum dolor sit amet</li>
					<li>Consectetur adipiscing elit</li>
					<li>Ut eu turpis vel magna sagittis semper eu id massa</li>
				</ol>
			</li>
			<li>Ut eu turpis vel magna sagittis semper eu id massa</li>
		</ol>

		<blockquote>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu turpis vel magna sagittis semper eu id massa. Ut quis placerat urna. Donec sed sagittis lacus. Morbi malesuada ante tristique, venenatis tortor vitae, rutrum lectus. Integer bibendum mollis convallis. Proin ut neque id ex molestie pellentesque. Mauris quis velit ut sem fermentum poitor.
			<cite>Lorem ipsum</cite>
		</blockquote>

		<pre>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu turpis vel magna sagittis semper eu id massa. Ut quis placerat urna. Donec sed sagittis lacus. Morbi malesuada ante tristique, venenatis tortor vitae, rutrum lectus. Integer bibendum mollis convallis. Proin ut neque id ex molestie pellentesque. Mauris quis velit ut sem fermentum poitor.</pre>

	<?php endwhile; ?>
<?php else : ?>

	<h1>404 &mdash; Page not found</h1>
	<p>This page cannot be found.</p>

<?php endif; ?>

<?php get_footer(); ?>
