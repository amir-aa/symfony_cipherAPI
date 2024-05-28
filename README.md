This is a Symfony app to encrypt & decrypt string.<br>
Endpoints:<br>
/decr (POST) => Parameters => JSON {"key":"KEY (in enc response)","cipher":"Encrypted text (in enc response in B64 format)"}<br>
/enc (POST) => Parameters=>  JSON {"plaintext":"text"}<br>
