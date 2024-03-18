<?php

function randomColor(): string
{
    $colors = array('#44252d','#e7b26c','#246b58','#50c819','#6feb96','#1c0086','#4d008e','#470085','#1c0084','#185e65','#195763','#9500ae','#65283c','#a62d59','#66161c','#943231','#3c672f','#312520','#242f1f','#ffdab9','#ffc3a0','#ffe4e1','#000437','#00dada','#9e1922','#1111ee','#11eeee','#11ee11','#ee11ee','#ff22ff','#2222ff','#22ffff','#00dddd','#0000dd','#ff11ff','#1111ff','#11ffff','#11ff11','#eeddff','#bbff77','#77ffbb','#bb77ff');

    return $colors[array_rand( $colors, 1)];
}
