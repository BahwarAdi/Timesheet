<?php

const TIMESHEET_DB_HOST = '127.0.0.1';
const TIMESHEET_DB_USER = 'root';
const TIMESHEET_DB_PW = '';
const TIMESHEET_DB_DATABASE = 'Timesheet';

$mysqli = new mysqli(HUMANS_DB_HOST, HUMANS_DB_USER, HUMANS_DB_PW, HUMANS_DB_DATABASE);

if ($mysqli === false) {
    die("Fehler: " . $mysqli->connect_error);
}

if ($mysqli->connect_error) {
    die("Fehler: " . $mysqli->connect_error);

}
