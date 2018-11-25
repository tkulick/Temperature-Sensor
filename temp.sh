#!/bin/bash
temperature=`/home/pi/Adafruit_Python_DHT/examples/AdafruitDHT.py 22 6`

temp=`echo $temperature | sed -rn 's/Temp\=([0-9]+\.[0-9]).*/\1/gp;'`

hum=`echo $temperature | sed -rn 's/.*Humidity\=([0-9]+\.[0-9]+).*/\1/gp;'`

ip=`curl https://ipinfo.io/ip`

request_body=$( cat << EOF
{"temperature":"$temp","humidity":"$hum","ip":"$ip"}
EOF
)

curl --header "Content-Type: application/json" \
  --request POST \
  --data $request_body \
  https://hooks.zapier.com/hooks/catch/2818261/ejif9i/
