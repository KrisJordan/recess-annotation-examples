<?php
Library::import('recess.lang.Annotation');
Library::import('KrisJordan.recess-annotation-examples.Slugger');

class SlugItAnnotation extends Annotation {
	
	public function usage() {
		return '!SlugIt [slugMethodName]';		
	}
	
	public function isFor() {
		return Annotation::FOR_PROPERTY;
	}
	
	protected function validate($class) {
		$this->exactParameterCount(1);
		$this->acceptsNoKeyedValues();
	}
	
	protected function expand($class, $reflection, $descriptor) {
		// Our goal here is to attach a method of name [slugMethodName]
		//  the first (and only) parameter after the annotation.
		$slugMethodName = $this->values[0];
		$slugger = new Slugger($reflection->name);
		$descriptor->attachMethod($class, $slugMethodName, $slugger, 'slug');
		return $descriptor;
	}
	
}

