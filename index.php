<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/icons8-favicon.gif">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Popperjs -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <!-- Tempus Dominus JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js" crossorigin="anonymous"></script>

    <!-- Tempus Dominus Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css" crossorigin="anonymous">
    <title>Tempus</title>
</head>

<body>

    <input id="datetimepicker" type="text">
    <input id="datetimepicker2" type="text">
    <button onclick="hitungSelisih()">Hitung Selisih Jam</button>
    <p id="hasil"></p>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

<script>
    const tanggal1 = document.getElementById("datetimepicker");
    const tanggal2 = document.getElementById("datetimepicker2");

    const datetimepicker = new tempusDominus.TempusDominus(tanggal1, {
        localization: {
            locale: 'id', // Mengatur bahasa menjadi Indonesia
            format: 'dd-MM-yyyy HH:mm:ss', // Format tanggal dan waktu Indonesia
            hourCycle: 'h24', // Gunakan format 24 jam
        },
        display: {
            icons: {
                type: 'icons',
                time: 'fa-solid fa-clock',
                date: 'fa-solid fa-calendar',
                up: 'fa-solid fa-arrow-up',
                down: 'fa-solid fa-arrow-down',
                previous: 'fa-solid fa-chevron-left',
                next: 'fa-solid fa-chevron-right',
                today: 'fa-solid fa-calendar-check',
                clear: 'fa-solid fa-trash',
                close: 'fa-solid fa-xmark'
            },
            sideBySide: false,
            buttons: {
                today: true,
                clear: true,
                close: true
            },
            components: {
                seconds: true
            },
            theme: 'auto'
        }
    });

    const datetimepicker2 = new tempusDominus.TempusDominus(tanggal2, {
        useCurrent: false,
        localization: {
            locale: 'id', // Mengatur bahasa menjadi Indonesia
            format: 'dd-MM-yyyy HH:mm:ss', // Format tanggal dan waktu Indonesia
            hourCycle: 'h24', // Gunakan format 24 jam
        },
        display: {
            icons: {
                type: 'icons',
                time: 'fa-solid fa-clock',
                date: 'fa-solid fa-calendar',
                up: 'fa-solid fa-arrow-up',
                down: 'fa-solid fa-arrow-down',
                previous: 'fa-solid fa-chevron-left',
                next: 'fa-solid fa-chevron-right',
                today: 'fa-solid fa-calendar-check',
                clear: 'fa-solid fa-trash',
                close: 'fa-solid fa-xmark'
            },
            sideBySide: false,
            buttons: {
                today: true,
                clear: true,
                close: true
            },
            components: {
                seconds: true
            },
            theme: 'auto'
        }
    });

    // const linkedPicker1Element = document.getElementById('datetimepicker');
    // const linked1 = new tempusDominus.TempusDominus(linkedPicker1Element);
    // const linked2 = new tempusDominus.TempusDominus(document.getElementById('datetimepicker2'), {
    //     useCurrent: false,
    // });

    //using event listeners
    tanggal1.addEventListener(tempusDominus.Namespace.events.change, (e) => {
        datetimepicker2.updateOptions({
            restrictions: {
                minDate: e.detail.date,
            },
        });
    });

    //using subscribe method
    const subscription = datetimepicker2.subscribe(tempusDominus.Namespace.events.change, (e) => {
        datetimepicker.updateOptions({
            restrictions: {
                maxDate: e.date,
            },
        });
    });

    function hitungSelisih() {

        const tanggal1 = datetimepicker.dates.lastPicked;
        const tanggal2 = datetimepicker2.dates.picked[0];

        if (!tanggal1 || !tanggal2) {
            document.getElementById("hasil").innerText = "Pilih kedua tanggal terlebih dahulu!";
            return;
        }

        // Hitung selisih dalam milidetik, lalu ubah ke jam
        const selisihMillis = Math.abs(tanggal2 - tanggal1);
        const selisihJam = selisihMillis / (1000 * 60 * 60);

        // Tampilkan hasil
        document.getElementById("hasil").innerText = `Selisih waktu: ${selisihJam.toFixed(2).replace('.',',')} jam`;
    }
</script>
</script>