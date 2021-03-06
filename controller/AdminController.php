<?php  

require_once("Controller.php");

class AdminController extends Controller {

	public function admin () {
		$adminName = $this->getAdminName();

		$lastPost = $this->getLastPost();
		$lastPostTitle = $lastPost->getTitle();
		$lastPostPubDateFr = new DateTime($lastPost->getPublication_date());

		$lastComment = $this->getLastComment();
		$lastCommentAuthor = $lastComment->getAuthor();
		$LastCommentPubDateFr = new DateTime($lastComment->getComment_date());
		$lastCommentContent = $lastComment->getComment();


		$post = $this->onePost($lastComment->getPost_id());
		$CommentPostTitle = $post->getTitle();

		require("view/backend/adminView.php");
	}

	public function getAdminName() {
		$admins = $this->adminManager->get_admins();

		foreach ($admins as $value) {
			$name = $value->getName();
		}
		return $name;
	}

	public function getLastPost() {
		$post = $this->postManager->get_lastPost();
		return $post;
	}

	public function getLastComment() {
		$comments = $this->commentManager->getComments();
		$comment = $comments[0];
		return $comment;
	}

	public function onePost($postId) {
		$post = $this->postManager->get_post($postId);
		return $post;
	}

}