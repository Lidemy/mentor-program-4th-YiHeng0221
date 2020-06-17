#!/bin/bash

read -p "Please enter the username: " username

curl -silent https://api.github.com/users/$username > userdata.txt

for key in name bio location blog
do
    grep $key userdata.txt | awk -F'"' '{print $4}'
done
