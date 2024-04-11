source .env
arduino-cli upload -p $SERIAL_PORT --fqbn $FQBN $1
