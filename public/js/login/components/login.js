import React from 'react';
import './../../../css/styles.css';

function Form (props){
	return (
		<div className="d-flex justify-content-center h-100">
			<div className="card">
				<div className="card-header">
					<h3>Sign In</h3>
					<div className="d-flex justify-content-end social_icon">
						<span><i className="fab fa-facebook-square"></i></span>
						<span><i className="fab fa-google-plus-square"></i></span>
						<span><i className="fab fa-twitter-square"></i></span>
					</div>
				</div>
				<div className="card-body">
					<form id="login-form" onKeyUp={props.handleKeyUp}>
						<div className="input-group form-group">
							<div className="input-group-prepend">
								<span className="input-group-text"><i className="fas fa-user"></i></span>
							</div>
							<input type="text" className="form-control" id="txt-email" placeholder="email"/>
							
						</div>
						<div className="input-group form-group">
							<div className="input-group-prepend">
								<span className="input-group-text"><i className="fas fa-key"></i></span>
							</div>
							<input type="password" className="form-control" id="txt-password" placeholder="password"/>
						</div>
						<div className="row align-items-center remember">
							<input type="checkbox" id="cb-remember"/>Remember Me
						</div>
						<div className="form-group">
							<input type="button" value="Login" className="btn float-right login_btn" onClick={props.send}/>
						</div>
					</form>
				</div>
				<div className="card-footer">
					<div className="d-flex justify-content-center links">
						Don't have an account?<a href="#">Sign Up</a>
					</div>
					<div className="d-flex justify-content-center">
						<a href="#">Forgot your password?</a>
					</div>
				</div>
			</div>
		</div>
	)
}

export default Form;
