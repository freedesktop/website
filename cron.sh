#! /bin/sh

cd /srv/planet-config

(
    flock 200
    (
        echo "***********************************************************************"
        echo -n "Date: "
        date
        python /srv/planet-2.0/planet.py config.ini
    ) >> /var/log/planet/planet.log 2>&1
) 200>/srv/planet-config/planet.lock
