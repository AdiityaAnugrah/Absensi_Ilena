

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php
$setting = App\Models\Utility::settings();

?>



<?php $__env->startSection('content'); ?>

<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>


<?php if(\Auth::user()->type == 'employee'): ?>
<!-- <div class="col-xxl-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h5><?php echo e(__('Calendar')); ?></h5>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for=""></label>
                                <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                    <select class="form-control" name="calender_type" id="calender_type"
                                        onchange="get_data()">
                                        <option value="google_calender"><?php echo e(__('Google Calender')); ?></option>
                                        <option value="local_calender" selected="true">
                                            <?php echo e(__('Local Calender')); ?></option>
                                    </select>
                                <?php endif; ?>
                                <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='event_calendar' class='calendar'></div>
                </div>
            </div>
        </div> -->
<div class="col-xxl-6">
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_7AU1pVekCxM9B_sYj1e2gM8mcqdMs94"></script> -->
    <div class="card" style="height: auto;">
        <div class="card-header">
            <h5><?php echo e(__('Mark Attandance')); ?></h5>
        </div>
        <div class="card-body">
            <p class="text-muted pb-0-5">
                <?php echo e(__('My Office Time: ' . $officeTime['startTime'] . ' to ' . $officeTime['endTime'])); ?>

            </p>
            <div class="row">
                <div class="col-md-6">
                    <?php echo e(Form::open(['url' => 'attendanceemployee/attendance', 'method' => 'post'])); ?>

                    <?php if(empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00'): ?>
                    <!-- Tambahkan elemen div untuk menampilkan peta -->
                    <div id="map" style="width: 100%; height: 200px;"></div>


                    <input type="text" name="latitude" id="latitude" value="Teks yang tidak dapat diubah" readonly>
                    <input type="text" name="longitude" id="longitude" value="Teks yang tidak dapat diubah" readonly>
                </div>

                <div class="col-md-6 mt-3 text-right" style="text-align: right;">
                    <button type="submit" value="0" name="in" id="clock_in"
                        class="btn btn-primary"><?php echo e(__('CLOCK IN')); ?></button>
                    <?php else: ?>
                    <button type="submit" value="0" name="in" id="clock_in" class="btn btn-primary disabled"
                        disabled><?php echo e(__('CLOCK IN')); ?></button>
                    <?php endif; ?>
                    <?php echo e(Form::close()); ?>

                    <?php if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00'): ?>
                    <?php echo e(Form::model($employeeAttendance, ['route' => ['attendanceemployee.update', $employeeAttendance->id], 'method' => 'PUT'])); ?>

                    <button type="submit" value="1" name="out" id="clock_out"
                        class="btn btn-danger"><?php echo e(__('CLOCK OUT')); ?></button>
                    <?php else: ?>
                    <button type="submit" value="1" name="out" id="clock_out" class="btn btn-danger disabled"
                        disabled><?php echo e(__('CLOCK OUT')); ?></button>
                    <?php endif; ?>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="card" style="height: 462px;">
                <div class="card-header card-body table-border-style">
                    <h5><?php echo e(__('Meeting schedule')); ?></h5>
                </div>
                <div class="card-body" style="height: 320px">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Meeting title')); ?></th>
                                    <th><?php echo e(__('Meeting Date')); ?></th>
                                    <th><?php echo e(__('Meeting Time')); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($meeting->title); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                        <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <h5><?php echo e(__('Announcement List')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($announcement->title); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                        <td><?php echo e($announcement->description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
</div>
<?php else: ?>
<div class="col-xxl-12">

    
    <div class="row">

        <div class="col-lg-4 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-users"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Staff')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0 text-primary"><?php echo e($countUser + $countEmployee); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-ticket"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Ticket')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0 text-info"> <?php echo e($countTicket); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-wallet"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Account Balance')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0 text-warning"><?php echo e(\Auth::user()->priceFormat($accountBalance)); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-4 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mb-3 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="theme-avtar bg-primary">
                            <i class="ti ti-cast"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted"><?php echo e(__('Total')); ?></small>
                            <h6 class="m-0"><?php echo e(__('Jobs')); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-end">
                    <h4 class="m-0 text-primary"><?php echo e($activeJob + $inActiveJOb); ?></h4>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-lg-4 col-md-6">

    <div class="card">
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mb-3 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="theme-avtar bg-info">
                            <i class="ti ti-cast"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted"><?php echo e(__('Total')); ?></small>
                            <h6 class="m-0"><?php echo e(__('Active Jobs')); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-end">
                    <h4 class="m-0 text-info"> <?php echo e($activeJob); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6">

    <div class="card">
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mb-3 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="theme-avtar bg-warning">
                            <i class="ti ti-cast"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted"><?php echo e(__('Total')); ?></small>
                            <h6 class="m-0"><?php echo e(__('Inactive Jobs')); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-end">
                    <h4 class="m-0 text-warning"><?php echo e($inActiveJOb); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="col-xxl-12">
    <div class="row">
        <div class="col-xl-5">

            <div class="card">
                <div class="card-header card-body table-border-style">
                    <h5><?php echo e(__('Meeting schedule')); ?></h5>
                </div>
                <div class="card-body" style="height: 324px; overflow:auto">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Time')); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($meeting->title); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                    <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header card-body table-border-style">
                    <h5><?php echo e(__("Today's Not Clock In")); ?></h5>
                </div>
                <div class="card-body" style="height: 324px; overflow:auto">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__currentLoopData = $notClockIns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notClockIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($notClockIn->name); ?></td>
                                    <td><span class="absent-btn"><?php echo e(__('Absent')); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h5><?php echo e(__('Calendar')); ?></h5>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for=""></label>
                                <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                <select class="form-control" name="calender_type" id="calender_type"
                                    onchange="get_data()">
                                    <option value="google_calender"><?php echo e(__('Google Calender')); ?></option>
                                    <option value="local_calender" selected="true">
                                        <?php echo e(__('Local Calender')); ?></option>
                                </select>
                                <?php endif; ?>
                                <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body card-635">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-body table-border-style">
            <h5><?php echo e(__('Announcement List')); ?></h5>
        </div>
        <div class="card-body" style="height: 270px; overflow:auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Title')); ?></th>
                            <th><?php echo e(__('Start Date')); ?></th>
                            <th><?php echo e(__('End Date')); ?></th>
                            <th><?php echo e(__('Description')); ?></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($announcement->title); ?></td>
                            <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                            <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                            <td><?php echo e($announcement->description); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>




<?php $__env->startPush('script-page'); ?>
<script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>

<?php if(Auth::user()->type == 'company' || Auth::user()->type == 'hr'): ?>
<script type="text/javascript">
$(document).ready(function() {
    get_data();
});

function get_data() {
    var calender_type = $('#calender_type :selected').val();
    console.log(calender_type);
    $('#calendar').removeClass('local_calender');
    $('#calendar').removeClass('google_calender');
    if (calender_type == undefined) {
        calender_type = 'local_calender';
    }
    $('#calendar').addClass(calender_type);

    $.ajax({
        url: $("#path_admin").val() + "/event/get_event_data",
        method: "POST",
        data: {
            "_token": "<?php echo e(csrf_token()); ?>",
            'calender_type': calender_type
        },
        success: function(data) {
            (function() {
                var etitle;
                var etype;
                var etypeclass;
                var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    buttonText: {
                        timeGridDay: "<?php echo e(__('Day')); ?>",
                        timeGridWeek: "<?php echo e(__('Week')); ?>",
                        dayGridMonth: "<?php echo e(__('Month')); ?>"
                    },
                    themeSystem: 'bootstrap',
                    slotDuration: '00:10:00',
                    navLinks: true,
                    droppable: true,
                    selectable: true,
                    selectMirror: true,
                    editable: true,
                    dayMaxEvents: true,
                    handleWindowResize: true,
                    events: data,
                });
                calendar.render();
            })();
        }
    });

}
</script>
<?php else: ?>
<script>
$(document).ready(function() {
    get_data();
});

