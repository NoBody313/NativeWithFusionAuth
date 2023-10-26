<?php

session_set_cookie_params(1800);
session_start();

function auth($username, $password) {
  // go to the database or wherever

  if ($username == 'username') {
    return true;
  }
  return false;

  if ($password == 'password') { 
    return true;
  }
  return false;

}
