<?php

const TIMESHEET_DB_HOST = '127.0.0.1';
const TIMESHEET_DB_USER = 'root';
const TIMESHEET_DB_PW = 'S3ns3nr34p3r';
const TIMESHEET_DB_DATABASE = 'Timesheet';

$mysqli = new mysqli(TIMESHEET_DB_HOST, TIMESHEET_DB_USER, TIMESHEET_DB_PW, TIMESHEET_DB_DATABASE);

if ($mysqli === false) {
    die("Fehler: " . $mysqli->connect_error);
}

if ($mysqli->connect_error) {
    die("Fehler: " . $mysqli->connect_error);

}
