<?php

namespace Models;

interface Crud {

    function insert();
    function delete();
    function update();
    function select();
    function selectAll();
}