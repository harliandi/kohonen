<?php
    /**
     * Created by PhpStorm.
     * User: Herliati Azizah
     * Date: 19/11/17
     * Time: 15.52
     */


    //todo: inisialisasi
    //todo: bobotawal Wji Random, lajupemahaman awal dan faktor penurunan, bentuk dan jari jari (R) sekitar
    //todo: Hitung distance, euclidian distance
    //todo: tentukan indeks J, dan D(j) minimum
    //todo: modifikasi bobot
    //todo: modifikasi laju pemahaman
    //todo: uji kondisi penghentian

    //data vektor
    $v = [
        0 => [1, 1, 0, 0],
        1 => [0, 0, 0, 1],
        2 => [1, 0, 0, 0],
        3 => [0, 0, 1, 1]
    ];

    //laju pemahaman (learning rate)
    $index_alpha = 0;
    $alpha[$index_alpha] = 0.6;

    //bobot awal random
    $w = [
        1 => [0.2, 0.6, 0.5, 0.9],
        2 => [0.8, 0.4, 0.7, 0.3]
    ];

    //inisialisasi jarak
    $distance = [];

    //jumlah grup
    $grup = 2;

    //max iterasi
    $max_epoch = 10;

    //variabel sementara untuk menampung bobot terakhir
    $print_bobot = '';

    //kondisi penghentian
    for ($iterasi = 1; $iterasi <= $max_epoch; $iterasi++) {
        //perhitungan distance untuk masing - masing vektor dan perubahan bobot
        for ($i = 0; $i < count($v); $i++) {
            //menghitung distance per vektor
            for ($j = 1; $j <= $grup; $j++) {
                $q1 = pow($w[$j][0] - $v[$i][0], 2);
                $q2 = pow($w[$j][1] - $v[$i][1], 2);
                $q3 = pow($w[$j][2] - $v[$i][2], 2);
                $q4 = pow($w[$j][3] - $v[$i][3], 2);
                $distance[$j] = abs($q1 + $q2 + $q3 + $q4);
            }

            //pengecekan distance vektor terkecil
            if ($distance[1] > $distance[2]) {
                $d = 2;
            } else {
                $d = 1;
            }

            $print_bobot = $w;

            //pengupdatean bobot berdasarkan grup yg terpilih
            for ($f = 0; $f <= 3; $f++) {
                $w[$d][$f] = $w[$d][$f] + ($alpha[$index_alpha] * ($v[$i][$f] - $w[$d][$f]));
            }
        }

        //modifikasi laju pemahaman
        $index_alpha += 1;
        $alpha[$index_alpha] = 0.5 * $alpha[$index_alpha - 1];

    }

    echo '<pre>';
    //cetak bobot optimal
    print_r($w);
    echo '<br>';
    print_r($v);
    echo '<br>';

    //bobot optimal didapat, hitung vektor masuk ke grup mana dengan bobot optimal
    for ($i = 0; $i < count($v); $i++) {
        //menghitung distance per vektor
        for ($j = 1; $j <= $grup; $j++) {
            $q1 = pow($w[$j][0] - $v[$i][0], 2);
            $q2 = pow($w[$j][1] - $v[$i][1], 2);
            $q3 = pow($w[$j][2] - $v[$i][2], 2);
            $q4 = pow($w[$j][3] - $v[$i][3], 2);
            $distance[$j] = abs($q1 + $q2 + $q3 + $q4);
        }

        //pengecekan distance vektor terkecil
        if ($distance[1] > $distance[2]) {
            $d = 2;
        } else {
            $d = 1;
        }

        //hasil
        echo 'Vektor ke - ' . $i . ' berada di cluster ' . $d;
        echo '<br>';
    }

    echo '</pre>';