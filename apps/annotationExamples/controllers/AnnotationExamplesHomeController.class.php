<?php
Library::import('recess.framework.controllers.Controller');
Library::import('annotationExamples.models.Post');

/**
 * !UnsafeProtection User: hello, Pass: annotations, UnauthorizedAction: denied
 * !RespondsWith Layouts
 * !Prefix Views: home/, Routes: /
 */
class AnnotationExamplesHomeController extends Controller {
	
	/** !Route GET */
	function index() {
		$post = new Post();
		
		$post->title = "Hmm! What to say with annotations? *&^%$&&";
		echo "Title: $post->title<br />";
		
		$slugged = $post->titleSlugged();
		echo "Slug: $slugged<br />";
		
		die('Just a demo, no need for a view.');
	}
	
	/** !Route GET, denied */
	function denied() {
		die('The username/password is hello/annotations!');
	}
	
}