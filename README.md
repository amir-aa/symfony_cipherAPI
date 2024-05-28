This is a Symfony app to encrypt & decrypt string.
Endpoints:
/decr (POST) => Parameters => JSON {"key":"KEY (in enc response)","cipher":"Encrypted text (in enc response in B64 format)"}
/enc (POST) => Parameters=>  JSON {"plaintext":"text"}
