<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_sip.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.SIPInboundTrunkInfo</code>
 */
class SIPInboundTrunkInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sip_trunk_id = 1;</code>
     */
    protected $sip_trunk_id = '';
    /**
     * Human-readable name for the Trunk.
     *
     * Generated from protobuf field <code>string name = 2;</code>
     */
    protected $name = '';
    /**
     * User-defined metadata for the Trunk.
     *
     * Generated from protobuf field <code>string metadata = 3;</code>
     */
    protected $metadata = '';
    /**
     * Numbers associated with LiveKit SIP. The Trunk will only accept calls made to these numbers.
     * Creating multiple Trunks with different phone numbers allows having different rules for a single provider.
     *
     * Generated from protobuf field <code>repeated string numbers = 4;</code>
     */
    private $numbers;
    /**
     * CIDR or IPs that traffic is accepted from.
     * An empty list means all inbound traffic is accepted.
     *
     * Generated from protobuf field <code>repeated string allowed_addresses = 5;</code>
     */
    private $allowed_addresses;
    /**
     * Numbers that are allowed to make calls to this Trunk.
     * An empty list means calls from any phone number is accepted.
     *
     * Generated from protobuf field <code>repeated string allowed_numbers = 6;</code>
     */
    private $allowed_numbers;
    /**
     * Username and password used to authenticate inbound SIP invites.
     * May be empty to have no authentication.
     *
     * Generated from protobuf field <code>string auth_username = 7;</code>
     */
    protected $auth_username = '';
    /**
     * Generated from protobuf field <code>string auth_password = 8;</code>
     */
    protected $auth_password = '';
    /**
     * Include these SIP X-* headers in 200 OK responses.
     *
     * Generated from protobuf field <code>map<string, string> headers = 9;</code>
     */
    private $headers;
    /**
     * Map SIP X-* headers from INVITE to SIP participant attributes.
     *
     * Generated from protobuf field <code>map<string, string> headers_to_attributes = 10;</code>
     */
    private $headers_to_attributes;
    /**
     * Map LiveKit attributes to SIP X-* headers when sending BYE or REFER requests.
     * Keys are the names of attributes and values are the names of X-* headers they will be mapped to.
     *
     * Generated from protobuf field <code>map<string, string> attributes_to_headers = 14;</code>
     */
    private $attributes_to_headers;
    /**
     * Map SIP headers from INVITE to sip.h.* participant attributes automatically.
     * When the names of required headers is known, using headers_to_attributes is strongly recommended.
     * When mapping INVITE headers to response headers with attributes_to_headers map,
     * lowercase header names should be used, for example: sip.h.x-custom-header.
     *
     * Generated from protobuf field <code>.livekit.SIPHeaderOptions include_headers = 15;</code>
     */
    protected $include_headers = 0;
    /**
     * Max time for the caller to wait for track subscription.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration ringing_timeout = 11;</code>
     */
    protected $ringing_timeout = null;
    /**
     * Max call duration.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration max_call_duration = 12;</code>
     */
    protected $max_call_duration = null;
    /**
     * Generated from protobuf field <code>bool krisp_enabled = 13;</code>
     */
    protected $krisp_enabled = false;
    /**
     * Generated from protobuf field <code>.livekit.SIPMediaEncryption media_encryption = 16;</code>
     */
    protected $media_encryption = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sip_trunk_id
     *     @type string $name
     *           Human-readable name for the Trunk.
     *     @type string $metadata
     *           User-defined metadata for the Trunk.
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $numbers
     *           Numbers associated with LiveKit SIP. The Trunk will only accept calls made to these numbers.
     *           Creating multiple Trunks with different phone numbers allows having different rules for a single provider.
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $allowed_addresses
     *           CIDR or IPs that traffic is accepted from.
     *           An empty list means all inbound traffic is accepted.
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $allowed_numbers
     *           Numbers that are allowed to make calls to this Trunk.
     *           An empty list means calls from any phone number is accepted.
     *     @type string $auth_username
     *           Username and password used to authenticate inbound SIP invites.
     *           May be empty to have no authentication.
     *     @type string $auth_password
     *     @type array|\Google\Protobuf\Internal\MapField $headers
     *           Include these SIP X-* headers in 200 OK responses.
     *     @type array|\Google\Protobuf\Internal\MapField $headers_to_attributes
     *           Map SIP X-* headers from INVITE to SIP participant attributes.
     *     @type array|\Google\Protobuf\Internal\MapField $attributes_to_headers
     *           Map LiveKit attributes to SIP X-* headers when sending BYE or REFER requests.
     *           Keys are the names of attributes and values are the names of X-* headers they will be mapped to.
     *     @type int $include_headers
     *           Map SIP headers from INVITE to sip.h.* participant attributes automatically.
     *           When the names of required headers is known, using headers_to_attributes is strongly recommended.
     *           When mapping INVITE headers to response headers with attributes_to_headers map,
     *           lowercase header names should be used, for example: sip.h.x-custom-header.
     *     @type \Google\Protobuf\Duration $ringing_timeout
     *           Max time for the caller to wait for track subscription.
     *     @type \Google\Protobuf\Duration $max_call_duration
     *           Max call duration.
     *     @type bool $krisp_enabled
     *     @type int $media_encryption
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitSip::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string sip_trunk_id = 1;</code>
     * @return string
     */
    public function getSipTrunkId()
    {
        return $this->sip_trunk_id;
    }

    /**
     * Generated from protobuf field <code>string sip_trunk_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSipTrunkId($var)
    {
        GPBUtil::checkString($var, True);
        $this->sip_trunk_id = $var;

        return $this;
    }

    /**
     * Human-readable name for the Trunk.
     *
     * Generated from protobuf field <code>string name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Human-readable name for the Trunk.
     *
     * Generated from protobuf field <code>string name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * User-defined metadata for the Trunk.
     *
     * Generated from protobuf field <code>string metadata = 3;</code>
     * @return string
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * User-defined metadata for the Trunk.
     *
     * Generated from protobuf field <code>string metadata = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setMetadata($var)
    {
        GPBUtil::checkString($var, True);
        $this->metadata = $var;

        return $this;
    }

    /**
     * Numbers associated with LiveKit SIP. The Trunk will only accept calls made to these numbers.
     * Creating multiple Trunks with different phone numbers allows having different rules for a single provider.
     *
     * Generated from protobuf field <code>repeated string numbers = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * Numbers associated with LiveKit SIP. The Trunk will only accept calls made to these numbers.
     * Creating multiple Trunks with different phone numbers allows having different rules for a single provider.
     *
     * Generated from protobuf field <code>repeated string numbers = 4;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setNumbers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->numbers = $arr;

        return $this;
    }

    /**
     * CIDR or IPs that traffic is accepted from.
     * An empty list means all inbound traffic is accepted.
     *
     * Generated from protobuf field <code>repeated string allowed_addresses = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAllowedAddresses()
    {
        return $this->allowed_addresses;
    }

    /**
     * CIDR or IPs that traffic is accepted from.
     * An empty list means all inbound traffic is accepted.
     *
     * Generated from protobuf field <code>repeated string allowed_addresses = 5;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAllowedAddresses($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->allowed_addresses = $arr;

        return $this;
    }

    /**
     * Numbers that are allowed to make calls to this Trunk.
     * An empty list means calls from any phone number is accepted.
     *
     * Generated from protobuf field <code>repeated string allowed_numbers = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAllowedNumbers()
    {
        return $this->allowed_numbers;
    }

    /**
     * Numbers that are allowed to make calls to this Trunk.
     * An empty list means calls from any phone number is accepted.
     *
     * Generated from protobuf field <code>repeated string allowed_numbers = 6;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAllowedNumbers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->allowed_numbers = $arr;

        return $this;
    }

    /**
     * Username and password used to authenticate inbound SIP invites.
     * May be empty to have no authentication.
     *
     * Generated from protobuf field <code>string auth_username = 7;</code>
     * @return string
     */
    public function getAuthUsername()
    {
        return $this->auth_username;
    }

    /**
     * Username and password used to authenticate inbound SIP invites.
     * May be empty to have no authentication.
     *
     * Generated from protobuf field <code>string auth_username = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setAuthUsername($var)
    {
        GPBUtil::checkString($var, True);
        $this->auth_username = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string auth_password = 8;</code>
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->auth_password;
    }

    /**
     * Generated from protobuf field <code>string auth_password = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setAuthPassword($var)
    {
        GPBUtil::checkString($var, True);
        $this->auth_password = $var;

        return $this;
    }

    /**
     * Include these SIP X-* headers in 200 OK responses.
     *
     * Generated from protobuf field <code>map<string, string> headers = 9;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Include these SIP X-* headers in 200 OK responses.
     *
     * Generated from protobuf field <code>map<string, string> headers = 9;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setHeaders($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->headers = $arr;

        return $this;
    }

    /**
     * Map SIP X-* headers from INVITE to SIP participant attributes.
     *
     * Generated from protobuf field <code>map<string, string> headers_to_attributes = 10;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getHeadersToAttributes()
    {
        return $this->headers_to_attributes;
    }

    /**
     * Map SIP X-* headers from INVITE to SIP participant attributes.
     *
     * Generated from protobuf field <code>map<string, string> headers_to_attributes = 10;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setHeadersToAttributes($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->headers_to_attributes = $arr;

        return $this;
    }

    /**
     * Map LiveKit attributes to SIP X-* headers when sending BYE or REFER requests.
     * Keys are the names of attributes and values are the names of X-* headers they will be mapped to.
     *
     * Generated from protobuf field <code>map<string, string> attributes_to_headers = 14;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getAttributesToHeaders()
    {
        return $this->attributes_to_headers;
    }

    /**
     * Map LiveKit attributes to SIP X-* headers when sending BYE or REFER requests.
     * Keys are the names of attributes and values are the names of X-* headers they will be mapped to.
     *
     * Generated from protobuf field <code>map<string, string> attributes_to_headers = 14;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setAttributesToHeaders($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->attributes_to_headers = $arr;

        return $this;
    }

    /**
     * Map SIP headers from INVITE to sip.h.* participant attributes automatically.
     * When the names of required headers is known, using headers_to_attributes is strongly recommended.
     * When mapping INVITE headers to response headers with attributes_to_headers map,
     * lowercase header names should be used, for example: sip.h.x-custom-header.
     *
     * Generated from protobuf field <code>.livekit.SIPHeaderOptions include_headers = 15;</code>
     * @return int
     */
    public function getIncludeHeaders()
    {
        return $this->include_headers;
    }

    /**
     * Map SIP headers from INVITE to sip.h.* participant attributes automatically.
     * When the names of required headers is known, using headers_to_attributes is strongly recommended.
     * When mapping INVITE headers to response headers with attributes_to_headers map,
     * lowercase header names should be used, for example: sip.h.x-custom-header.
     *
     * Generated from protobuf field <code>.livekit.SIPHeaderOptions include_headers = 15;</code>
     * @param int $var
     * @return $this
     */
    public function setIncludeHeaders($var)
    {
        GPBUtil::checkEnum($var, \Livekit\SIPHeaderOptions::class);
        $this->include_headers = $var;

        return $this;
    }

    /**
     * Max time for the caller to wait for track subscription.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration ringing_timeout = 11;</code>
     * @return \Google\Protobuf\Duration|null
     */
    public function getRingingTimeout()
    {
        return $this->ringing_timeout;
    }

    public function hasRingingTimeout()
    {
        return isset($this->ringing_timeout);
    }

    public function clearRingingTimeout()
    {
        unset($this->ringing_timeout);
    }

    /**
     * Max time for the caller to wait for track subscription.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration ringing_timeout = 11;</code>
     * @param \Google\Protobuf\Duration $var
     * @return $this
     */
    public function setRingingTimeout($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Duration::class);
        $this->ringing_timeout = $var;

        return $this;
    }

    /**
     * Max call duration.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration max_call_duration = 12;</code>
     * @return \Google\Protobuf\Duration|null
     */
    public function getMaxCallDuration()
    {
        return $this->max_call_duration;
    }

    public function hasMaxCallDuration()
    {
        return isset($this->max_call_duration);
    }

    public function clearMaxCallDuration()
    {
        unset($this->max_call_duration);
    }

    /**
     * Max call duration.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration max_call_duration = 12;</code>
     * @param \Google\Protobuf\Duration $var
     * @return $this
     */
    public function setMaxCallDuration($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Duration::class);
        $this->max_call_duration = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool krisp_enabled = 13;</code>
     * @return bool
     */
    public function getKrispEnabled()
    {
        return $this->krisp_enabled;
    }

    /**
     * Generated from protobuf field <code>bool krisp_enabled = 13;</code>
     * @param bool $var
     * @return $this
     */
    public function setKrispEnabled($var)
    {
        GPBUtil::checkBool($var);
        $this->krisp_enabled = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.SIPMediaEncryption media_encryption = 16;</code>
     * @return int
     */
    public function getMediaEncryption()
    {
        return $this->media_encryption;
    }

    /**
     * Generated from protobuf field <code>.livekit.SIPMediaEncryption media_encryption = 16;</code>
     * @param int $var
     * @return $this
     */
    public function setMediaEncryption($var)
    {
        GPBUtil::checkEnum($var, \Livekit\SIPMediaEncryption::class);
        $this->media_encryption = $var;

        return $this;
    }

}

