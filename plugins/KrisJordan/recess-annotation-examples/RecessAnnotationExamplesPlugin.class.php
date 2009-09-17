<?php
Library::import('recess.framework.Plugin');
Library::import('KrisJordan.recess-annotation-examples.SlugItAnnotation');
Library::import('KrisJordan.recess-annotation-examples.UnsafeProtectionAnnotation');

class RecessAnnotationExamplesPlugin extends Plugin {
	
	function init(Application $app) {
		// We don't need to init anything in this plugin, 
		//   we just need the above imports to have registered the annotation
		//   classes with Library.
	}
	
}