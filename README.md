# Raspberry Pi 2 & DHT22 Temperature / Humidity Sensor

The Raspberry Pi 2 will have the DHT22 temperature / humidity sensors connected to it. This will be polled on a scheduled basis on the device itself, sent to a Zapier endpoint which will then fire off actions based on conditions.  One constant will be a webhook listener that will receive every data point and dump it into a MySQL database.


## Process:
- Power Pi off and setup the DHT sensors on GPIO
- Power Pi back on
- Setup SSH on Retropie
- Full apt-get update and upgrade
- Install the DHT Adafruit Python library
- Test
- Install webook curl bash script
- Update bash script to reflect Adafruit python script
- Setup cron for every 10 minutes (*/10 * * * *)
- Test


### Adafruit Python Library Install
sudo apt-get -y install build-essential python-dev python-openssl git

git clone https://github.com/adafruit/Adafruit_Python_DHT.git && cd Adafruit_Python_DHT

sudo python setup.py install


Once completed:
cd examples
sudo ./AdafruitDHT.py 22 (GPIO connector number)