function get_data() {
    var calender_type = $('#calender_type :selected').val();
    console.log(calender_type);
    $('#event_calendar').removeClass('local_calender');
    $('#event_calendar').removeClass('google_calender');
    if (calender_type == undefined) {
        calender_type = 'local_calender';
    }
    $('#event_calendar').addClass(calender_type);

    $.ajax({
        url: $("#path_admin").val() + "/event/get_event_data",
        method: "POST",
        data: {
            "_token": "<?php echo e(csrf_token()); ?>",
            'calender_type': calender_type
        },
        success: function(data) {
            (function() {
                var etitle;
                var etype;
                var etypeclass;
                var calendar = new FullCalendar.Calendar(document.getElementById(
                    'event_calendar'), {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    buttonText: {
                        timeGridDay: "<?php echo e(__('Day')); ?>",
                        timeGridWeek: "<?php echo e(__('Week')); ?>",
                        dayGridMonth: "<?php echo e(__('Month')); ?>"
                    },
                    themeSystem: 'bootstrap',
                    slotDuration: '00:10:00',
                    navLinks: true,
                    droppable: true,
                    selectable: true,
                    selectMirror: true,
                    editable: true,
                    dayMaxEvents: true,
                    handleWindowResize: true,
                    events: data,
                });
                calendar.render();
            })();
        }
    });

}
</script>
<script>
var initialLatitude = -6.930560; // Koordinat awal latitude disesuaikan dengan kantor
var initialLongitude = 110.273308; // Koordinat awal longitude disesuaikan dengan kantor
var maxDistance = 50; // Maksimum jarak dalam meter

