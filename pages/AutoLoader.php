<?php

/*
 * Milestone 1
 * Author: Tyler Wiggins & Ana Sanchez 
 * Date: 1/26/2019
 * File: AutoLoader.php
 * Version: 1.0
 * 
 * This is a script that loads all the 
 * php classes in source file
 * Subsitues all the require_once statements.
 * 
 */
 
function my_autoLoader($class){
    require $class . ".php";
}
spl_autoload_register('my_autoLoader');
