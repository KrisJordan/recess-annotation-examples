<?php
Library::import('recess.lang.Annotation');
Library::import('KrisJordan.recess-annotation-examples.UnsafeProtectionWrapper');

class UnsafeProtectionAnnotation extends Annotation {
	
	public function usage() {
		return '!UnsafeProtection User: [user], Pass: [password], UnauthorizedAction: [action]';		
	}
	
	public function isFor() {
		return Annotation::FOR_CLASS;
	}
	
	protected function validate($class) {
		$this->exactParameterCount(3);
		
		// Keys are strtolower'ed
		$this->acceptedKeys(array('unauthorizedaction','user','pass'));
		$this->acceptsNoKeylessValues();
		
		$this->validOnSubclassesOf($class,'Controller');
	}
	
	protected function expand($class, $reflection, $descriptor) {
		// Our goal here is to wrap an UnsafeProtectionWrapper
		//  around a controller's serve method.
		$username = $this->user;
		$password = $this->pass;
		$unauthorizedAction = $this->unauthorizedaction;
		
		$descriptor->addWrapper('serve',new UnsafeProtectionWrapper($username,$password,$unauthorizedAction));
		// I just realized how unfortunate and inappropriately
		//	the wrapper's name could read. Whoops, sorry folks.
		return $descriptor;
	}
	
}