window.addEventListener("load", getLocation); // Panggil getLocation saat halaman dimuat

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        document.getElementById("latitude").value = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // Perbarui kolom masukan dengan garis lintang dan garis bujur
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;

    // Periksa jarak dari koordinat awal
    var clock_in = document.getElementById("clock_in");

    // Menambahkan event listener untuk mengaktifkan tombol saat di-klik
    clock_in.addEventListener("click", function() {
        // Kode logika atau tindakan lain yang ingin Anda lakukan saat tombol diklik
    });

    var distance = calculateDistance(initialLatitude, initialLongitude, latitude, longitude);
    if (distance > maxDistance) {

        alert("Posisi Anda terlalu jauh dari koordinat awal. Data tidak akan tersimpan.");
        clock_in.disabled = true;
    } else {
        sendData(latitude, longitude);
    }
}

function calculateDistance(lat1, lon1, lat2, lon2) {
    // Rumus Haversine untuk menghitung jarak antara dua koordinat
    var R = 6371e3; // Earth's radius in meters
    var φ1 = (lat1 * Math.PI) / 180;
    var φ2 = (lat2 * Math.PI) / 180;
    var Δφ = ((lat2 - lat1) * Math.PI) / 180;
    var Δλ = ((lon2 - lon1) * Math.PI) / 180;

    var a =
        Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
        Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var distance = R * c;

    return distance;
}

function sendData(latitude, longitude) {
    // Sekarang Anda dapat mengirimkan garis lintang dan bujur ke backend PHP Anda menggunakan AJAX atau metode lainnya
    // For example:
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process_coordinates.php", true); // Ganti "process_coordinates.php" dengan URL yang sesuai
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    var data = "latitude=" + latitude + "&longitude=" + longitude;
    xhr.send(data);
}
</script>
<!-- <script async defer
    src="https://www.google.com/maps/embed/v1/view?key=AIzaSyD_7AU1pVekCxM9B_sYj1e2gM8mcqdMs94&q=$latitude,$longitude&zoom=18&maptype=satellite">
</script> -->
<!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_7AU1pVekCxM9B_sYj1e2gM8mcqdMs94&callback=initMap"></script> -->

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3bsDl1xddiU_w38hA-fsGea8kWsp5uJM&callback=initMap"
    type="text/javascript"></script>

<style>
#latitude,
#longitude {
    display: none;
    /* Menyembunyikan elemen input */
}
</style>



<script>
function initMap() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            var mapOptions = {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 18 //untuk mengatur kedekatan maps
            };

            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var marker = new google.maps.Marker({
                position: {
                    lat: latitude,
                    lng: longitude
                },
                map: map,
                title: "Lokasi Anda"
            });
        });
    }
}
</script>


<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Konfigurasi database
        $host = 'sdb-l.hosting.stackcp.net'; // Ganti dengan nama host database Anda
        $username = 'ilenaclon-313932fc30'; // Ganti dengan username database Anda
        $password = 'oW&A{Q(z{Cvw'; // Ganti dengan password database Anda
        $database = 'ilenaclon-313932fc30'; // Ganti dengan nama database Anda
    
        // Koneksi ke database
        $koneksi = new mysqli($host, $username, $password, $database);
    
        // Periksa koneksi
        if ($koneksi->connect_error) {
            die("Koneksi database gagal: " . $koneksi->connect_error);
        }
    
        // Ambil data latitude dan longitude dari permintaan POST
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
    
        // Query untuk menyimpan data ke dalam tabel "absen"
        $sql = "INSERT INTO attendance_employees  (latitude, longitude) VALUES ('$latitude', '$longitude')";
    
        if ($koneksi->query($sql) === TRUE) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    
        // Tutup koneksi database
        $koneksi->close();
    }
    ?>

<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hrm\resources\views/dashboard/absensi.blade.php ENDPATH**/ ?>