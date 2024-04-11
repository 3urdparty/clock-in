source .env
arduino-cli monitor -p $SERIAL_PORT --config baudrate=$DEBUGGING_BAUDRATE
