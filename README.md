# blockchain-develpment-encryption-method
This is a Encryption and Decryption method in PHP using OPENSSL

Welcome to the Blockchain Develpment Encryption Method wiki!


Initializing the class and functions
```Php
class CryptoGen{ 
```
Generating Private and Public Key Pairs
```Php
	public static function genKey(){
		$res = openssl_pkey_new([
			"private_key_bits" => 2048,
			"private_key_type" => OPENSSL_KEYTYPE_RSA,
		]);
```
Exporting the Key Pairs
```Php
		openssl_pkey_export($res,$privatekey);
		return [$privatekey, openssl_pkey_get_details($res)['key']];
	}
```
Encryption function
```Php
	public static function getEncrypt($messge, $privateKey){
		openssl_private_encrypt($messge, $encrypted, $privateKey);
		return base64_encode($encrypted);
	}
```
	
Decryption function
```Php
	public static function getDecrypt($encrypted, $publickey){
		openssl_public_decrypt(base64_decode($encrypted), $decrypted, $publickey);
		return $decrypted;
	}
```
	
You can validate you encrypted data before decrytion return bool(true) / bool(false)
```Php
	public static function isValid($message,$encrypted, $publicKey){
		return $message == self::getDecrypt($encrypted,$publicKey);
	}
}
```

In action

```Php
[$privateKey, $publickey] = CryptoGen::genKey();

$message = "Hellow! World.";
$encrypted_message = CryptoGen::getEncrypt($message,$privateKey);
echo $encrypted_message."<br/>";

echo CryptoGen::getDecrypt($encrypted_message, $publickey)."<br/>";

var_dump(CryptoGen::isValid($message,$encrypted_message,$publickey));
```

