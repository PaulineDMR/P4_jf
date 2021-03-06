<?php $page_title = 'Commentaires'; ?>

<?php ob_start(); ?>

<?php 

?>
	<div id="post-container">
		
		<div id="post">
			<h3><?=  htmlspecialchars($post->getTitle()); ?></h3>
			<p>
				<?php
					$date = $post->getPost_date();
					$date_fr = new DateTime($date);
					echo "Publié le " .$date_fr->format('d-m-Y');
				?>
			</p>	
			<p><?= nl2br(htmlspecialchars_decode($post->getContent())); ?></p>
			
		</div>

		<div>
			<a class="myButton" href="index.php?action=listPosts<?php if (isset($_GET["page"])) : echo "&amp;page=" .$_GET["page"]; endif; ?>">Retour</a>
		</div>

		<div id="add-comment">
			<img src="view/frontend/img/chat.svg" alt="chat icon">
			<h2>Laissez un commentaire</h2>

			<form method="post" action="index.php?action=comment&amp;id=<?= $post->getId(); ?>">
				<label for="pseudo">Votre pseudo : <input class="comment-form" type="pseudo" name="pseudo" id="pseudo" placeholder="monPseudo18" required></label><br>
				<br>
				<label for="comment">Votre commentaire :</label><br>
				<textarea class="comment-form" name="comment" id="comment" required></textarea><br>
				<input type="submit" value="Publier">
			</form>
			
		</div>



		<h2>Commentaires précédents</h2>

	<?php
		foreach ($comments AS $value) {
			if ($value->getWarning() == true) {
				echo " ";
			} else { ?>
				<div id="comment-container">
					<h4>
						<?php
							$date = $value->getComment_date();
							$date_fr = new DateTime($date);
							echo "Le " .$date_fr->format('d-m-Y à H\hi'). " <span>" .htmlspecialchars($value->getAuthor()). "</span> a écrit";
						?>
					</h4>

					<p><?= nl2br(htmlspecialchars($value->getComment())); ?></p>

					<?php if ($value->getModerated() != true) { ?>
						<form method="POST" action="index.php?action=warning&amp;id=<?= $post->getId() ?>&amp;commentId=<?= $value->getId(); ?>">
							<input type="submit" value="Signaler">
						</form>	
					<?php } ?>

				</div>		
			<?php
			} 
		}
		?>

	
	</div>

<?php $page_content = ob_get_clean(); ?>

<?php require('template.php'); ?>
