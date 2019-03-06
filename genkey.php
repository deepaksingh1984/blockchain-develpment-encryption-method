<?php
/*!
 * Generating Key Pairs for Encryption and Decryption
 * Copyright 2011-2015 Deepak Singh
 * Anyone can use this methods for encrypt and decryt data
 * I basically use this for Block Chain Develpment
/* Open Source Software*/

class CryptoGen{ 
	// Generating Private and Public Key Pairs
	public static function genKey(){
		$res = openssl_pkey_new([
			"private_key_bits" => 2048,
			"private_key_type" => OPENSSL_KEYTYPE_RSA,
		]);
		
		openssl_pkey_export($res,$privatekey);
		return [$privatekey, openssl_pkey_get_details($res)['key']];
	}
	
	
	public static function getEncrypt($messge, $privateKey){
		openssl_private_encrypt($messge, $encrypted, $privateKey);
		return base64_encode($encrypted);
	}
	
	public static function getDecrypt($encrypted, $publickey){
		openssl_public_decrypt(base64_decode($encrypted), $decrypted, $publickey);
		return $decrypted;
	}
	
	public static function isValid($message,$encrypted, $publicKey){
		return $message == self::getDecrypt($encrypted,$publicKey);
	}
}

[$privateKey, $publickey] = CryptoGen::genKey();

$message = "Hellow! World.";
$encrypted_message = CryptoGen::getEncrypt($message,$privateKey);
echo $encrypted_message."<br/>";

echo CryptoGen::getDecrypt($encrypted_message, $publickey)."<br/>";

var_dump(CryptoGen::isValid($message,$encrypted_message,$publickey));
?> 
