#!/bin/bash
gnome-terminal --tab --title "PHP Server" -- sh -c "echo 'Rokomari Banner Generator TAB: 1'; echo 'PHP SERVER INIT on $1'; php -S localhost:$1;"
gnome-terminal --tab --title "Yarn Dev" -- sh -c "echo 'Rokomari Banner Generator TAB: 2'; echo 'Yarn is watching'; yarn watch;"

