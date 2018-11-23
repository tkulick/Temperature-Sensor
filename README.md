# Raspberry Pi 2 & DHT22 Temperature / Humidity Sensor

The Raspberry Pi 2 will have the DHT22 temperature / humidity sensors connected to it. This will be polled on a scheduled basis on the device itself, sent to a Zapier endpoint which will then fire off actions based on conditions.  One constant will be a webhook listener that will receive every data point and dump it into a MySQL database.
