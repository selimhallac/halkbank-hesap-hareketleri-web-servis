<?php
class WsseAuthHeader extends SoapHeader
{
    private $wssNs = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
    private $wsuNs = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
    private $passType = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText';
    private $nonceType = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary';


    function __construct($username,$password )
    {
        $created = gmdate('Y-m-d\TH:i:s\Z');
        $nonce = mt_rand();
        $encodedNonce = base64_encode(pack('H*', sha1(pack('H*', $nonce) . pack('a*', $created) . pack('a*', $password))));

        // Creating WSS identification header using SimpleXML
        $root = new SimpleXMLElement('<root/>');

        $security = $root->addChild('wsse:Security', null, $this->wssNs);

        $usernameToken = $security->addChild('wsse:UsernameToken', null, $this->wssNs);
        $usernameToken->addChild('wsse:Username', $username, $this->wssNs);
        $passNode = $usernameToken->addChild('wsse:Password', htmlspecialchars($password, ENT_XML1, 'UTF-8'), $this->wssNs);
        $passNode->addAttribute('Type', $this->passType);

        $nonceNode = $usernameToken->addChild('wsse:Nonce', $encodedNonce, $this->wssNs);
        $nonceNode->addAttribute('EncodingType', $this->nonceType);
        $usernameToken->addChild('wsu:Created', $created, $this->wsuNs);
        // Recovering XML value from that object
        $root->registerXPathNamespace('wsse', $this->wssNs);
        $full = $root->xpath('/root/wsse:Security');
        $auth = $full[0]->asXML();

        parent::__construct($this->wssNs, 'Security', new SoapVar($auth, XSD_ANYXML), true);

    }
};
?>
