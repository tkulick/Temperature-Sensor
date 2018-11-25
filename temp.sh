temperature=`/home/pi/Adafruit_Python_DHT/examples/AdafruitDHT.py 22 6`
echo $temperature

temp=`echo $temperature | sed -rn 's/Temp\=([0-9]+\.[0-9]+\s).*/\1/gp;'`
echo $temp

hum=`echo $temperature | sed -rn 's/.*Humidity\=([0-9]+\.[0-9]+).*/\1/gp;'`
echo $hum

curl --header "Content-Type: application/json" \
  --request POST \
  --data '{"temperature":"$temp","humidity":"$hum"}' \
  https://hooks.zapier.com/hooks/catch/2818261/ejif9i/
