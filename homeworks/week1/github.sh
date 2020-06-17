#!/bin/bash

read -p "Please enter the username: " username

curl -silent https://api.github.com/users/$username > userdata.txt

for key in name bio location blog
do
    grep $key userdata.txt | awk -F'"' '{print $4}'
done


# name 輸出後下面會空一行，因為搜尋到了"twitter_username": null,
