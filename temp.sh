#!/bin/bash
curl --header "Content-Type: application/json" \
  --request POST \
  --data '{"temperature":"temp-here","humidity":"humidity-here"}' \
  https://phoenix-omega.us/temperature/temp.php
