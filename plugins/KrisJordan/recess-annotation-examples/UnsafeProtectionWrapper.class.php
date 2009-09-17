<?php
Library::import('recess.lang.IWrapper');
Library::import('recess.http.responses.ForwardingUnauthorizedResponse');

class UnsafeProtectionWrapper implements IWrapper {
	public $username;
	public $password; 
	public $action;
	
	function __construct($username, $password, $action) {
		$this->username = $username;
		$this->password = $password;
		$this->action = $action;
	}
	
	/**
	 * This is where we'll do our work. before is called before
	 * a controller's serve method. The arguments passed in are what go 
	 * into serve: a Request object.
	 * 
	 * We'll look at the HTTP provided username/password and compare to
	 * our stored username and password. If they match we'll not return anything
	 * and let control pass through. If they don't match we'll return
	 * an UnauthorizedResponse.
	 */
	function before($controller, /* array(Request) */&$args) {
		$request = $args[0];
		
		if( $request->username == $this->username &&
			$request->password == $this->password) {
			// Username and password match, free to pass, return null
			//  and execution will pass thru to Controller's serve method
			return;
		} else {
			if($request->meta->controllerMethod == $this->action) {
				// We don't want to block access to our UnauthorizedAction
				//  else we'll enter a forwarding loop! Let 'em through...
				return;
			} else {
				// By returning a value instead of null controller's serve will not
				//  be called, we will not collect $200, and the forwarding response 
				//  will be sent on directly to be forwarded to our UnauthorizedAction.
				$response = new ForwardingUnauthorizedResponse($request, $controller->urlTo($this->action), "One Unsafe Realm!");
				$response->meta->respondWith = 'Native';
				return $response;
			}
		}
	}
	
	/**
	 * After gets called after serve returns a Response object.
	 * No reason for this annotation to modify the return value
	 * so we'll return it straight up.
	 */
	function after($controller, $returnValue) {
		return $returnValue;
	}
	
	/**
	 * Don't worry yourself with this method, yet,
	 * it's an optimization. Ignore.
	 */
	function combine(IWrapper $wrapper) {
		return false; 
	}
}