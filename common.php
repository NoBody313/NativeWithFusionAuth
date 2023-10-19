<?php
session_start();

function auth($username, $password) {
  // go to the database or wherever

  if ($password == 'password') { 
    return true;
  }
  return false;

}
