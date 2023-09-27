<?php

// Class
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Validate
if ( isset( $_POST[ 'email' ] ) || array_key_exists( 'email', $_POST ) ) :

	// Message Settings
	$message = array(
		'name'			=> $_POST[ 'name' ],
		'email'			=> $_POST[ 'email' ],
		'country'			=> $_POST[ 'country' ],
		'subject'			=> $_POST[ 'subject' ],
		'message'		=> $_POST[ 'message' ],
		'body'			=> '',
		"alerts"		=> array(
			"error"			=> 'Message could not be sent.',
			"success"		=> 'Thank your. Your message has been sent.',
		),
	);
	
	$message[ 'body' ] .= '<b>Name:</b> ' . $message[ 'name' ];
	$message[ 'body' ] .= '<br><b>Email:</b> ' . $message[ 'email' ];
	$message[ 'body' ] .= '<br><b>Country:</b> ' . $message[ 'country' ];
	$message[ 'body' ] .= '<br><b>Subject:</b> ' . $message[ 'subject' ];
	$message[ 'body' ] .= '<br><br><b>Message:</b><br>' . $message[ 'message' ];
	
	// Include
	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';

	$mail = new PHPMailer( true );

	try {
		// Recipients
		$mail->AddReplyTo( $message[ 'email' ], $message[ 'name' ] );
		$mail->setFrom( 'admin@'. $_SERVER['SERVER_NAME'], $message[ 'name' ] );
		$mail->addAddress( $settings[ 'email' ], $settings[ 'name' ] );
		
		// Content
		$mail->isHTML( true );
		$mail->Subject = $message[ 'subject' ];
		$mail->Body    = $message[ 'body' ];
		
		// Send
		$mail->send();
		
		// Success
		echo '["success", "'. $message[ 'alerts' ][ 'success' ] .'"]';
	} catch ( Exception $e ) {
		// Error
		echo '["error", "'. $message[ 'alerts' ][ 'error' ] .'"]';
	}

endif;

if( isset( $_POST['q_email'] ) || array_key_exists( 'q_email', $_POST ) ) {
	// Message Settings
	$message = array(
		'name'			=> !empty( $_POST[ 'q_name' ] ) ? $_POST[ 'q_name' ] : '',
		'email'			=> !empty( $_POST[ 'q_email' ] ) ? $_POST[ 'q_email' ]  : '',
		'website'		=> !empty( $_POST[ 'q_website' ] ) ? $_POST[ 'q_website' ]: '',
		'message'		=> !empty( $_POST[ 'q_message' ] ) ? $_POST[ 'q_message' ]: '',
		'body'			=> '',
		"alerts"		=> array(
			"error"			=> 'Message could not be sent.',
			"success"		=> 'Thank your. Your message has been sent.',
		),
	);
	



	$message[ 'body' ] .= '<b>Name:</b> ' . ! empty( $message[ 'name' ] ) ? $message[ 'name' ] : '';
	$message[ 'body' ] .= '<br><b>Email:</b> ' . !empty( $message[ 'email' ] ) ? $message[ 'email' ]  : '';
	$message[ 'body' ] .= '<br><b>Website:</b> ' . !empty( $message[ 'website' ] ) ? $message[ 'website' ] : '';
	$message[ 'body' ] .= '<br><br><b>Message:</b><br>' . !empty( $message[ 'message' ] ) ? $message[ 'message' ] : '';

	
	
	// Include
	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';

	$mail = new PHPMailer( true );

	try {
		// Recipients
		$mail->AddReplyTo( $message[ 'email' ], $message[ 'name' ] );
		$mail->setFrom( 'admin@'. $_SERVER['SERVER_NAME'], $message[ 'name' ] );
		$mail->addAddress( $settings[ 'email' ], $settings[ 'name' ] );
		
		// Content
		$mail->isHTML( true );
		$mail->Subject = $message[ 'a_subject' ];
		$mail->Body    = $message[ 'a_body' ];
		
		// Send
		$mail->send();
		
		// Success
		echo '["success", "'. $message[ 'alerts' ][ 'success' ] .'"]';
	} catch ( Exception $e ) {
		// Error
		echo '["error", "'. $message[ 'alerts' ][ 'error' ] .'"]';
	}
}
