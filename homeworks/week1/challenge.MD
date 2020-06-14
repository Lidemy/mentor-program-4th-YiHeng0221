# 挑戰題

## for 迴圈寫法

```bash
#!/bin/bash
echo -n "請問你要幾個檔案:"
read F
for ((i=1 ; i<=F ; i++))

do

touch $i.js
echo $i

done
echo "已經給你 $F 個檔案囉了！"
```

## while 迴圈寫法

```bash
#!/bin/bash

echo -n "請問你要幾個檔案:"
read F

INDEX=1
# 當條件成立，就會不斷執行（le表示小於或等於）
while [ $INDEX -le $F ]
do
   	# 輸出 妹
       touch $INDEX.js
       echo -n "$INDEX"
   	# INDEX 的值會加1
       (( INDEX++ ))
done
echo ""

echo "已經給你 $F 個檔案囉了！"

```

## until 迴圈寫法

```bash
#!/bin/bash

echo -n "請問你要幾個檔案:"
read F
counter=0
until [ $counter = $F ]; do
    ((counter++))
    echo $counter
    touch $counter.js
    
done
echo "已經給你 $F 個檔案囉了！"
```