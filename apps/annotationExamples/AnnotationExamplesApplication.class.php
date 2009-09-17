<?php
Library::import('recess.framework.Application');
Library::import('KrisJordan.recess-annotation-examples.RecessAnnotationExamplesPlugin');

class AnnotationExamplesApplication extends Application {
	public function __construct() {
		
		$this->name = 'Recess Annotation Examples';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'annotationExamples/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/annotationExamples/public/';
		
		$this->modelsPrefix = 'annotationExamples.models.';
		
		$this->controllersPrefix = 'annotationExamples.controllers.';
		
		$this->routingPrefix = '/';
		
		$this->plugins = array(new RecessAnnotationExamplesPlugin());
		
	}
}
?>