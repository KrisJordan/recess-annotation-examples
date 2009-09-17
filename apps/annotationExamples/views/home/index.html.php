<?php 
Library::import('annotationExamples.models.Post');

$post = new Post();
$post->title = "Hmm! What to say with annotations? *&^%$&&";
echo $post->titleSlugged();

?>