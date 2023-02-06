#!/bin/bash
cd `dirname 0`
ssh -p 10022 -i ./xs559880.key -N -L 13306:127.0.0.1:3306 xs559880@sv14469.xserver.jp

