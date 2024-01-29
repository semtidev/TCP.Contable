<?php
// MONTH NAME
if (!function_exists('month_name')) {
    function month_name($month)
    {
        $months  = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return $months[$month];
    }
}

// DB DAYS
if (!function_exists('db_day')) {
    function db_day($day)
    {
        $db_days  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        return $db_days[$day];
    }
}